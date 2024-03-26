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

Route::middleware(['session', 'role'])->group(function () {
    Route::get('/admin/addRecord', function () { return view('Dashboard.addRecord'); });
    Route::get('/admin/edit/{id}', [AdminController::class, 'editRecord']);

    Route::get('/employee/addPost', function () { return view('Employee.addPost'); });
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'editPost']);

    Route::get('/admin', [AdminController::class, 'dashboardData']);
    Route::get('/employee', [EmployeeController::class, 'employeeDashboardData']);

    Route::post('/admin/user/store', [AdminController::class, 'store']);
    Route::post('/admin/user/update', [AdminController::class, 'update']);
    Route::get('/admin/user/delete/{id}', [AdminController::class, 'delete']);

    Route::post('/employee/create/post', [EmployeeController::class, 'store']);
    Route::post('/employee/update/post/{id}', [EmployeeController::class, 'update']);
    Route::get('/employee/delete/post/{id}', [EmployeeController::class, 'delete']);
});
