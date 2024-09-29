<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\LevelModel;

class LevelController extends Controller
{
    // public function index(){
    //     // query insert
    //     // DB::insert('INSERT INTO m_level(level_kode, level_nama,created_at) VALUES(?,?,?)', ['CUS', 'Pelanggan', now()]);

    //     // return 'insert data baru';

    //     // query update
    //     // $row = DB::update('UPDATE m_level SET level_nama = ? WHERE level_kode = ?' , ['Customer', 'CUS']);
    //     // return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris';

    //     // query delete
    //     // $row = DB::delete('DELETE FROM m_level WHERE level_kode = ?', ['CUS']);
    //     // return 'Delete data berhasil. Jumlah data yang dihapus: '.$row. ' baris';

    //     // query select
    //     $data = DB::select('SELECT * FROM m_level');
    //     return view('level', ['data' =>$data]);
    // }

    public function index(){
        
        $breadcrumb = (object) [
            'title' => 'Daftar level',
            'list' => ['Home', 'level']
        ];

        $page = (object)[
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $level = LevelModel::all();  //ambil data level untuk filter level

        $activeMenu = 'level'; //set menu yang sedang active

        return view('level.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu]);
          
    }    

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama')
            ->with('level');

        // filtwe data user berdasarkan level_id
        if($request->level_id){
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
            // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            // Menambahkan kolom aksi (tombol Detail, Edit, Hapus)
            ->addColumn('aksi', function ($level) {
                $btn = '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
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
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Level Baru'
        ];

        $level = LevelModel::all();     //ambil data level untuk ditampilkan di form

        $activeMenu = 'level'; //set menu yang sedang aktif

        return view('level.create_level', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request){
        
        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'level_nama' => 'required|string|min:3|max:100',
                'level_kode' => 'required|string|min:3|max:10|unique:m_level,level_kode',
            ]
            );

        // Mengubah username menjadi kapital
        $level_kode = strtoupper($request->level_kode);

        LevelModel::create([
            'level_nama' =>$request->level_nama,
            'level_kode' => $level_kode
        ]);

        return redirect('/level')->with('success', 'Data user berhasil disimpan');
    }

    public function edit(string $id){
        
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif

        return view('level.edit_level', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request,string $id){

        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'level_nama' => 'required|string|min:3|max:100',
                'level_kode' => 'required|string|min:3|max:10|unique:m_level,level_kode,'.$id.',level_id',
            ]
            );
        
            // Mengubah username menjadi kapital
        $level_kode = strtoupper($request->level_kode);

        LevelModel::find($id)->update([
            'level_nama' =>$request->level_nama,
            'level_kode' => $level_kode
        ]);


        return redirect('/level')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id){

        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data Level Tidak ditemukan');
        }

        try{
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data Level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            
            return redirect('/level')->with('error', 'Data Level gagal dihapus karena masih terdapat tabel lain yang berkaitan');
        }
    }

}
