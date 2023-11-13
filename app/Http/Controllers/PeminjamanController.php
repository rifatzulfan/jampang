<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Validator;
use App\Models\Checkout;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Transaction;

class PeminjamanController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }
    //
    public $sources = [
        [
            'model'      => Jadwal::class,
            'date_field' => 'tanggalmulai',
            'date_field_to' => 'tanggalselesai',
            'field'      => 'peminjaman_id',
            'prefix'     => '',
            'suffix'     => '',
        ],
    ];
    public function index()
    {
        $peminjamans = [];

        foreach ($this->sources as $source) {
            $models = $source['model']::whereHas('peminjaman', function ($query) {
                $query->whereHas('checkouts', function ($checkoutQuery) {
                    $checkoutQuery->where('payment_status', 'paid');
                });
            })->get();
            foreach ($models as $model) {
                $tanggalmulai = $model->getOriginal($source['date_field']);
                $tanggalselesai = $model->getOriginal($source['date_field_to']);
                $name = Peminjaman::findOrFail($model->getOriginal($source['field']));

                if (!$tanggalmulai) {
                    continue;
                }
                if ($tanggalmulai != $tanggalselesai) {
                    // Add 12 hours to the end date
                    $tanggalselesai = date('Y-m-d H:i:s', strtotime($tanggalselesai . ' +12 hours'));
                }
                $peminjamans[] = [
                    'title' => $name->name,
                    'start' => $tanggalmulai,
                    'end' => $tanggalselesai,
                ];
            }
        }
        $jsonEvents = json_encode($peminjamans);

        return view('peminjaman', compact('jsonEvents'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'kegunaan' => 'required',
            'asal' => 'required',
            'tanggalmulai' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $jadwal = Jadwal::where('tanggalmulai', $value)
                        ->whereHas('peminjaman', function ($query) {
                            $query->whereHas('checkouts', function ($checkoutQuery) {
                                $checkoutQuery->where('payment_status', 'paid');
                            });
                        })
                        ->first();

                    if ($jadwal) {
                        $fail("Tanggal ini telah di book, pilih tanggal lain!");
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $tanggalMulai = $request->input('tanggalmulai');
        $tanggalBerakhir = $request->input('tanggalselesai');

        $tanggalMulai = \Carbon\Carbon::parse($tanggalMulai);
        $tanggalBerakhir = \Carbon\Carbon::parse($tanggalBerakhir);

        // Hitung jumlah hari
        $jumlahHari = $tanggalMulai->diffInDays($tanggalBerakhir) + 1;

        // Lakukan perhitungan total harga seperti sebelumnya
        $hargaSewaPerHari = 120000;
        $totalHarga = $hargaSewaPerHari * $jumlahHari;

        // Simpan data peminjaman ke database
        $peminjaman = new Peminjaman;
        $peminjaman->user_id = auth()->user()->id;
        $peminjaman->name = $request->name;
        $peminjaman->phone = $request->phone;
        $peminjaman->kegunaan = $request->kegunaan;
        $peminjaman->asal = $request->asal;
        $peminjaman->save();

        // Simpan data jadwal ke database
        $jadwal = new Jadwal;
        $jadwal->tanggalmulai = $request->tanggalmulai;
        $jadwal->tanggalselesai = $request->tanggalselesai;
        $jadwal->peminjaman_id = $peminjaman->id;
        $jadwal->save();

        $checkout = new Checkout;
        $checkout->peminjaman_id = $peminjaman->id;
        $checkout->total_payment = $totalHarga;
        $checkout->save();
        $this->getSnapRedirect($checkout);

        // Redirect ke halaman sukse

        // Redirect to the success.index route with the Peminjaman ID and data
        return redirect()->route('success.index', ['id' => $peminjaman->id])
            ->with('success', 'Peminjaman Sukses Ditambahkan.');
    }

    public function getSnapRedirect(Checkout $checkout)
    {
        $orderId = $checkout->id . '-' . Str::random(5);
        $checkout->midtrans_booking_code = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $checkout->total_payment,
        ];

        $item_details[] = [
            'id' => $orderId,
            'price' => $checkout->total_payment,
            'quantity' => 1,
            'name' => 'Pembayaran untuk sewa {$checkout->peminjaman->name}'
        ];

        $userData = [
            'first_name' => $checkout->peminjaman->user->name,
            'last_name' => "",
            'address' => "",
            'city' => "",
            'postal_code' => "",
            'phone' => $checkout->peminjaman->user->phone,
            'country_code' => "IDN",
        ];

        $customer_details = [
            'first_name' => $checkout->peminjaman->user->name,
            'last_name' => "",
            'email' => $checkout->peminjaman->user->email,
            'phone' => $checkout->peminjaman->user->phone,
            'billing_address' => $userData,
            'shipping_address' => $userData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' =>  $customer_details,
            'items_details' =>  $item_details,
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            return $paymentUrl;
        } catch (Exception $e) {
            //throw $th;
            return false;
        }
    }

    public function midtransCallback(Request $request)
    {
        $notif = $request->method() == 'POST' ? new Notification() : Transaction::status($request->order_id);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $checkout_id = explode('-', $notif->order_id)[0];
        $checkout = Checkout::find($checkout_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $checkout->payment_status = 'pending';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $checkout->payment_status = 'paid';
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            }
        } else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $checkout->payment_status = 'failed';
        } else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $checkout->payment_status = 'paid';
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $checkout->payment_status = 'pending';
        } else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $checkout->payment_status = 'failed';
        }

        $checkout->save();
        return Redirect::back()->with('success', 'Penyewaan Staff Sukses Dibayar.');
    }
}
