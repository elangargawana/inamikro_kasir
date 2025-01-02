<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Produk\StoreProdukRequest;
use App\Http\Requests\Produk\UpdateProdukRequest;
use App\Models\MProduk;
use App\Models\UserMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends BaseController
{
    public function index()
    {
        try {
            $user = Auth::user()->id;
            $merchant = UserMerchant::where('user_id', $user)->first()->id;
            $data = MProduk::where('merchant_id', $merchant)->get();

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $data = MProduk::find($id);
            if (!$data) return $this->sendError('Produk not found!');

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function store(StoreProdukRequest $request)
    {
        try {
            $params = $request->validated();
            $params['merchant_id'] = UserMerchant::where('user_id', Auth::id())->first()->id;

            $data = new MProduk($params);
            $data->save();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(UpdateProdukRequest $request, $id)
    {
        try {
            $data = MProduk::find($id);
            if (!$data) return $this->sendError('Produk not found!');

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
            $data = MProduk::find($id);
            if (!$data) return $this->sendError('Produk not found!');

            $data->delete();
            return $this->sendResponse(null);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
