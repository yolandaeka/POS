<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
//     public function index(){

//         $breadcrumb = (object) [
//             'title' => 'Daftar User',
//             'list' => ['Home', 'User']
//         ];

//         $page = (object)[
//             'title' => 'Daftar user yang terdaftar dalam sistem'
//         ];

//         $activeMenu = 'user'; //set menu yang sedang active

//         return view('user.index', [
//             'breadcrumb' => $breadcrumb, 
//             'page' => $page,
//              'activeMenu' => $activeMenu]);




//         // show the data with limit 1
//         // $user = UserModel::find(1);

//         // show the data with limit 1 n constraint
//         // $user = UserModel::where('level_id', 1)->first();

//         // $user = UserModel::firstWhere('level_id', 1);

// // ----------------------------------------------------------------------------------------------

//         // Show one of data based by condition
//         // $user = UserModel::findOr(20, ['username', 'nama'], function() {
//         //     abort(404);
//         // });

// // ----------------------------------------------------------------------------------------------        

//         // Metode findOrFail and firstOrFail akan mengambil hasil pertama dari kueri; 
//         // namun, jika tidak ada hasil yang ditemukan, sebuah Illuminate\Database\Eloquent\ModelNotFoundException akan dilempar
//         // $user = UserModel::where('username', 'manager9')->firstOrFail();
        
// // ----------------------------------------------------------------------------------------------

//         // agregate function like count, mac, min, sum
//         // $user = UserModel::where('level_id', 2)->count();

// // ----------------------------------------------------------------------------------------------

//         // menemukan data yang cocok, if not found they will create one
//         // $user = UserModel::firstOrCreate(
//         //     [
//         //         'username' => 'manager22',
//         //         'nama' => 'Manager Dua Dua',
//         //         'password' => Hash::make('12345'),
//         //         'level_id' => 2
//         //     ],
//         // );

//         // $user = UserModel::firstOrNew(
//         //     [
//         //         'username' => 'manager33',
//         //         'nama' => 'Manager Tiga Tiga',
//         //         'password' => Hash::make('12345'),
//         //         'level_id' => 2
//         //     ],
//         // );

//         // $user->save();

//         // return view('user', ['data' => $user]);
// // ----------------------------------------------------------------------------------------------

//         // $user = UserModel::create(
//         //     [
//         //         'username' => 'manager55',
//         //         'nama' => 'Manager55',
//         //         'password' => Hash::make('12345'),
//         //         'level_id' => 2
//         //     ],
//         // );

//         // $user->username = 'manager12';
//         // $user->save();

//         // $user->isDirty();
//         // $user->isDirty('username');
//         // $user->isDirty('nama');
//         // $user->isDirty(['nama', 'username']);

//         // $user->isClean();
//         // $user->isClean('username');
//         // $user->isClean('nama');
//         // $user->isClean(['nama', 'username']);

        

//         // $user->isDirty();
//         // $user->isClean();
//         // dd($user->isDirty());
        
//         // $user->wasChanged();
//         // $user->wasChanged('username');
//         // $user->wasChanged('username', 'level_id');
//         // $user->wasChanged('nama');
//         // dd($user->wasChanged(['nama', 'username']));

//         // $user = UserModel::with('level')->get();
//         //  return view('user',['data' => $user]);
        
// // ----------------------------------------------------------------------------------------------
//         //  tambah data user
//         // $data = [
//         //     'level_id'=>2,
//         //     'username'=>'manager_tiga',
//         //     'nama'=>'Manager 3',
//         //     'password'=>Hash::make('12345')
//         // ];

//         // UserModel::create($data);

//         // UserModel::insert($data); 

//         // update data user
//         // $data = [
//         //     'nama' => 'Pelanggan Perama',
//         // ];

//         // UserModel::where('username', 'customer-1')->update($data); 


//         // alses model user mmodel
//         //  $user = UserModel::all(); //ambil semua data dari table m_user
//         //  return view('user',['data' => $user]);

        
//     }

//     public function tambah(){
//         return view('user_tambah');
//     }

//     public function tambah_simpan(Request $request)
//     {
//         UserModel::create ([
//                 'username' => $request->username,
//                 'nama' => $request->nama,
//                 'password' => Hash::make('$request->password'),
//                 'level_id' => $request->level_id
//         ]);

//         return redirect('/user');
//     }

//     public function ubah($id) {
//         $user = UserModel::find($id);
//         return view ('user_ubah', ['data' => $user]);
//     }

//     public function ubah_simpan($id, Request $request) {
//         $user = UserModel::find($id);
//         $user->username = $request->username;
//         $user->nama = $request->nama;
//         $user->password = Hash::make($request->password);
//         $user->level_id = $request->level_id;

//         $user->save();

//         return redirect('/user');
//     }

//     public function hapus($id) {
//         $user = UserModel::find($id);
//         $user->delete();
//         return redirect('/user');
//     }


    public function index(){
        
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; //set menu yang sedang active

        $level = LevelModel::all();  //ambil data level untuk filter level

        return view('user.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu]);
          
    }    

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
                    ->with('level');

        //Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                /*$btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/'.$user->user_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';*/
                    $btn = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/').'\')" class="btn btn-info btn-sm">Detail</button> ';
                    $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                    $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create(){

        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah User Baru'
        ];

        $level = LevelModel::all();     //ambil data level untuk ditampilkan di form

        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('user.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request){
        
        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5',
                'level_id' => 'required|integer'
            ]
            );

        UserModel::create([
            'username' =>$request->username,
            'nama' => $request->nama,
            'password' => $request->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(string $id){

        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail User'
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('user.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);

        
    }

    public function edit(string $id){
        
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit User'
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('user.edit', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'level' => $level,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request,string $id){

        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'username' => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
                'nama' => 'required|string|max:100',
                'password' => 'nullable|min:5',
                'level_id' => 'required|integer'
            ]
            );

        UserModel::find($id)->update([
            'username' =>$request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id){

        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data User Tidak ditemukan');
        }

        try{
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data User berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            
            return redirect('/user')->with('error', 'Data User gagal dihapus karena masih terdapat tabel lain yang berkaitan');
        }
    }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
                    ->with('level', $level);
    }

    public function store_ajax(Request $request){
        if ($request->ajax() || $request->wantsJson()) {
            $rules= [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5'
            ];

            // use iluminate/support/facades/validator
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
               return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
               ]);
            }

            UserModel::create($request->all());

            return response()->json([
                'status' =>true,
                'message' => 'Data User berhasil disimpan'
            ]);

        }

        redirect('/');
    }

    public function edit_ajax(string $id){

        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.edit_ajax', ['user'=>$user, 'level' => $level]);
    }

    //Menyimpan perubahan data user AJAX
    public function update_ajax(Request $request, $id){
        //periksa bila request dari ajax atau bukan
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,'.$id.',user_id',
                'nama' => 'required|max:100',
                'password' => 'nullable|min:5|max:20'
            ];

            // use Illuminate\Support\Facades\Validator
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }

            $check = UserModel::find($id);
            if ($check) {
                if(!$request->filled('password') ){ // jika password tidak diisi, maka hapus dari request
                    $request->request->remove('password');
                }

                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id){
        $user = UserModel::find($id);

        return view('user.confirm_ajax', ['user' => $user]);
    }
    
    
    public function delete_ajax(Request $request, $id)
    {
        //cek apakah request dari AJAX
        if ($request->ajax() || $request->wantsJson()){
            $user = UserModel::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

}

