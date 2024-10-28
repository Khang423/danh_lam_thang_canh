<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\CategoryTuorController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\admin\TourController;
use App\Http\Controllers\Outside\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/login', [AdminAuthController::class, 'index'])
    ->middleware('checkLoginAdmin')
    ->name('admin.loginView');

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['admin'],
    ],
    function () {
        // admin
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/map', [MapController::class, 'index'])->name('admin.map');
        Route::get('/map/getAllLocation', [MapController::class, 'getAllLocation'])->name('admin.map.getAllLocation');
        Route::post('/map/store', [MapController::class, 'store'])->name('admin.map.store');
        Route::post('/search', [MapController::class, 'search'])->name('admin.map.search');
        //laction
        Route::get('/location', [LocationController::class, 'index'])->name('admin.list-location');
        Route::get('/location/getList', [LocationController::class, 'getList'])->name('admin.list-location.getList');
        Route::post('/location/delete', [LocationController::class, 'delete'])->name('admin.list-location.delete');
        Route::post('/location/store', [LocationController::class, 'store'])->name('admin.list-location.store');
        Route::get('/location/getDataForUpdate', [LocationController::class, 'getDataForUpdate'])->name('admin.list-location.getDataForUpdate');
        Route::post('/location/update', [LocationController::class, 'update'])->name('admin.list-location.update');
        Route::get('/location/getAllData', [LocationController::class, 'getAllData'])->name('admin.list-location.getAllData');
        //tour
        Route::get('/tour', [TourController::class, 'index'])->name('admin.tuor');
        Route::get('/tour/getList', [TourController::class, 'getList'])->name('admin.tour.getList');
        Route::post('/tour/store', [TourController::class, 'store'])->name('admin.tour.store');
        Route::get('/tour/getDataForUpdate', [TourController::class, 'getDataForUpdate'])->name('admin.tour.getDataForUpdate');
        Route::post('/tour/update', [TourController::class, 'update'])->name('admin.tour.update');
        Route::post('/tour/delete', [TourController::class, 'delete'])->name('admin.tour.delete');
        Route::get('/tour/getAllData', [TourController::class, 'getAllData'])->name('admin.tour.getAllData');

        // invoice
        Route::get('/invoice', [InvoiceController::class, 'index'])->name('admin.invoice');
        Route::get('/invoice/getList', [InvoiceController::class, 'getList'])->name('admin.invoice.getList');
        Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('admin.invoice.store');
        Route::get('/invoice/getDataForUpdate', [InvoiceController::class, 'getDataForUpdate'])->name('admin.invoice.getDataForUpdate');
        Route::post('/invoice/update', [InvoiceController::class, 'update'])->name('admin.invoice.update');
        Route::post('/invoice/delete', [InvoiceController::class, 'delete'])->name('admin.invoice.delete');
        Route::get('/invoice/getDataForChart', [InvoiceController::class, 'getDataForChart'])->name('admin.invoice.getDataForChart');
        Route::post('/invoice/searchChart', [InvoiceController::class, 'searchChart'])->name('admin.invoice.searchChart');

        // booking 
        Route::get('/booking', [BookingController::class, 'index'])->name('admin.booking');
        Route::get('/booking/getList', [BookingController::class, 'getList'])->name('admin.booking.getList');
        Route::post('/booking/store', [BookingController::class, 'store'])->name('admin.booking.store');
        Route::get('/booking/getDataForUpdate', [BookingController::class, 'getDataForUpdate'])->name('admin.booking.getDataForUpdate');
        Route::post('/booking/update', [BookingController::class, 'update'])->name('admin.booking.update');
        Route::post('/booking/delete', [BookingController::class, 'delete'])->name('admin.booking.delete');
        Route::post('/booking/getDataForChart', [BookingController::class, 'getDataForChart'])->name('admin.booking.getDataForChart');

        //category tuor
        Route::get('/category', [CategoryTuorController::class, 'index'])->name('admin.category');
        Route::get('/category/getList', [CategoryTuorController::class, 'getList'])->name('admin.category.getList');
        Route::post('/category/delete', [CategoryTuorController::class, 'delete'])->name('admin.category.delete');
        Route::post('/category/store', [CategoryTuorController::class, 'store'])->name('admin.category.store');
        Route::post('/category/update', [CategoryTuorController::class, 'update'])->name('admin.category.update');
        Route::get('/category/getAllData', [CategoryTuorController::class, 'getAllData'])->name('admin.category.getAllData');

        // logout
        Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    },
);
