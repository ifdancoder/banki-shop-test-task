<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParameterController;

Route::get('/parameters', [ParameterController::class, 'index']);
Route::get('/parameters/{id}', [ParameterController::class, 'show']);
Route::post('/parameters', [ParameterController::class, 'create']);
Route::post('/parameters/{id}/update', [ParameterController::class, 'update']);
Route::delete('/parameters/{id}', [ParameterController::class, 'delete']);