<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\CitationController;


Route::apiResource('citations', CitationController::class);
Route::get('random/{citation}', [CitationController::class, 'getCitations']);
Route::get('random', [CitationController::class, 'getCitation']);
Route::get('Citations/filter', [CitationController::class, 'filterByLength']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

