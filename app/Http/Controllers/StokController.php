<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {

        $breadcrumb = (object) [
            'title' => 'Daftar stok',
            'list' => ['Home', 'stok'],
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem',
        ];

        $barang = BarangModel::all(); //ambil data stok untuk filter stok
        $supplier = SupplierModel::all();

        $activeMenu = 'stok'; //set menu yang sedang active

        return view('stok.index_stok', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu]);

    }

    public function list(Request $request)
    {
        $stoks = StokModel::select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['supplier', 'barang', 'user']);

        //Filter data user berdasarkan level_id
        if ($request->barang_id) {
            $stoks->where('barang_id', $request->barang_id);
        }

        //Filter data user berdasarkan level_id
        if ($request->supplier_id) {
            $stoks->where('supplier_id', $request->supplier_id);
        }

        // Return data untuk DataTables
        return DataTables::of($stoks)
            ->addIndexColumn() // menambahkan kolom index / nomor urut
            ->addColumn('aksi', function ($stok) {
                // Menambahkan kolom aksi untuk edit, detail, dan hapus
                // $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                // return $btn;

                $btn = '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
        $user = UserModel::select('user_id', 'nama')->get();

        return view('stok.create_ajax')->with([
            'barang' => $barang,
            'supplier' => $supplier,
            'user' => $user,
        ]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_id' => ['required', 'integer'],
                'barang_id' => ['required', 'integer'],
                'user_id' => ['required', 'integer'],
                'stok_tanggal' => ['required', 'date'],
                'stok_jumlah' => ['required', 'integer'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            StokModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        }
        redirect('/');
    }

    public function edit_ajax($id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
        $user = UserModel::select('user_id', 'nama')->get();

        return view('stok.edit_ajax')->with([
            'stok' => $stok,
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
