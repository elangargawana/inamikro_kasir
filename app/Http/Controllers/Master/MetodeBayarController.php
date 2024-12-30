<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\BaseController;
use App\Http\Requests\MetodeBayar\StoreMetodeBayarRequest;
use App\Models\MMetodeBayar;

class MetodeBayarController extends BaseController
{
    public function index()
    {
        try {
            $data = MMetodeBayar::all();

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $data = MMetodeBayar::find($id);
            if (!$data) return $this->sendError('Metode bayar not found!');

            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function store(StoreMetodeBayarRequest $request)
    {
        try {
            $params = $request->validated();

            $data = new MMetodeBayar($params);
            $data->save();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(StoreMetodeBayarRequest $request, $id)
    {
        try {
            $data = MMetodeBayar::find($id);
            if (!$data) return $this->sendError('Metode bayar not found!');

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
            $data = MMetodeBayar::find($id);
            if (!$data) return $this->sendError('Metode bayar not found!');

            $data->delete();
            return $this->sendResponse(null);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
