<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserPersonalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'nama_ibu' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'gender' => 'required|in:laki-laki,perempuan',
            'agama' => 'required|in:islam,kristen,katolik,hindu,budha,lainnya',
            'status_kawin' => 'required|in:kawin,belum_kawin',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'kode_pos' => 'required|string|max:10',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',
            'pin' => 'required|string|max:6',
            'nomor_ktp' => 'nullable|string|max:20',
            'url_ktp' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Simpan data ke user_merchant
        UserMerchant::create($request->except(['nomor_hp', 'pin', 'nomor_ktp', 'url_ktp', 'password']));

        // Simpan data ke user_detail
        UserDetail::create($request->only(['user_id', 'nomor_hp', 'pin', 'nomor_ktp', 'url_ktp']));

        return response()->json(['message' => 'Data personal berhasil disimpan.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userMerchant = UserMerchant::findOrFail($id);
        $userMerchant->update($request->except(['nomor_hp', 'pin', 'nomor_ktp', 'url_ktp', 'password']));

        $userDetail = UserDetail::where('user_id', $userMerchant->user_id)->firstOrFail();
        $userDetail->update($request->only(['nomor_hp', 'pin', 'nomor_ktp', 'url_ktp']));

        if ($request->has('password')) {
            $user = User::findOrFail($userMerchant->user_id);
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json(['message' => 'Data personal berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userMerchant = UserMerchant::findOrFail($id);
        $userDetail = UserDetail::where('user_id', $userMerchant->user_id)->first();

        $userMerchant->delete();
        if ($userDetail) {
            $userDetail->delete();
        }

        return response()->json(['message' => 'Data personal berhasil dihapus.']);
    }
}
