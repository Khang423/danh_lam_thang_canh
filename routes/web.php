<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/login', [AdminAuthController::class, 'index']) 
    ->middleware('checkLoginAdmin')
    ->name('admin.loginView');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['admin']
], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
