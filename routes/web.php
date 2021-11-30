<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Inertia\Inertia;

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





Route::resource('users', UserController::class);
Route::resource('organizations', OrganizationController::class);





Route::get('/', function () {
    return view('welcome');
});
