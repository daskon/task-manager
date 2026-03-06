<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Task and Project Routes
    Route::resource('projects', ProjectController::class);

    Route::post(
            '/projects/{project}/tasks',
            [TaskController::class, 'store']
    )->name('tasks.store');

    Route::patch(
            '/projects/{project}/tasks/{task}',
            [TaskController::class, 'update']
    )->name('tasks.update');

    Route::delete(
            '/projects/{project}/tasks/{taskId}',
            [TaskController::class, 'destroy']
    )->name('tasks.destroy');

    Route::patch(
            '/projects/{project}/tasks/{taskId}/toggle',
            [TaskController::class, 'toggleDone']
    )->name('tasks.toggle');

});

require __DIR__.'/auth.php';
