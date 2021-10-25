<?php

use App\Http\Controllers\User\{MutationController, WithdrawController};
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