<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WarehouseController;

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
    return view('welcome', [
        'title' => 'Home',
        'judul' => 'Landing Page'
    ]);
})->middleware(['guest']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->middleware(['auth']);
});

Route::get('/dashboard', function () {
    return view('index', [
        'title' => 'Home',
        'judul' => 'Dashboard'
    ]);
})->middleware(['auth']);

Route::resource('/dashboard/warehouse', WarehouseController::class)->middleware(['auth'])->except(['show', 'create', 'edit']);
Route::resource('/dashboard/contract', ContractController::class)->middleware(['auth'])->except(['show']);
Route::resource('/dashboard/service', ServiceController::class)->middleware(['auth'])->except(['show', 'create', 'edit']);
