<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Profile;
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
    return view('index');
});

Route::get('/home', function () {
   dd(\Illuminate\Support\Facades\Auth::user());
})->middleware(['auth' , 'verified']);

//User Route

Route::prefix('user')->middleware(['auth'])->name('user.')->group(function (){
    Route::get('profile', Profile::class)->name('profile');
});

//Admin ROute
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function (){
    Route::resource('users', UserController::class);
    Route::post('search', 'App\Http\Controllers\Admin\UserController@search')->name('users.search');
});
