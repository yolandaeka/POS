<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(){
        
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object)[
            'title' => 'Daftar Supplier yang terdaftar dalam sistem'
        ];

        $supplier = SupplierModel::all();  //ambil data supplier untuk filter supplier

        $activeMenu = 'supplier'; //set menu yang sedang active

        return view('supplier.index_supplier', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu]);
          
    }    

    public function list(Request $request)
    {
        $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->with('supplier');

        // filtwe data user berdasarkan supplier_id
        if($request->supplier_id){
            $suppliers->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($suppliers)
            // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            // Menambahkan kolom aksi (tombol Detail, Edit, Hapus)
            ->addColumn('aksi', function ($supplier) {
                $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">'
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
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Supplier Baru'
        ];

        $activeMenu = 'supplier'; //set menu yang sedang aktif

        return view('supplier.create_supplier', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request){
        
        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'supplier_nama' => 'required|string|min:3|max:100',
                'supplier_kode' => 'required|string|min:3|max:10|unique:m_supplier,supplier_kode',
                'supplier_alamat' => 'required|string|min:5|max:255',
            ]
            );

        // Mengubah username menjadi kapital
        $supplier_kode = strtoupper($request->supplier_kode);

        SupplierModel::create([
            'supplier_nama' =>$request->supplier_nama,
            'supplier_kode' => $supplier_kode,
            'supplier_alamat' =>$request->supplier_alamat
        ]);

        return redirect('/supplier')->with('success', 'Data user berhasil disimpan');
    }

    public function edit(string $id){
        
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Supplier'
        ];

        $activeMenu = 'supplier'; //set menu yang sedang aktif

        return view('supplier.edit_supplier', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request,string $id){

        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'supplier_nama' => 'required|string|min:3|max:100',
                'supplier_kode' => 'required|string|min:3|max:10|unique:m_supplier,supplier_kode,'.$id.',supplier_id',
                'supplier_alamat' => 'required|string|min:5|max:255',
            ]
            );
        
            // Mengubah username menjadi kapital
        $supplier_kode = strtoupper($request->supplier_kode);

        SupplierModel::find($id)->update([
            'supplier_nama' =>$request->supplier_nama,
            'supplier_kode' => $supplier_kode,
            'supplier_alamat' =>$request->supplier_alamat
        ]);


        return redirect('/supplier')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id){

        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error', 'Data supplier Tidak ditemukan');
        }

        try{
            SupplierModel::destroy($id);

            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang berkaitan');
        }
    }


}
