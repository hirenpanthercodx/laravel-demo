<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () { return view('Auth.Login'); });
Route::get('/welcome', function () { return view('welcome'); });

Route::middleware('authenticate')->group(function () {
    Route::get('/login', function () { return view('Auth.Login'); });
    Route::get('/register', function () { return view('Auth.Register'); });
});

Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('session')->group(function () {
    Route::get('/dashboard/addRecord', function () { return view('Dashboard.addRecord'); });
    Route::get('/dashboard/edit/{id}', [AdminController::class, 'editRecord']);

    Route::get('/employee/addPost', function () { return view('Employee.addPost'); });
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'editPost']);

    Route::get('/dashboard', [AdminController::class, 'dashboardData']);
    Route::get('/employee', [EmployeeController::class, 'employeeDashboardData']);

    Route::post('/user/store', [AdminController::class, 'store']);
    Route::post('/user/update', [AdminController::class, 'update']);
    Route::get('/user/delete/{id}', [AdminController::class, 'delete']);

    Route::post('/create/post', [EmployeeController::class, 'store']);
    Route::post('/update/post/{id}', [EmployeeController::class, 'update']);
    Route::get('/delete/post/{id}', [EmployeeController::class, 'delete']);


});
