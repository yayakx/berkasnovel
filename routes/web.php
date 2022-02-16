<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main;
use App\Http\Controllers\user;

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

Route::get('/', [main::class, 'main'])->name('main');
Route::post('/carinovel', [main::class, 'carinovel']);
Route::post('/carift', [main::class, 'carift']);
Route::get('/daftarft', [main::class, 'daftarft']);
Route::get('/login', [user::class, 'login'])->name('login');
Route::post('/p_login', [user::class, 'p_login'])->name('p_login');
Route::get('/daftar', [user::class, 'daftar'])->name('daftar');
Route::post('/p_daftar', [user::class, 'p_daftar'])->name('p_daftar');
Route::get('/logout', [user::class, 'logout'])->name('logout');

