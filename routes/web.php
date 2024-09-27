<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

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
Route::get('/level', [LevelController::class, 'index']);

// route kategori
Route::get('/kategori', [KategoriController::class, 'index']);

// route user
Route::get('/user', [UserController::class, 'index']);

// route user
Route::get('/user/tambah', [UserController::class, 'tambah']);

// route user simpan
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// route user update
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// route ubah simpan
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// route ubah simpan
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/', [WelcomeController::class, 'index']);

