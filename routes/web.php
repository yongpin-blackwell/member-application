<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// 列表顯示所有會員（分頁）
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// 查看特定會員詳細信息，包括地址和文件
Route::get('/users/{user_id}', [UserController::class, 'show'])->name('users.show');

// 註冊新會員
Route::post('/users/register', [UserController::class, 'store'])->name('users.store');

// 編輯現有會員詳細信息（個人詳細信息和地址）
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// 刪除會員
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// 導出會員資料
Route::get('/users/excel/export', [UserController::class, 'export'])->name('users.export');

