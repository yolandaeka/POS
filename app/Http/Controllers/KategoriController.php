<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class KategoriController extends Controller
{
   public function index(){

    // 
    // $data = [
    //     'kategori_kode' => 'SNK',
    //     'kategori_nama' => 'Snack/Makanan Ringan',
    //     'created_at' => now()
    // ];

    // DB::table('M_KATEGORI')->insert($data);
    // return 'Insert data baru berhasil';

    // query update
    // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
    // return 'Update data berhasil. Jumlah data yang diupdate: ' .$row. ' baris';

    // query delete
    // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
    // return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row. ' baris';

    // query select
    $data = DB::table('m_kategori')->get();
    return view('kategori', ['data' => $data]);
   }
}
