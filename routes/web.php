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

Route::get('/', [main::class, 'main']);
Route::post('/carinovel', [main::class, 'carinovel']);
Route::post('/carift', [main::class, 'carift']);
Route::get('/daftarft', [main::class, 'daftarft']);
Route::get('/login', [user::class, 'login']);
Route::get('/p_login', [user::class, 'p_login'])->name('p_login');

