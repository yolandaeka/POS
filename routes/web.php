<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// // route home
// Route::get('/', [HomeController::class, 'Home']);

// // route profucts
// Route::get('/products', [ProductsController::class, 'Products'])->name('products.products');

// // route CATEGORY
// Route::prefix('category')->group(function(){
//     Route::get('/food-beverage', [ProductsController::class, 'foodBeverage'])->name('products.food_beverage');
//     Route::get('/beauty-health', [ProductsController::class, 'beautyHealth'])->name('products.beauty_health');
//     Route::get('/home-care', [ProductsController::class, 'homeCare'])->name('products.home_care');
//     Route::get('/baby-kid', [ProductsController::class, 'babyKid'])->name('products.baby_kid');

//     }
// );

// // route user
// Route::get('/user/{id}/name/{name}', [UserController::class, 'User'])->name('user.profile');

// // route sales
// Route::get('/sales', [SalesController::class, 'Sales'])->name('sales.sales');


// route level
// Route::get('/level', [LevelController::class, 'index']);

// // route kategori
// Route::get('/kategori', [KategoriController::class, 'index']);



// // route user
// Route::get('/user/tambah', [UserController::class, 'tambah']);

// // route user simpan
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// // route user update
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// // route ubah simpan
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// // route ubah simpan
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function(){
    Route::get('/', [UserController::class, 'index']);  // menampilkan halaman user
    Route::post('/list', [UserController::class, 'list'] );    //menampilkan data user dalam bentuk json datatables
    Route::get('/create', [UserController::class, 'create']);  //menampilkan halaman tambah user
    Route::post('/', [UserController::class,'store']);      //menyimpan data user baru
    // Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detai user
    Route::get('/{id}/edit', [UserController::class, 'edit']);        //menampilkan halaman form user edit
    Route::put('/{id}', [UserController::class, 'update']);         //menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']);     //mengahpus data user
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); //Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax 
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/list',[LevelController::class,'list']);   //menampilkan data level dalam bentuk json
    Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);         // menyimpan data level baru
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
    Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/list',[KategoriController::class,'list']);   //menampilkan data Kategori dalam bentuk json
    Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah Kategori
    Route::post('/', [KategoriController::class, 'store']);         // menyimpan data Kategori baru
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit Kategori
    Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data Kategori
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data Kategori
});

Route::group(['prefix' => 'supplier'], function(){
    Route::get('/', [SupplierController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/list',[SupplierController::class,'list']);   //menampilkan data Supplier dalam bentuk json
    Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah Supplier
    Route::post('/', [SupplierController::class, 'store']);         // menyimpan data Supplier baru
    Route::get('/{id}/edit', [SupplierController::class, 'edit']); // menampilkan halaman form edit Supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data Supplier
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data Supplier
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/list',[BarangController::class,'list']);   //menampilkan data Barang dalam bentuk json
    Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah Barang
    Route::post('/', [BarangController::class, 'store']);         // menyimpan data Barang baru
    Route::get('/{id}/edit', [BarangController::class, 'edit']); // menampilkan halaman form edit Barang
    Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data Barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data Supplier
});
