<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvetarisController;
use App\Http\Controllers\MenuControlller;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// Auth (tidak perlu login untuk akses ini)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Semua route di bawah ini WAJIB login dulu
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Inventaris
    Route::get('/inventaris', [InvetarisController::class, 'index'])->name('inventaris.index');
    Route::get('/inventaris-create', [InvetarisController::class, 'create'])->name('inventaris.create');
    Route::post('/inventaris-create/store', [InvetarisController::class, 'store'])->name('inventaris.store');
    Route::get('/inventaris/check', [InvetarisController::class, 'check'])->name('inventaris.check');
    Route::get('/inventaris/print', [InvetarisController::class, 'printReport'])->name('inventaris.print'); 
    Route::get('/inventaris/{id}/edit', [InvetarisController::class, 'edit'])->name('inventaris.edit');
    Route::put('/inventaris/{id}', [InvetarisController::class, 'update'])->name('inventaris.update');
    Route::delete('/inventaris/{id}', [InvetarisController::class, 'destroy'])->name('inventaris.destroy');
    Route::get('/inventaris/{id}/history', [InvetarisController::class, 'history']);

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/print', [TransaksiController::class, 'printReport'])->name('transaksi.print');
    Route::patch('/transaksi/{id}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/transaksi/{id}/edit-order', [TransaksiController::class, 'editOrder'])->name('transaksi.editOrder');
    Route::put('/transaksi/{id}/update-order', [TransaksiController::class, 'updateOrder'])->name('transaksi.updateOrder');
    Route::post('/transaksi/cancel-edit', [TransaksiController::class, 'cancelEdit'])->name('transaksi.cancelEdit');
    Route::get('/transaksi/new-order', [TransaksiController::class, 'newOrder'])->name('transaksi.newOrder');
    

    // Menu
    Route::get('/menu', [MenuControlller::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuControlller::class, 'create'])->name('menu.create');
    Route::post('/menu/create/store', [MenuControlller::class, 'store'])->name('menu.store');
    Route::delete('/menu/{id}', [MenuControlller::class, 'destroy'])->name('menu.destroy');
    Route::get('/menu/{id}/json', [MenuControlller::class, 'getJsonData'])->name('menu.json');
    Route::put('/menu/{id}', [MenuControlller::class, 'update'])->name('menu.update');
});