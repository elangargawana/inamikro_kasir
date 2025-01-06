<?php

namespace App\Http\Controllers;

use App\Models\TrxTransaksi;
use App\Models\UserMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends BaseController
{
    public function index()
    {
        try {
            $merchant_id = UserMerchant::where('user_id', Auth::id())->first()->id;
            $data = TrxTransaksi::where('merchant_id', $merchant_id)
                ->with(['mMetodeBayar:id,nama_metode'])->get();

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $merchant_id = UserMerchant::where('user_id', Auth::id())->first()->id;

            $data = TrxTransaksi::find($id)
                ->with([
                    'transaksiCepat',
                    'transaksiPintar'
                ]);
            if (!$data) return $this->sendError('Transaction not found!');
            if ($data->merchant_id != $merchant_id) return $this->sendError('Not your transaction!');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
