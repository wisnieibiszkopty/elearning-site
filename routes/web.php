<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('index');
});

// Routes for user authentication
Route::get('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login']);

// methods below have empty bodies now, to serve app comment them
// Route::post('/auth/login', UserController::class, 'auth');
// Route::post('/auth/logout', [UserController::class, 'logout']);
// Route::post('/auth/register', [UserController::class, 'store']);

// // Routes for managing users
// Route::get('/user/{id}', [UserController::class], 'show');
// Route::get('/user/{id}/edit', [UserController::class], 'edit');
// Route::put('/user/{id}', [UserController::class, 'update']);
// Route::delete('/user/{id}', [UserController::class, 'destroy']);

// // Routes for managing courses
// Route::get('/course/create', [CourseController::class, 'create']);
// Route::post('/course', [CourseController::class, 'store']);
Route::get('/course', [CourseController::class, 'index']);
// Route::get('/course/{id}', [CourseController::class, 'show']);
// Route::get('/course/{id}/edit', [UserController::class, 'edit']);
// Route::put('/course/{id}', [CourseController::class, 'update']);
// Route::delete('/course/{id}', [CourseController::class, 'destroy']);
