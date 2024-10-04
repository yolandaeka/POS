<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
       // Ambil data kategori
       $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

       // Return data untuk DataTables
       return DataTables::of($kategoris)
           ->addIndexColumn() // menambahkan kolom index / nomor urut
           ->addColumn('aksi', function ($kategori) {
               // Menambahkan kolom aksi untuk edit, detail, dan hapus
               // $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
               // $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
               // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">'
               //     . csrf_field() . method_field('DELETE') .
               //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
               // return $btn;

               $btn = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
               $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
               $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

               return $btn;
           })
           ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
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

 // 1. public function create_ajax()
 public function create_ajax()
 {
     return view('kategori.create_ajax');
 }

 // 2. public function store_ajax(Request $request)
 public function store_ajax(Request $request)
 {
     // cek apakah request berupa ajax
     if ($request->ajax() || $request->wantsJson()) {
         $rules = [
             'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode',
             'kategori_nama' => 'required|string|max:100'
         ];
         // use Illuminate\Support\Facades\Validator;
         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             return response()->json([
                 'status' => false, // response status, false: error/gagal, true: berhasil
                 'message' => 'Validasi Gagal',
                 'msgField' => $validator->errors() // pesan error validasi
             ]);
         }
         KategoriModel::create($request->all());
         return response()->json([
             'status' => true,
             'message' => 'Data kategori berhasil disimpan'
         ]);
     }
     return redirect('/');
 }

 // 3. public function edit_ajax(string $id)
 public function edit_ajax(string $id)
 {
     $kategori = KategoriModel::find($id);
     return view('kategori.edit_ajax', ['kategori' => $kategori]);
 }

 // 4. public function update_ajax(Request $request, $id)
 public function update_ajax(Request $request, $id)
 {
     // cek apakah request dari ajax
     if ($request->ajax() || $request->wantsJson()) {
         $rules = [
             'kategori_kode' => 'required|max:20|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
             'kategori_nama' => 'required|max:100'
         ];
         // use Illuminate\Support\Facades\Validator;
         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
             return response()->json([
                 'status' => false, // respon json, true: berhasil, false: gagal
                 'message' => 'Validasi gagal.',
                 'msgField' => $validator->errors() // menunjukkan field mana yang error
             ]);
         }
         $check = KategoriModel::find($id);
         if ($check) {
             $check->update($request->all());
             return response()->json([
                 'status' => true,
                 'message' => 'Data berhasil diupdate'
             ]);
         } else {
             return response()->json([
                 'status' => false,
                 'message' => 'Data tidak ditemukan'
             ]);
         }
     }
     return redirect('/');
 }

 // 5. public function confirm_ajax(string $id)
 public function confirm_ajax(string $id)
 {
     $kategori = KategoriModel::find($id);
     return view('kategori.confirm_ajax', ['kategori' => $kategori]);
 }

 // 6. public function delete_ajax(Request $request, $id)
 public function delete_ajax(Request $request, $id)
 {
     // cek apakah request dari ajax
     if ($request->ajax() || $request->wantsJson()) {
         $kategori = KategoriModel::find($id);
         if ($kategori) {
             $kategori->delete();
             return response()->json([
                 'status' => true,
                 'message' => 'Data berhasil dihapus'
             ]);
         } else {
             return response()->json([
                 'status' => false,
                 'message' => 'Data tidak ditemukan'
             ]);
         }
     }
     return redirect('/');
 }
}
