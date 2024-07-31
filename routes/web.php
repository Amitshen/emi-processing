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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', 'login');


Route::middleware('auth')->group(function () {
    Route::get('/home', [AdminController::class, 'index']);
    Route::get('/loan-details', [AdminController::class, 'loanDetails']);
    Route::get('/process-data', [AdminController::class, 'processData']);
    Route::post('/process-data', [AdminController::class, 'processDataPost']);
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');