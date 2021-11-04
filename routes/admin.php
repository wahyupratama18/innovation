<?php

use App\Http\Controllers\Admin\{
    MerchantController,
    TellerController,
    TellerReportController,
    UserController
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

Route::resource('users', UserController::class)->except(['show', 'edit', 'update']);
Route::resource('merchants', MerchantController::class)->except(['show', 'edit', 'update']);

Route::resource('tellers', TellerController::class);

Route::get('report', [TellerReportController::class, 'index'])->name('report.index');
Route::get('report/range', [TellerReportController::class, 'range'])->name('report.range');