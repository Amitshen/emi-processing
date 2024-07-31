<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [AdminController::class, 'index'])->middleware('auth');
Route::get('/loan-details', [AdminController::class, 'loanDetails'])->middleware('auth');
Route::get('/process-data', [AdminController::class, 'processData'])->middleware('auth');
Route::post('/process-data', [AdminController::class, 'processDataPost'])->middleware('auth');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');