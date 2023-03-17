<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AdminController;
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
    return view('admin.pages.login');
})->name('admin-pages-login');

Route::get('/history', [HistoryController::class,'index'])->name('admin-pages-history');
Route::get('/admin', [AdminController::class,'index'])->name('admin-pages-admin');