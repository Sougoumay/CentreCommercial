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

Route::group(['prefix'=>'/admin','middleware'=>'IsAdmin'], function(){
    Route::get('/show/product',[AdminController::class,'adminShowProduct'])->name('admin.showProduct');
    Route::get('/show/user',[AdminController::class,'showUser'])->name('admin.showUser');
    Route::get('/show/userById/{id}',[AdminController::class,'showUserById'])->name('admin.showUserById')->where(['id'=>'[0-9]+']);
    Route::post('/show/statusPost/{id}',[AdminController::class,'updateStatusShowGetPost'])->name('admin.statuspost')->where(['id'=>'[0-9]+']);
    Route::get('/delete/user/{id}',[AdminController::class,'deleteUser'])->name('admin.deleteUser')->where(['id'=>'[0-9]+']);
    Route::get('/delete/product/{id}',[AdminController::class,'deleteProduct'])->name('admin.deleteProduct')->where(['id'=>'[0-9]+']);
    Route::view('/principale','layouts.adminPrincipale');
});

Route::group(['prefix'=>'/user','middleware'=>'IsUser'], function(){
   Route::get('/show/product',[AdminController::class,'userShowProduct'])->name('user.showProduct');
   Route::get('/add/product',[AdminController::class,'addProduct'])->name('user.addProduct');
});

Route::view('/register','register')->name('register');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
