<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        //  tambah data user
        $data = [
            'level_id'=>2,
            'username'=>'manager_tiga',
            'nama'=>'Manager 3',
            'password'=>Hash::make('12345')
        ];

        UserModel::create($data);

        // UserModel::insert($data); 

        // update data user
        // $data = [
        //     'nama' => 'Pelanggan Perama',
        // ];

        // UserModel::where('username', 'customer-1')->update($data); 


        // alses model user mmodel
         $user = UserModel::all(); //ambil semua data dari table m_user
         return view('user',['data' => $user]);

        
    }
}
