<?php

use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleAuthController;
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
|   Plan działania:
|   1. Zrób coś z obliczaniem czasu żeby było w oddzielnym pliku
|   2. Naprawić usuwanie plików ze storage
|   3. Poprawić style
|   4. Poprawić query do posts
|   5. Dodać chat
|   8. dziwny problem posty w obrębie jednego paginate są odwrócone ale ogółem to już nie
|   9. Napraw ten jebany layout
*/

Route::get('/', function () {
    return view('index');
})->name('home')->middleware('guest');

Route::middleware('guest')->group(function(){
    // routes for getting forms views
    Route::get('/register', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'login'])->name('login');
    // routes for doing authorization
    Route::post('/auth/login', [UserController::class, 'auth']);
    Route::post('/auth/register', [UserController::class, 'store']);
    Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect']);
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
});

// routes only for authenticated users
Route::middleware('auth')->group(function(){
    Route::post('/auth/logout', [UserController::class, 'logout']);

    // Routes for managing users
    Route::controller(UserController::class)->group(function(){
        Route::get('/user/{id}', 'show');
        Route::delete('/user/{id}', 'destroy');
        Route::get('/user/{id}/edit', 'edit');
        Route::patch('/user/{id}/avatar', 'avatar');
        Route::patch('/user/{id}/password', 'password');
        Route::put('/user/{id}', 'update');
    });

    Route::prefix('course')->group(function(){
        // Routes for managing courses
        Route::controller(CourseController::class)->group(function(){
            Route::post('/join', 'join');
            Route::get('/', 'index');
            Route::get('/create','create')->middleware(['teacher']);
            Route::post('/', 'store')->middleware(['teacher']);
        });
    });

    Route::prefix('/course/{id}')->group(function(){

        // routes for managing specific course
        Route::controller(CourseController::class)->group(function(){
            Route::get('/edit', 'edit')->middleware(['author']);
            Route::patch('/image', 'image')->middleware(['author']);
            Route::put('/', 'update')->middleware(['author']);
            Route::delete('/leave', 'leave')->middleware(['member']);
            Route::delete('/', 'destroy')->middleware(['author']);
        });

        Route::middleware('member')->group(function(){
            // Routes for managing posts
            Route::controller(PostController::class)->group(function(){
                Route::prefix('posts')->group(function(){
                    Route::get('/', 'show');
                    Route::post('/create', 'store');
                    Route::put('/{postId}', 'update');
                    Route::delete('/{postId}', 'destroy');
                });
            });

            // Routes for managing comments
            Route::controller(CommentController::class)->group(function(){
                Route::post('/posts/{postId}/comments/create','store');
                Route::put('/comments/{commentId}', 'update');
                Route::delete('/posts/{postId}/comments/{commentId}', 'destroy');
            });
        });

        // Routes for managing resources in course
        Route::controller(ResourceController::class)->group(function(){
            Route::prefix('/resources')->group(function(){
                Route::get('/', 'index')->middleware(['member']);
                Route::post('/create', 'store')->middleware(['author']);
                Route::put('/{resourceId}', 'update')->middleware(['author']);
                Route::delete('/{resourceId}', 'destroy')->middleware(['author']);
            });
        });

        Route::prefix('/homework')->group(function(){
            // Routes for managing homework
            Route::controller(HomeworkController::class)->group(function(){
                Route::get('/', 'index')->middleware(['member']);
                Route::get('/create', 'create')->middleware(['author']);
                Route::post('/', 'store')->middleware(['author']);
                Route::get('/{homeworkId}', 'show')->middleware(['author']);
                Route::get('/{homeworkId}/edit', 'edit')->middleware(['author']);
                Route::put('/{homeworkId}', 'update')->middleware(['author']);
                Route::delete('/{homeworkId}', 'destroy')->middleware(['author']);
            });

            // Routes for managing task
            Route::controller(TaskController::class)->group(function(){
                Route::get('/{homeworkId}/task', 'show')->middleware(['member']);
                Route::post('/{homeworkId}/task/create', 'create')->middleware(['member']);
                Route::post('/{homeworkId}/task/{taskId}/comment', 'comment')->middleware(['author']);
                Route::delete('/{homeworkId}/task/{taskId}', 'destroy')->middleware(['member']);
                Route::get('/{homeworkId}/download', 'downloadAll')->middleware(['author']);
            });
        });
    });

    // routes for managing chats with users
    Route::controller(ChatController::class)->group(function(){
        // zwraca liste chatow dla danego uzytkownika
        Route::get('/chats', 'index');
        // tworzy nowy chat jesli nie istnieje
        Route::post('/chats/{userId}/create', 'create');
        // zwraca widok z lista wiadomosci i przcyskiem do wysylania
        Route::get('/chats/{chatId}', 'show');
        // rozsyla wiadomosc i zapisuje ja w bazie danych
        Route::post('/chats/{chatId}', 'store');
    });
});

