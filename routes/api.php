<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\CitationController;
use  App\Http\Controllers\Api\UserController;

Route::apiResource('citations', CitationController::class);
Route::get('random/{citation}', [CitationController::class, 'getCitations']);
Route::get('random', [CitationController::class, 'getCitation']);
Route::post('Citations/filter', [CitationController::class, 'filterByLength']);
 Route::get('Citations/populaire', [CitationController::class, 'PlusPolaire']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');