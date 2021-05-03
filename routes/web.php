<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleLineController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('user', [UserController::class, 'index']);
Route::get('laravel-google-line-chart', [GoogleLineController::class, 'index']);
Route::get('line-chart', [GoogleLineController::class, 'line_chart']);
Route::post('get-data-date', [GoogleLineController::class, 'get_data_by_date'])->name('get_data_date');
Route::get('donut-chart', [GoogleLineController::class, 'donut_chart']);
Route::post('get-date-dount', [GoogleLineController::class, 'get_date_dount'])->name('get_date_dount');

