<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(UserController::class)->group(function(){
    Route::get('users/trash','trash')->name('users.trash');
    Route::post('users/{id}/restore','restore')->name('users.restore');
    Route::delete('users/{id}/delete','delete')->name('users.delete');
});

Route::resource('users',UserController::class);
