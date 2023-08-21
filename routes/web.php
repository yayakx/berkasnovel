<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main;
use App\Http\Controllers\user;
use App\Http\Controllers\api;

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
Route::get('/updaterss', [main::class, 'update_rss'])->name('update_rss');
Route::post('/req_ft', [main::class, 'req_ft'])->name('req_ft');
Route::get('/list_reqft', [main::class, 'list_reqft'])->name('list_reqft');
Route::post('/update_reqft', [main::class, 'update_reqft'])->name('update_reqft');
Route::get('/', [main::class, 'main'])->name('main');
Route::get('/carinovel', [main::class, 'carinovel']);
Route::get('/carift', [main::class, 'carift']);
Route::get('/daftarft', [main::class, 'daftarft']);
Route::get('/login', [user::class, 'login'])->name('login');
Route::post('/p_login', [user::class, 'p_login'])->name('p_login');
Route::get('/daftar', [user::class, 'daftar'])->name('daftar');
Route::post('/p_daftar', [user::class, 'p_daftar'])->name('p_daftar');
Route::get('/logout', [user::class, 'logout'])->name('logout');
Route::get('/profil', [main::class, 'private'])->name('private');
Route::get('/private', [main::class, 'private'])->name('private');
Route::post('/carift_private', [main::class, 'carift_private'])->name('carift_private');
Route::post('/tambahft_private', [main::class, 'tambahft_private'])->name('tambahft_private');
Route::get('/ft', [main::class, 'singleFT']);

// API ROute
Route::get('/api/post', [api::class, 'get_data'])->name('get_data_api');
Route::get('/api/listft', [api::class, 'get_listft'])->name('get_data_listft');
Route::get('/api/ft/{kw}', [api::class, 'get_ft'])->name('get_data_ft');
Route::get('/api/isi/{link}', [api::class, 'get_isi'])->name('get_data_isi');
Route::get('/api/cari/{kw}', [api::class, 'get_cari'])->name('get_data_cari');
Route::get('/api/fav/{kw}', [api::class, 'get_fav'])->name('get_data_fav');
Route::get('/api/ver', [api::class, 'get_ver'])->name('get_data_ver');
Route::get('/api/dibaca/{id}', [api::class, 'set_dibaca'])->name('set_data_dibaca');
