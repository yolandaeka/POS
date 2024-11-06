<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|min:3|max:100',
            'penjualan_kode' => 'required|string|min:3|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Hash nama file dan simpan ke folder public/gambar
        $image = $request->image;
        $hashedName = $image->hashName();
        $image->move(public_path('gambar'), $hashedName);

        $user = PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'image' => $hashedName,
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ], 201);
        }
        return response()->json([
            'success' => false,
        ], 409);
    }

    public function show(PenjualanModel $penjualan)
    {
        return PenjualanModel::find($penjualan);
    }
}
