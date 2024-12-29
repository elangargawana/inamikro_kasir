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
            $data = User::with(['userMerchant.mSatuan:id,nama_satuan'])
                ->where('id', $user)
                ->get();

            $this->sendResponse($data);
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $data = MSatuan::findOrFail($id);
            $this->sendResponse($data);
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 500);
        }
    }

    public function store(StoreSatuanRequest $request)
    {
        try {
            $params = $request->validated();
            $params['merchant_id'] = UserMerchant::where('user_id', Auth::id())->first()->pluck('id');

            $data = new MSatuan($params);
            $data->save();
            $this->sendResponse($data);
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(StoreSatuanRequest $request, $id)
    {
        try {
            $data = MSatuan::findOrFail($id);

            $params = $request->validated();
            $data->update($params);
            $this->sendResponse($data);
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = MSatuan::findOrFail($id);
            $data->delete();
            $this->sendResponse(null);
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 500);
        }
    }
}
