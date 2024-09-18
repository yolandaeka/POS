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

        // Show one of data based by condition
        // $user = UserModel::findOr(20, ['username', 'nama'], function() {
        //     abort(404);
        // });

        // Metode findOrFail and firstOrFail akan mengambil hasil pertama dari kueri; 
        // namun, jika tidak ada hasil yang ditemukan, sebuah Illuminate\Database\Eloquent\ModelNotFoundException akan dilempar
        $user = UserModel::where('username', 'manager9')->firstOrFail();
        return view('user', ['data' => $user]);







        

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
