<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Checkout;
use App\Models\Jadwal;
use Exception;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Transaction;


class PeminjamanController extends Controller
{
    //

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function index(Request $request)
    {
        $query = $request->input('cari');
        $status = $request->input('status');

        if ($request->has('clear')) {
            // Clear the search query
            $query = null;
            $status = null;
        }
        $peminjamen = Peminjaman::with('jadwals')
            ->when($query, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->input('cari') . '%')
                        ->orWhere('phone', 'like', '%' . $request->input('cari') . '%');
                });
            })->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            ->paginate(6)
            ->appends(['cari' => $query]);
        return view('admin.peminjaman.index', compact('peminjamen'));
    }

    public function create()
    {
        return view('admin.peminjaman.create');
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
                function ($attribute, $value, $fail) use ($request) {
                    $tanggalselesai = $request->input('tanggalselesai');

                    $jadwal = Jadwal::where(function ($query) use ($value, $tanggalselesai) {
                        $query->whereBetween('tanggalmulai', [$value, $tanggalselesai])
                            ->orWhereBetween('tanggalselesai', [$value, $tanggalselesai]);
                    })
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
            'tanggalselesai' => [
                'required',
                'date',
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
        // Redirect ke halaman sukses
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman Sukses Ditambahkan.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('jadwals')->find($id);
        if (!$peminjaman) {
            abort(404);
        }
        // Mengembalikan view bersama dengan data $peminjaman
        return view('admin.peminjaman.detail', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'message' => $request->status == 'ditolak' ? 'required' : ''
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Cari data peminjaman yang ingin diupdate
        $peminjaman = Peminjaman::findOrFail($id);

        // Perbarui data peminjaman
        $peminjaman->status = $request->status;
        $peminjaman->message = $request->message;
        $peminjaman->save();
        // Pass $peminjaman to the NewScheduleCreated Mailable

        // Redirect ke halaman sukses
        return redirect()->route('peminjaman.index')->with('success', 'Status Peminjaman Sukses Diperbarui.');
    }

    public function delete($id)
    {
        // Temukan peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->jadwals()->delete();
        $peminjaman->delete();

        // Redirect ke halaman sukses
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
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
            'name' => 'Pembayaran untuk sewa {$checkout->peminjaman->staff->name}'
        ];

        $userData = [
            'first_name' => $checkout->peminjaman->user->name,
            'last_name' => "",
            'address' => $checkout->peminjaman->instansi->name,
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
        return redirect()->route('transaksi-user.index')->with('success', 'Penyewaan Staff Sukses Dibayar.');
    }
}
