<?php

use App\Http\Controllers\api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\CitationController;
use App\Http\Controllers\api\FavorisController;
use App\Http\Controllers\api\TagController;
use  App\Http\Controllers\Api\UserController;
use  App\Http\Controllers\Api\LikeController;

Route::apiResource('citations', CitationController::class)->middleware('auth:sanctum');

Route::apiResource('Category', CategoryController::class)->middleware('auth:sanctum');
Route::apiResource('favoris', FavorisController::class)->middleware('auth:sanctum');
Route::apiResource('tag', TagController::class)->middleware('auth:sanctum');
Route::get('random/{citation}', [CitationController::class, 'getCitations']);
Route::get('random', [CitationController::class, 'getCitation']);
Route::post('Citations/filter', [CitationController::class, 'filterByLength']);
Route::get('Citations/populaire', [CitationController::class, 'PlusPolaire']);
Route::post('Liked', [LikeController::class, 'like'])->middleware('auth:sanctum');;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
