<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiIndexRequest;
use App\Models\TrxTransaksi;
use App\Models\UserMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends BaseController
{
    public function index(TransaksiIndexRequest $request)
    {
        try {
            $params = $request->validated();
            $metode = $params['metode'] ?? null;

            $merchant_id = UserMerchant::where('user_id', Auth::id())->first()->id;

            $data = TrxTransaksi::where('merchant_id', $merchant_id)
                ->when($metode, function ($query, $metode) {
                    $query->whereHas('mMetodeBayar', function ($subQuery) use ($metode) {
                        $subQuery->where('nama_metode', $metode);
                    });
                })
                ->with(['mMetodeBayar:id,nama_metode'])
                ->get();

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $merchant_id = UserMerchant::where('user_id', Auth::id())->first()->id;

            $data = TrxTransaksi::with([
                'trxTransaksiCepat' => function ($query) {
                    $query->exists();
                },
                'trxTransaksiPintar' => function ($query) {
                    $query->exists();
                },
            ])->find($id);

            if (!$data) return $this->sendError('Transaction not found!');
            if ($data->merchant_id != $merchant_id) return $this->sendError('Not your transaction!');

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
