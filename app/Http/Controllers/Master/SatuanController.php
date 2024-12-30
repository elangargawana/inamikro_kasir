<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Satuan\StoreSatuanRequest;
use App\Models\MSatuan;
use App\Models\User;
use App\Models\UserMerchant;
use Illuminate\Support\Facades\Auth;

class SatuanController extends BaseController
{
    public function index()
    {
        try {
            $user = Auth::user()->id;
            $merchant = UserMerchant::where('user_id', $user)->first()->pluck('id')[0];
            $data = MSatuan::where('merchant_id', $merchant)->get();

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $data = MSatuan::find($id);
            if (!$data) return $this->sendError('Satuan not found!');

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function store(StoreSatuanRequest $request)
    {
        try {
            $params = $request->validated();
            $params['merchant_id'] = UserMerchant::where('user_id', Auth::id())->first()->pluck('id')[0];

            $data = new MSatuan($params);
            $data->save();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(StoreSatuanRequest $request, $id)
    {
        try {
            $data = MSatuan::find($id);
            if (!$data) return $this->sendError('Satuan not found!');

            $params = $request->validated();
            $data->update($params);
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = MSatuan::find($id);
            if (!$data) return $this->sendError('Satuan not found!');

            $data->delete();
            return $this->sendResponse(null);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
