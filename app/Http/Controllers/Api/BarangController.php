<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|min:3|max:20|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Hash nama file dan simpan ke folder public/gambar
        $image = $request->image;
        $hashedName = $image->hashName();
        $image->move(public_path('gambar'), $hashedName);

        $user = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
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

    public function show(BarangModel $barang)
    {
        return BarangModel::find($barang);
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
    public function update(Request $request, BarangModel $barang)
    {
        $barang->update($request->all());
        return BarangModel::find($barang);
    }


    public function index()
    {
        return BarangModel::all();
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Data Terhapus',
        ]);
    }


}
