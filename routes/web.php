<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('/map', [MapController::class , 'index'])->name('admin.map');
    Route::get('/map/getAllLocation', [MapController::class , 'getAllLocation'])->name('admin.map.getAllLocation');
    Route::post('/map/store', [MapController::class , 'store'])->name('admin.map.store');

    Route::get('/list-location' ,[LocationController::class, 'index'])->name('admin.list-location');
    Route::get('/getList' ,[LocationController::class, 'getList'])->name('admin.list-location.getList');
    Route::post('/delete' ,[LocationController::class, 'delete'])->name('admin.list-location.delete');
    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
