<?php

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
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
      });

    Route::prefix("dashboard")->group(function(){

        Route::get('/', function () {return view('dashboard');})->name('dashboard');

        Route::group(['prefix' => 'tasks'], function () {
            Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
            Route::get('/{taskId}', [TaskController::class, 'show'])->name('tasks.show');

            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/', [TaskController::class, 'store'])->name('tasks.store');

            Route::get('/{taskId}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
            Route::put('/{taskId}', [TaskController::class, 'update'])->name('tasks.update');
            Route::delete('/{taskId}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        });

    });

});



require __DIR__.'/auth.php';
