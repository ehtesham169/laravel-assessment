<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserBalanceController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\StatementController;


Route::get('/login', function () {
    return view('home');
});

Auth::routes();

// Home Controller
Route::get('/', [HomeController::class, 'index'])->name('home');

// Roles CRUD Routes
Route::resource('roles', RoleController::class);

// Users CRUD Routes
Route::resource('users', UserController::class);

// User Balance Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/balances', [UserBalanceController::class, 'index'])->name('balances.index');
    Route::post('/balances', [UserBalanceController::class, 'store'])->name('balances.store');
    Route::get('/balances/{id}', [UserBalanceController::class, 'show'])->name('balances.show');
    Route::put('/balances/{id}', [UserBalanceController::class, 'update'])->name('balances.update');
    Route::delete('/balances/{id}', [UserBalanceController::class, 'destroy'])->name('balances.destroy');

    // Show the deposit form
    Route::get('/deposit', [DepositController::class, 'showForm'])->name('deposit.form');

    // Handle the deposit request
    Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit.store');

    // Show the withdrawal form
    Route::get('/withdraw', [WithdrawController::class, 'showForm'])->name('withdraw.form');

    // Handle the withdrawal request
    Route::post('/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw.store');

    // Show the transfer form
    Route::get('/transfer', [TransferController::class, 'showForm'])->name('transfer.form');

    // Handle the transfer request
    Route::post('/transfer', [TransferController::class, 'transfer'])->name('transfer.store');

    // Show the statement
    Route::get('/statement', [StatementController::class, 'index'])->name('statement.index');    
});




