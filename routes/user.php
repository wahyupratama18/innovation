<?php

use App\Http\Controllers\FindAccountController;
use App\Http\Controllers\User\{
    HistoryController,
    MutationController,
    ProfileViewController,
    QRController,
    ResetTransactionPasswordController,
    TransactionPasswordController,
    TransferController,
    WithdrawController
};
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;

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


Route::get('find/{account}', [FindAccountController::class, 'userFind'])->name('userFinder');
Route::resource('mutations', MutationController::class)->only(['index', 'store', 'show']);

/* Route::get('history', [HistoryController::class, 'index'])->name('history.index');
Route::get('history/range', [HistoryController::class, 'range'])->name('history.range'); */

Route::get('qr', [QRController::class, 'index'])->name('qr.index');

Route::middleware('transaction.password')->group(function () {
    Route::prefix('transfer')->name('transfer.')->group(function () {
        Route::get('/scan', [TransferController::class, 'scan'])->name('scan');
        Route::get('/accounts', [TransferController::class, 'accounts'])->name('accounts');
        Route::get('/merchants', [TransferController::class, 'merchants'])->name('merchants');
    
        Route::get('create/{account}', [TransferController::class, 'create'])->name('create');

        Route::post('/sent', [TransferController::class, 'sent'])->name('sent');
    });
    Route::resource('transfer', TransferController::class)->only(['index', 'store']);
    
    Route::prefix('withdraw')->name('withdraw.')->middleware('withdrawable:exist')
    ->group(function () {
        Route::get('/', [WithdrawController::class, 'show'])->name('show');
        Route::delete('/', [WithdrawController::class, 'destroy'])->name('destroy');
    });
    Route::resource('withdraw', WithdrawController::class)->middleware('withdrawable:empty')->only(['create', 'store']);
});


Route::prefix('user/profile')->name('profile.')->group(function() {

    if (Features::canUpdateProfileInformation()) {
        Route::get('information', [ProfileViewController::class, 'info'])->name('info');
    }

    if (Features::enabled(Features::updatePasswords())) {
        Route::get('password', [ProfileViewController::class, 'password'])->name('password');
    }
    
    if (Features::canManageTwoFactorAuthentication()) {
        Route::get('two-factor', [ProfileViewController::class, 'twoFactor'])->name('two-factor');
    }

    if (Jetstream::hasAccountDeletionFeatures()) {
        Route::get('deletion', [ProfileViewController::class, 'delete'])->name('deletetion');
    }

    Route::get('sessions', [ProfileViewController::class, 'sessions'])->name('sessions');
    Route::prefix('transactpass')->name('transactpass.')->group(function () {
        Route::resource('/', TransactionPasswordController::class)->only(['index', 'store']);
        Route::resource('/forget', ResetTransactionPasswordController::class)->only(['store', 'show']);
    });
});