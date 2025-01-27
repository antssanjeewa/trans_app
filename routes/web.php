<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard',['title' => 'hello']);
    })->name('dashboard');
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    })->name('settings');

    Route::resource('users',UsersController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('departments',DepartmentController::class);
});
