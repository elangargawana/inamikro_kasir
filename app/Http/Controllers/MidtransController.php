<?php

namespace App\Http\Controllers;

use App\Models\TrxMidtrans;
use App\Models\TrxTransaksi;
use Illuminate\Http\Request;

class MidtransController extends BaseController
{
    public function store($transaksi_id)
    {
        $data = TrxTransaksi::find($transaksi_id);
        if (!$data) $this->sendError('Transaksi tidak ditemukan!');

        $pembayaran = TrxMidtrans::create([
            'transaksi_id' => $transaksi_id,
            'status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('app.MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('app.MIDTRANS_IS_PRODUCTION');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('app.MIDTRANS_IS_SANITIZED');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('app.MIDTRANS_IS_3DS');

        $params = array(
            'transaction_details' => array(
                'order_id' => $pembayaran->id,
                'gross_amount' => $data->total_bayar,
            )
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $pembayaran->snap_token = $snapToken;
        $pembayaran->save();

        $data = [
            'amount'    => $data->total_bayar,
            'snapToken' => $pembayaran->snap_token,
            'clientKey' => config('app.MIDTRANS_CLIENT_KEY')
        ];

        return $data;
    }

    public function callback(Request $request)
    {
        $serverKey = config('app.MIDTRANS_SERVER_KEY');
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashedKey == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order = TrxMidtrans::findOrFail($request->order_id);
                $order->update(['status' => 'settlement']);
                return;
            }
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'deny') {
                $order = TrxMidtrans::findOrFail($request->order_id);
                $order->update(['status' => 'deny']);
                return;
            }
            return;
        }
        return;
    }
}
