<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;

// Route::get('/', [HomeController::class, 'home']);

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login');
    Route::post('/login', 'doLogin');
    Route::post('/logout', 'doLogout');
});

Route::controller(TodoListController::class)
    ->middleware('onlyMember')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/{todoId}/delete', 'destroy');
    });