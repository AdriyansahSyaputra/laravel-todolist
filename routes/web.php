<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware('onlyGuest');
    Route::post('/login', 'doLogin')->middleware('onlyGuest');
    Route::post('/logout', 'doLogout')->middleware('onlyMember');
});

Route::controller(TodoListController::class)
    ->middleware('onlyMember')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/{todoId}/delete', 'destroy');
    });