<?php

use App\Http\Controllers\User\{
    HistoryController,
    MutationController,
    QRController,
    TransferController,
    WithdrawController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('withdraw', WithdrawController::class)->only(['create', 'store', 'show']);
Route::resource('mutations', MutationController::class)->only(['index', 'show']);

Route::get('history', [HistoryController::class, 'index'])->name('history.index');
Route::get('history/range', [HistoryController::class, 'range'])->name('history.range');

Route::get('qr', [QRController::class, 'index'])->name('qr.index');

Route::prefix('transfer')->name('transfer.')->group(function () {
    Route::get('/scan', [TransferController::class, 'scan'])->name('scan');
    Route::get('/accounts', [TransferController::class, 'accounts'])->name('accounts');
    Route::get('/merchant', [TransferController::class, 'merchant'])->name('merchant');

    Route::get('create/{account}', [TransferController::class, 'create'])->name('create');
});
Route::resource('transfer', TransferController::class)->only(['index', 'store']);