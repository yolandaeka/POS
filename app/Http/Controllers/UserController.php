<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        // show the data with limit 1
        // $user = UserModel::find(1);

        // show the data with limit 1 n constraint
        // $user = UserModel::where('level_id', 1)->first();

        // $user = UserModel::firstWhere('level_id', 1);

// ----------------------------------------------------------------------------------------------

        // Show one of data based by condition
        // $user = UserModel::findOr(20, ['username', 'nama'], function() {
        //     abort(404);
        // });

// ----------------------------------------------------------------------------------------------        

        // Metode findOrFail and firstOrFail akan mengambil hasil pertama dari kueri; 
        // namun, jika tidak ada hasil yang ditemukan, sebuah Illuminate\Database\Eloquent\ModelNotFoundException akan dilempar
        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        
// ----------------------------------------------------------------------------------------------

        // agregate function like count, mac, min, sum
        // $user = UserModel::where('level_id', 2)->count();

// ----------------------------------------------------------------------------------------------

        // menemukan data yang cocok, if not found they will create one
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user->save();

        // return view('user', ['data' => $user]);
// ----------------------------------------------------------------------------------------------

        $user = UserModel::create(
            [
                'username' => 'manager55',
                'nama' => 'Manager55',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ],
        );

        $user->username = 'manager12';
        $user->save();

        // $user->isDirty();
        // $user->isDirty('username');
        // $user->isDirty('nama');
        // $user->isDirty(['nama', 'username']);

        // $user->isClean();
        // $user->isClean('username');
        // $user->isClean('nama');
        // $user->isClean(['nama', 'username']);

        

        // $user->isDirty();
        // $user->isClean();
        // dd($user->isDirty());
        
        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged('username', 'level_id');
        $user->wasChanged('nama');
        dd($user->wasChanged(['nama', 'username']));
        
// ----------------------------------------------------------------------------------------------
        //  tambah data user
        // $data = [
        //     'level_id'=>2,
        //     'username'=>'manager_tiga',
        //     'nama'=>'Manager 3',
        //     'password'=>Hash::make('12345')
        // ];

        // UserModel::create($data);

        // UserModel::insert($data); 

        // update data user
        // $data = [
        //     'nama' => 'Pelanggan Perama',
        // ];

        // UserModel::where('username', 'customer-1')->update($data); 


        // alses model user mmodel
        //  $user = UserModel::all(); //ambil semua data dari table m_user
        //  return view('user',['data' => $user]);

        
    }
}
