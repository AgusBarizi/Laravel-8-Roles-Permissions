<?php

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

Route::get('/cek_role', function () {
    $user = auth()->user();
    $cek = $user->hasRole('super admin');
    \dd($cek);
});

Route::get('/cek_permission', function () {
    $user = auth()->user();
    $cek = $user->can('create posts');
    \dd($cek);
});

Route::get('/give_permission', function () {
    $user = auth()->user();
    $cek = $user->givePermissionTo(['delete posts']);
    \dd($cek);
});

Route::get('/revoke_permission', function () {
    $user = auth()->user();
    $cek = $user->revokePermission(['delete posts']);
    \dd($cek);
});

Route::get('/refresh_permission', function () {
    $user = auth()->user();
    $cek = $user->refreshPermission(['create posts','edit posts','delete posts']);
    \dd($cek);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
