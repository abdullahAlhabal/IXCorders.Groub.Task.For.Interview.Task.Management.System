<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/me', [ProfileController::class, 'myProfile'])->name('profile.me');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/show/{userId}', [ProfileController::class, 'showProfile'])->name('profile.show');
        Route::get('/tasks', [ProfileController::class, "showTasks"])->name("profile.tasks");
        Route::get('/attachments', [ProfileController::class, "showAttachments"])->name("profile.attachments");
        Route::get('/comments', [ProfileController::class, "showComments"])->name("profile.comments");
    });

    Route::prefix("dashboard")->group(function(){

        Route::get('/', function () {return view('dashboard');})->name('dashboard');

        Route::prefix("tasks")->group(function(){
            Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
            Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
            Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
            Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
            Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        });

        Route::prefix("/{taskId}/comments")->group(function () {
            Route::get('/create', [CommentController::class, 'create'])->name('tasks.comments.create');
            Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('tasks.comments.edit');
            Route::post('/', [CommentController::class, 'store'])->name('tasks.comments.store');
            Route::put('/{comment}', [CommentController::class, 'update'])->name('tasks.comments.update');
            Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('tasks.comments.destroy');
        });

        Route::prefix("/{taskId}/attachments")->group(function () {
            Route::get('/create', [AttachmentController::class, 'create'])->name('tasks.attachments.create');
            Route::get('/{attachment}/edit', [AttachmentController::class, 'edit'])->name('tasks.attachments.edit');
            Route::post('/', [AttachmentController::class, 'store'])->name('tasks.attachments.store');
            Route::put('/{attachment}', [AttachmentController::class, 'update'])->name('tasks.attachments.update');
            Route::delete('/{attachment}', [AttachmentController::class, 'destroy'])->name('tasks.attachments.destroy');
        });

    });

});
// http://127.0.0.1:8000/profile


require __DIR__.'/auth.php';
