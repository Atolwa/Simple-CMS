<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Auth;


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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->group(function() {
    Route::get('/login','App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout/', 'App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'App\Http\Controllers\Auth\AdminController@index')->name('admin.dashboard');
   }) ;
   
   Route::resource('contacts', ContactController::class);
   Route::resource('group', GroupController::class);