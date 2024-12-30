<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrxCepat\StoreTrxCepatRequest;
use App\Models\MMetodeBayar;
use App\Models\TrxTransaksi;
use App\Models\UserMerchant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiCepatController extends BaseController
{
    public function store(StoreTrxCepatRequest $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->validated();
            $params['merchant_id'] = UserMerchant::where('user_id', Auth::id())->first()->pluck('id')[0];
            $params['invoice_number'] = Str::uuid();
            $params['jenis_transaksi'] = 'cepat';

            $data = new TrxTransaksi($params);
            $data->save();

            $data->trxTransaksiCepat()->createMany($params['details']);

            $jenis_pembayaran = MMetodeBayar::findOrFail($params['metode_bayar_id'])->pluck('nama_metode')[0];
            if ($jenis_pembayaran == 'Midtrans') {
                $midtransController = new MidtransController();
                $response = $midtransController->store($data->id);
                DB::commit();
                return $this->sendResponse($response);
            }
            DB::commit();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
