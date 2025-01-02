<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriProduk\StoreKategoriProdukRequest;
use App\Http\Requests\KategoriProduk\UpdateKategoriProdukRequest;
use App\Models\MKategoriProduk;
use App\Models\UserMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriProdukController extends BaseController
{
    public function index()
    {
        try {
            $user = Auth::user()->id;
            $merchant = UserMerchant::where('user_id', $user)->first()->id;
            $data = MKategoriProduk::where('merchant_id', $merchant)->get();

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $data = MKategoriProduk::find($id);
            if (!$data) return $this->sendError('Satuan not found!');

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function store(StoreKategoriProdukRequest $request)
    {
        try {
            $params = $request->validated();
            $params['merchant_id'] = UserMerchant::where('user_id', Auth::id())->first()->pluck('id')[0];

            $data = new MKategoriProduk($params);
            $data->save();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(UpdateKategoriProdukRequest $request, $id)
    {
        try {
            $data = MKategoriProduk::find($id);
            if (!$data) return $this->sendError('Kategori produk not found!');

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
            $data = MKategoriProduk::find($id);
            if (!$data) return $this->sendError('Kategori produk not found!');

            $data->delete();
            return $this->sendResponse(null);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
