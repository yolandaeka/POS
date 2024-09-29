<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
   // public function index(){

   //  // 
   //  // $data = [
   //  //     'kategori_kode' => 'SNK',
   //  //     'kategori_nama' => 'Snack/Makanan Ringan',
   //  //     'created_at' => now()
   //  // ];

   //  // DB::table('M_KATEGORI')->insert($data);
   //  // return 'Insert data baru berhasil';

   //  // query update
   //  // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
   //  // return 'Update data berhasil. Jumlah data yang diupdate: ' .$row. ' baris';

   //  // query delete
   //  // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
   //  // return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row. ' baris';

   //  // query select
   //  $data = DB::table('m_kategori')->get();
   //  return view('kategori', ['data' => $data]);
   // }


   public function index(){
        
      $breadcrumb = (object) [
          'title' => 'Daftar Kategori',
          'list' => ['Home', 'Kategori']
      ];

      $page = (object)[
          'title' => 'Daftar Kategori yang terdaftar dalam sistem'
      ];

      $activeMenu = 'kategori'; //set menu yang sedang active

      $kategori = KategoriModel::all();  //ambil data kategori untuk filter kategori

      return view('kategori.index_kategori', [
          'breadcrumb' => $breadcrumb, 
          'page' => $page,
          'kategori' => $kategori,
          'activeMenu' => $activeMenu]);
        
  }    

  public function list(Request $request)
  {
      $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama')
          ->with('kategori');

      // filtwe data user berdasarkan kategori_id
      if($request->kategori_id){
          $kategoris->where('kategori_id', $request->kategori_id);
      }

      return DataTables::of($kategoris)
          // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
          ->addIndexColumn()
          // Menambahkan kolom aksi (tombol Detail, Edit, Hapus)
          ->addColumn('aksi', function ($kategori) {
              $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
              $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">'
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
       'title' => 'Tambah Kategori',
       'list' => ['Home', 'Kategori', 'Tambah']
   ];

   $page = (object)[
       'title' => 'Tambah Kategori Baru'
   ];

   $activeMenu = 'kategori'; //set menu yang sedang aktif

   return view('kategori.create_kategori', [
       'breadcrumb' => $breadcrumb, 
       'page' => $page,
       'activeMenu' => $activeMenu
   ]);
}

public function store(Request $request){
   
   $request->validate(
       [
           // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
           'kategori_nama' => 'required|string|min:3|max:100',
           'kategori_kode' => 'required|string|min:3|max:10|unique:m_kategori,kategori_kode',
       ]
       );

   // Mengubah username menjadi kapital
   $kategori_kode = strtoupper($request->kategori_kode);

   KategoriModel::create([
       'kategori_nama' =>$request->kategori_nama,
       'kategori_kode' => $kategori_kode
   ]);

   return redirect('/kategori')->with('success', 'Data user berhasil disimpan');
}

public function edit(string $id){
        
   $kategori = KategoriModel::find($id);

   $breadcrumb = (object)[
       'title' => 'Edit Kategori',
       'list' => ['Home', 'Kategori', 'Edit']
   ];

   $page = (object)[
       'title' => 'Edit Kategori'
   ];

   $activeMenu = 'kategori'; //set menu yang sedang aktif

   return view('kategori.edit_kategori', [
       'breadcrumb' => $breadcrumb, 
       'page' => $page,
       'kategori' => $kategori,
       'activeMenu' => $activeMenu
   ]);
}

public function update(Request $request,string $id){

   $request->validate(
       [
           // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
           'kategori_nama' => 'required|string|min:3|max:100',
           'kategori_kode' => 'required|string|min:3|max:10|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
       ]
       );
   
       // Mengubah username menjadi kapital
   $kategori_kode = strtoupper($request->kategori_kode);

   KategoriModel::find($id)->update([
       'kategori_nama' =>$request->kategori_nama,
       'kategori_kode' => $kategori_kode
   ]);


   return redirect('/kategori')->with('success', 'Data user berhasil diubah');
}

public function destroy(string $id){

   $check = KategoriModel::find($id);
   if (!$check) {
       return redirect('/kategori')->with('error', 'Data kategori Tidak ditemukan');
   }

   try{
       KategoriModel::destroy($id);

       return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
   } catch (\Illuminate\Database\QueryException $e){
       
       return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang berkaitan');
   }
}
}
