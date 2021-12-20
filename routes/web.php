<?php

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

Route::get('/', function () {
    return view('dashboard');
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('/employees', array(App\Http\Controllers\EmployeeController::class, 'index'))->middleware('auth');
Route::get('/companies', array(App\Http\Controllers\CompanyController::class, 'index'))->middleware('auth');

Route::group(['prefix' => 'dashboard'], function() {
    Route::view('/', 'dashboard');
    Route::resource('company', 'App\Http\Controllers\CompanyController')->middleware('auth');
    Route::resource('employee', 'App\Http\Controllers\EmployeeController')->middleware('auth');
});
