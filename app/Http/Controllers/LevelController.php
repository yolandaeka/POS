<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;

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
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        // Return data untuk DataTables
        return DataTables::of($levels)
            ->addIndexColumn() // menambahkan kolom index / nomor urut
            ->addColumn('aksi', function ($level) {
                // Menambahkan kolom aksi untuk edit, detail, dan hapus
                // $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                // return $btn;

                $btn = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi berisi HTML
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

    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    // 2. public function store_ajax(Request $request)
    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
                'level_nama' => 'required|string|max:100'
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
            LevelModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    // 3. public function edit_ajax(string $id)
    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', ['level' => $level]);
    }

    // 4. public function update_ajax(Request $request, $id)
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|max:20|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|max:100'
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
            $check = LevelModel::find($id);
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
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', ['level' => $level]);
    }

    // 6. public function delete_ajax(Request $request, $id)
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
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
