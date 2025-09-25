<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BastController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
   Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/data', [EmployeeController::class, 'getData'])->name('employee.data');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/detai/{id}', [EmployeeController::class, 'detail'])->name('employee.detail');
    Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
    Route::get('/asset/data', [AssetController::class, 'getData'])->name('asset.data');
    Route::get('/asset/create', [AssetController::class, 'create'])->name('asset.create');
    Route::post('/asset/store', [AssetController::class, 'store'])->name('asset.store');
    Route::get('/asset/edit/{id}', [AssetController::class, 'edit'])->name('asset.edit');
    Route::put('/asset/update/{id}', [AssetController::class, 'update'])->name('asset.update');
    Route::get('/asset/destroy/{id}', [AssetController::class, 'destroy'])->name('asset.destroy');
    Route::get('/asset/detail/{id}', [AssetController::class, 'detail'])->name('asset.detail');
    Route::get('/assets/import', [AssetController::class, 'importForm'])->name('asset.import.form');
    Route::post('/assets/import', [AssetController::class, 'import'])->name('asset.import');

    Route::get('asset/{id}/bast/create', [App\Http\Controllers\AssetController::class, 'createBast'])->name('asset.bast.create');
    Route::post('asset/{id}/bast/store', [App\Http\Controllers\AssetController::class, 'storeBast'])->name('asset.bast.store');
    Route::get('/asset/{assetId}/bast/{bastId}/detail', [App\Http\Controllers\AssetController::class, 'bastDetail'])->name('asset.bast.detail');

    Route::get('bast', [App\Http\Controllers\BastController::class, 'index'])->name('bast.index');
    Route::get('bast/data', [App\Http\Controllers\BastController::class, 'data'])->name('bast.data');
    Route::get('bast/{id}/detail', [App\Http\Controllers\BastController::class, 'detail'])->name('bast.detail');
    Route::delete('bast/{id}/delete', [App\Http\Controllers\BastController::class, 'destroy'])->name('bast.destroy');

});

