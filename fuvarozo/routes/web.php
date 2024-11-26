<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VehicleController;

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
    return view('home');
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);

Route::post('/admin', [UserController::class, 'admin']);

Route::post('/createjob', [TaskController::class, 'create']);

Route::post('/editJob', [TaskController::class, 'edit']);

Route::post('/deletejob', [TaskController::class, 'delete']);

Route::post('/assignjob', [TaskController::class, 'assignDriver']);

Route::post('/changestatus', [TaskController::class, 'status']);

Route::post('/createvehicle', [VehicleController::class, 'create']);

Route::post('/deletevehicle', [VehicleController::class, 'delete']);

Route::get('/editpage', [TaskController::class, 'editview']);

Route::get('/adminview', [UserController::class, 'adminview']);

Route::get('/driverview', [UserController::class, 'driverview']);