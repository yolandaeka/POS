<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {

        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan'],
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem',
        ];

        $user = UserModel::all(); //ambil data penjualan untuk filter penjualan

        $activeMenu = 'penjualan'; //set menu yang sedang active

        return view('penjualan.index_penjualan', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu]);

    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->with('user');

        //Filter data user berdasarkan level_id
        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        // Return data untuk DataTables
        return DataTables::of($penjualans)
            ->addIndexColumn() // menambahkan kolom index / nomor urut
            ->addColumn('aksi', function ($penjualan) {
                // Menambahkan kolom aksi untuk edit, detail, dan hapus
                // $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                // return $btn;

                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $penjualan = PenjualanModel::select('penjualan_id', 'penjualan_kode')->get();
        $user = UserModel::select('user_id', 'nama')->get();

        return view('penjualan.create_ajax')->with([
            'barang' => $barang,
            'penjualan' => $penjualan,
            'user' => $user,
        ]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'pembeli' => 'required|string|max:255',
                'penjualan_tanggal' => 'required|date',
                'jumlah' => 'required|integer',
                'barangs' => 'required|array', // barang yang dibeli
                'barangs.*.barang_id' => 'required|exists:barang, barang_id',
                'barangs.*.jumlah' => 'required|integer|min:1',
                'barangs.*.harga' => 'required|numeric|min:0',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            
                // Generate kode penjualan unik
                $penjualanKode = 'PNJ-' . strtoupper(uniqid());
    
                // Simpan data penjualan di tabel t_penjualan
                $penjualan = PenjualanModel::create([
                    'user_id' => Auth::user()->user_id ,
                    'pembeli' => $request->pembeli,
                    'penjualan_kode' => $penjualanKode,
                    'penjualan_tanggal' => $request->penjualan_tanggal,
                ]);
    
                // Simpan detail penjualan di t_penjualan_detail
                foreach ($request->barangs as $barang) {
                    PenjualanDetailModel::create([
                        'penjualan_id' => $penjualan->penjualan_id,
                        'barang_id' => $barang['barang_id'],
                        'jumlah' => $barang['jumlah'],
                        'harga' => $barang['harga']
                    ]);
                }
    
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan',
                ]);
            
        }
        redirect('/');
    }


    public function edit_ajax($id)
    {
        $penjualan = StokModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
        $user = UserModel::select('user_id', 'nama')->get();

        return view('penjualan.edit_ajax')->with([
            'penjualan' => $penjualan,
            'barang' => $barang,
            'supplier' => $supplier,
            'user' => $user,
        ]);

    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [

                'supplier_id' => ['required', 'integer', 'exists:m_supplier,supplier_id'],
                'barang_id' => ['required', 'integer', 'exists:m_barang,barang_id'],
                'user_id' => ['required', 'integer', 'exists:m_user,user_id'],
                'stok_tanggal' => ['required', 'date'],
                'stok_jumlah' => ['required', 'integer'],
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(), // menunjukkan field mana yang error
                ]);
            }

            $check = StokModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax($id)
    {
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', ['stok' => $stok]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $stok = StokModel::find($id);
            if ($stok) { // jika sudah ditemuikan
                $stok->delete(); // stok di hapus
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    // Menampilkan detail stok
    public function show(string $id)
    {
        $stok = StokModel::with('supplier')->find($id);
        $breadcrumb = (object) ['title' => 'Detail stok', 'list' => ['Home', 'stok', 'Detail']];
        $page = (object) ['title' => 'Detail stok'];
        $activeMenu = 'stok'; // set menu yang sedang aktif
        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    }

}
