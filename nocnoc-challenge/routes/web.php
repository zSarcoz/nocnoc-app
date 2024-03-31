<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;



Route::get('/', [DashboardController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource("/tasks", TasksController::class);
    Route::resource("/roles", RoleController::class);
    Route::resource("/users", UsersController::class);

});
