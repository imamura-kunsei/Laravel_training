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
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/add', [TaskController::class, 'get_add']);
Route::post('/tasks/add', [TaskController::class, 'post_add']);
Route::get('/tasks/edit/{task}', [TaskController::class, 'get_edit']);
Route::put('/tasks/edit/{task}', [TaskController::class, 'post_edit']);
Route::patch('/tasks/update/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/delete/{task}', [TaskController::class, 'delete']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
