<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResourceController;
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

// middleware guest redirect to home which is not defined

Route::get('/', function () {
    return view('index');
})->name('home')->middleware('guest');

// Routes for user authentication
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/auth/login', [UserController::class, 'auth'])->middleware('guest');
Route::post('/auth/register', [UserController::class, 'store'])->middleware('guest');
Route::post('/auth/logout', [UserController::class, 'logout'])->middleware('auth');

// Routes for managing users
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::patch('/user/{id}/avatar', [UserController::class, 'avatar'])->middleware('auth');
Route::patch('/user/{id}/password', [UserController::class, 'password'])->middleware('auth');
Route::put('/user/{id}', [UserController::class, 'update']);

// Routes for managing courses
Route::get('/course/create', [CourseController::class, 'create'])->middleware(['auth', 'teacher']);
Route::post('/course', [CourseController::class, 'store'])->middleware(['auth', 'teacher']);
Route::post('/course/join', [CourseController::class, 'join'])->middleware('auth');
Route::get('/course', [CourseController::class, 'index'])->middleware('auth');
Route::get('/course/{id}', [CourseController::class, 'show'])->middleware(['auth', 'member']);
Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->middleware(['auth', 'author']);
Route::patch('/course/{id}/image', [CourseController::class, 'image'])->middleware(['auth', 'author']);
Route::put('/course/{id}', [CourseController::class, 'update'])->middleware(['auth', 'author']);
Route::delete('/course/{id}', [CourseController::class, 'destroy'])->middleware(['auth', 'author']);

// Routes for managing posts
Route::get('/course/{id}/posts', [PostController::class, 'index'])->middleware(['auth', 'member']);
Route::post('/course/{id}/posts/create', [PostController::class, 'store'])->middleware(['auth', 'member']);
Route::put('/course/{id}/posts/{postId}', [PostController::class, 'update'])->middleware(['auth', 'member']);
Route::delete('/course/{id}/posts/{postId}', [PostController::class, 'destroy'])->middleware(['auth', 'member']);

// Routes for managing comments
// not working yet
Route::post('/course/{id}/posts/{postId}/comments/create', [CommentController::class, 'store'])->middleware(['auth', 'member']);
Route::put('/course/{id}/posts/{postId}/comments/{commentId}', [CommentController::class, 'update'])->middleware(['auth', 'member']);
Route::delete('/course/{id}/posts/{postId}/comments/{commentId}', [CommentController::class, 'destroy'])->middleware(['auth', 'member']);

// Routes for managing resources in course
// think about some secuirty rules for uploaded files
Route::get('/course/{id}/resources', [ResourceController::class, 'index'])->middleware(['auth', 'member']);
Route::post('/course/{id}/resources/create', [ResourceController::class, 'store'])->middleware(['auth', 'author']);
Route::put('/course/{id}/resources/{resourceId}', [ResourceController::class, 'update'])->middleware(['auth', 'author']);
Route::delete('/course/{id}/resources/{resourceId}', [ResourceController::class, 'destroy'])->middleware(['auth', 'author']);

// Routes for managing homework
Route::get('/course/{id}/homework', [HomeworkController::class, 'index']);
Route::get('/course/{id}/homework/create', [HomeworkController::class, 'create']);
Route::post('/course/{id}/homework', [HomeworkController::class, 'store']);
Route::get('/course/{id}/homework/{homeworkId}', [HomeworkController::class, 'show']);
Route::get('/course/{id}/homework/{homeworkId}/edit', [HomeworkController::class, 'edit']);
Route::put('/course/{id}/homework/{homeworkId}', [HomeworkController::class, 'update']);
Route::delete('/course/{id}/homework/{homeworkId}', [HomeworkController::class, 'destroy']);
