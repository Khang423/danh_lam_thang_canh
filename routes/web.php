<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\CategoryTuorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\admin\DetailBillController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\admin\TourController;
use App\Http\Controllers\Outside\HomeController;
use App\Models\DetailBill;
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
        Route::post('/location/getDataForId', [TourController::class, 'getDataForId'])->name('admin.list-location.getDataForId');

        //tour
        Route::get('/tour', [TourController::class, 'index'])->name('admin.tuor');
        Route::get('/tour/getList', [TourController::class, 'getList'])->name('admin.tour.getList');
        Route::post('/tour/store', [TourController::class, 'store'])->name('admin.tour.store');
        Route::get('/tour/getDataForUpdate', [TourController::class, 'getDataForUpdate'])->name('admin.tour.getDataForUpdate');
        Route::post('/tour/update', [TourController::class, 'update'])->name('admin.tour.update');
        Route::post('/tour/delete', [TourController::class, 'delete'])->name('admin.tour.delete');
        Route::get('/tour/getAllData', [TourController::class, 'getAllData'])->name('admin.tour.getAllData');
        Route::post('/tour/getAllDataForMap', [TourController::class, 'getAllDataForMap'])->name('admin.tour.getAllDataForMap');
        Route::post('/tour/getDataForId', [TourController::class, 'getDataForId'])->name('admin.tour.getDataForId');

        // invoice
        Route::get('/detail_bill', [DetailBillController::class, 'index'])->name('admin.detail_bill');
        Route::get('/detail_bill/getList', [DetailBillController::class, 'getList'])->name('admin.detail_bill.getList');
        Route::post('/detail_bill/store', [DetailBillController::class, 'store'])->name('admin.detail_bill.store');
        Route::post('/detail_bill/getDataForUpdate', [DetailBillController::class, 'getDataForUpdate'])->name('admin.detail_bill.getDataForUpdate');
        Route::post('/detail_bill/update', [DetailBillController::class, 'update'])->name('admin.detail_bill.update');
        Route::post('/detail_bill/delete', [DetailBillController::class, 'delete'])->name('admin.detail_bill.delete');
        Route::get('/detail_bill/getDataForChart', [DetailBillController::class, 'getDataForChart'])->name('admin.detail_bill.getDataForChart');
        Route::post('/detail_bill/searchChart', [DetailBillController::class, 'searchChart'])->name('admin.detail_bill.searchChart');

        // booking 
        Route::get('/bill', [BillController::class, 'index'])->name('admin.bill');
        Route::get('/bill/getList', [BillController::class, 'getList'])->name('admin.bill.getList');
        Route::post('/bill/store', [BillController::class, 'store'])->name('admin.bill.store');
        Route::get('/bill/getDataForUpdate', [BillController::class, 'getDataForUpdate'])->name('admin.bill.getDataForUpdate');
        Route::post('/bill/update', [BillController::class, 'update'])->name('admin.bill.update');
        Route::post('/bill/delete', [BillController::class, 'delete'])->name('admin.bill.delete');
        Route::post('/bill/getDataForChart', [BillController::class, 'getDataForChart'])->name('admin.bill.getDataForChart');
        Route::post('/bill/searchChart', [BillController::class, 'searchChart'])->name('admin.bill.searchChart');
        //category tuor
        Route::get('/category', [CategoryTuorController::class, 'index'])->name('admin.category');
        Route::get('/category/getList', [CategoryTuorController::class, 'getList'])->name('admin.category.getList');
        Route::post('/category/delete', [CategoryTuorController::class, 'delete'])->name('admin.category.delete');
        Route::post('/category/store', [CategoryTuorController::class, 'store'])->name('admin.category.store');
        Route::post('/category/update', [CategoryTuorController::class, 'update'])->name('admin.category.update');
        Route::get('/category/getAllData', [CategoryTuorController::class, 'getAllData'])->name('admin.category.getAllData');

        // customer 
        Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer');
        Route::get('/customer/getAllData', [CustomerController::class,'getAllData'])->name('admin.customer.getAllData');
        Route::get('/customer/getList', [CustomerController::class, 'getList'])->name('admin.customer.getList');
        Route::post('/customer/delete', [CustomerController::class, 'delete'])->name('admin.customer.delete');
        Route::post('/customer/store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::post('/customer/update', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::get('/customer/getAllData', [CustomerController::class, 'getAllData'])->name('admin.customer.getAllData');
        // logout
        Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    },
);
