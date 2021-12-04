<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/index','index');

Route::view('/register','register');

Route::post('create/user',[AdminController::class,'createUser'])->name('createUser');

Route::group(['prefix'=>'admin','middleware'=>'IsAdmin'], function(){
    Route::get('/show/product',[AdminController::class,'adminShowProduct'])->name('admin.showProduct');
    Route::get('/show/user',[AdminController::class,'showUser'])->name('admin.showUser');
    Route::get('/show/userById/{id}',[AdminController::class,'showUserById'])->name('admin.showUserById')->where(['id'=>'[0-9]+']);
    Route::get('/show/statusPost/{id}',[AdminController::class,'updateStatusShowPost'])->name('admin.statuspost')->where(['id'=>'[0-9]+']);
    Route::get('/delete/user/{id}',[AdminController::class,'deleteUser'])->name('admin.deleteUser')->where(['id'=>'[0-9]+']);
    Route::get('/delete/product/{id}',[AdminController::class,'deleteProduct'])->name('admin.deleteProduct')->where(['id'=>'[0-9]+']);
    Route::view('/principale','layouts.adminPrincipale');
    Route::get('/user/export',[AdminController::class,'exportUserByExcel'])->name('exportUserByExcel');
    Route::get('/product/export',[AdminController::class,'exportProductByExcel'])->name('admin.exportProductByExcel');
    Route::get('/amazon/export',[AdminController::class,'exportAmazonByExcel'])->name('exportAmazonByExcel');

});

Route::group(['prefix'=>'user','middleware'=>'IsUser'], function(){
   Route::get('/show/product',[AdminController::class,'userShowProduct'])->name('user.showProduct');
   Route::post('/add/product',[AdminController::class,'addProduct'])->name('user.addProduct');
   Route::get('/add/productView',[AdminController::class,'addProductView'])->name('user.addProductView');
   Route::get('/delete/product/{id}',[AdminController::class,'deleteProduct'])->name('user.deleteProduct')->where(['id'=>'[0-9]+']);
   Route::view('/register/excel/product','User.registerExcelProduct')->name('user.registerExcel');
   Route::post('/create/product/import',[AdminController::class,'createProductByExcelImport'])->name('user.createProductByExcelImport');
   Route::get('/product/export',[AdminController::class,'exportProductByExcel'])->name('user.exportProductByExcel');
});

Route::view('/register','register')->name('register');
Route::view('/register/Excel','registerExcel')->name('registerExcel');
Route::post('/create/user/import',[AdminController::class,'createUserByExcelImport'])->name('createUserByExcelImport');

Route::view('/register/excel/product','user.registerExcelProduct')->name('product.registerExcel');
Route::post('create/product/import',[AdminController::class,'createProductByExcelImport'])->name('createProductByExcelImport');
Route::get('/product/export',[AdminController::class,'exportProductByExcel'])->name('exportProductByExcel');

Route::get('/utilisateurs',[AdminController::class,'productDaysGreatThat50User'])->name('utilisateurs');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
