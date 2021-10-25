<?php

use App\Http\Controllers\Teller\{
    AMTController,
    DepositController
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

Route::resource('deposit', DepositController::class)->only(['index', 'store']);

Route::get('amt/mutation/{mutation}', [AMTController::class, 'search'])->name('amt.search');
Route::resource('amt', AMTController::class)->only(['index', 'store', 'update']);