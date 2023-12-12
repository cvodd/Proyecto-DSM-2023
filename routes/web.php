<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::redirect('/', '/dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/error', [DashboardController::class, 'errorDB'])->name('errorDB');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::put('/admin/toggleUser/{id}', [AdminController::class, 'toggleUser'])->name('admin.update');
Route::get('/admin/getUsers', [AdminController::class, 'searchUser'])->name('admin.searchUser');



