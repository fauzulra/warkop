<?php

use App\Http\Controllers\InvetarisController;
use App\Http\Controllers\MenuControlller;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiControlller;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function () {
    return view('dashboard');
});

// Inventaris
Route::get('/inventaris', [InvetarisController::class, 'index']) -> name('inventaris.index');
Route::get('/inventaris-create', [InvetarisController::class, 'create']) -> name('inventaris.create');
Route::post('/inventaris-create/store', [InvetarisController::class, 'store']) -> name('inventaris.store');
Route::get('/inventaris/check', [InvetarisController::class, 'check'])->name('inventaris.check');
Route::get('/inventaris/{id}/edit', [InvetarisController::class, 'edit'])->name('inventaris.edit');
Route::put('/inventaris/{id}', [InvetarisController::class, 'update'])->name('inventaris.update');
Route::delete('/inventaris/{id}', [InvetarisController::class, 'destroy'])->name('inventaris.destroy');

// Transaksi
Route::get('/transaksi',[TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi',[TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');


// Menu
Route::get('/menu',[MenuControlller::class,  'index']) -> name('menu.index');
Route::get('/menu/create',[MenuControlller::class, 'create']) -> name('menu.create');
Route::post('/menu/create/store',[MenuControlller::class, 'store']) -> name('menu.store');
Route::delete('/menu/{id}', [MenuControlller::class, 'destroy'])->name('menu.destroy');