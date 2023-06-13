<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Checkout;
use Exception;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Transaction;

class SewaController extends Controller
{
    //

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'staff' => 'required',
            'total' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->staff_id = $validatedData['staff'];
        $peminjaman->save();

        $checkout = new Checkout;
        $checkout->peminjaman_id = $peminjaman->id;
        $checkout->total_payment = $validatedData['total'];
        $checkout->save();

        $this->getSnapRedirect($checkout);


        return redirect()->route('peminjaman-user.show', ['id' => $id])->with('success', 'Penyewaan Staff Sukses Diajukan.');
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
