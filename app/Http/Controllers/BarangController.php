<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KategoriModel;


class BarangController extends Controller
{
    public function index(){
        
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object)[
            'title' => 'Daftar Barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; //set menu yang sedang active

        $kategori = KategoriModel::all();  //ambil data kategori untuk filter kategori

        return view('barang.index_barang', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu]);
          
    }    

    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id','kategori_id' ,'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
            ->with('barang');

        // filtwe data barang berdasarkan level_id
        if($request->kategori_id){
            $barangs->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barangs)
            // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            // Menambahkan kolom aksi (tombol Detail, Edit, Hapus)
            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            // Memberitahu bahwa kolom aksi berisi HTML
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create(){

        $breadcrumb = (object)[
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Barang Baru'
        ];

        $kategori = KategoriModel::all();     //ambil data kategori untuk ditampilkan di form

        $activeMenu = 'barang'; //set menu yang sedang aktif

        return view('barang.create_barang', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request){
        
        $request->validate(
            [
                'barang_kode' => 'required|string|min:3|max:10|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|max:100',
                'harga_beli' => 'required|integer',
                'harga_jual' => 'required|integer',
                'kategori_id' => 'required|integer'
            ]
            );

        $barang_kode = strtoupper($request->barang_kode);

        BarangModel::create([
            'barang_kode' =>$barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function edit(string $id){
        
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang'; //set menu yang sedang aktif

        return view('barang.edit_barang', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'kategori' => $kategori,
            'barang' => $barang,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request,string $id){

        $request->validate(
            [
                'barang_kode' => 'required|string|min:3|max:10|unique:m_barang,barang_kode,'.$id.',barang_id',
                'barang_nama' => 'required|string|max:100',
                'harga_beli' => 'required|integer',
                'harga_jual' => 'required|integer',
                'kategori_id' => 'required|integer'
            ]
            );

            $barang_kode = strtoupper($request->barang_kode);

            BarangModel::find($id)->update([
                'barang_kode' =>$barang_kode,
                'barang_nama' => $request->barang_nama,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'kategori_id' => $request->kategori_id
            ]);

        return redirect('/barang')->with('success', 'Data Barang berhasil diubah');
    }

    
    public function destroy(string $id){

        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang Tidak ditemukan');
        }

        try{
            BarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang berkaitan');
        }
    }
}
