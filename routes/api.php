<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoketController;
use App\Http\Controllers\Api\AntrianController;

Route::apiResource('lokets', LoketController::class);

// Antrian: generate, list, call next, update, delete
Route::get('antrians', [AntrianController::class, 'index']);
Route::post('antrians/generate', [AntrianController::class, 'generate']);
Route::post('antrians/{loket}/call-next', [AntrianController::class, 'callNext']);
Route::apiResource('antrians', AntrianController::class)->except(['index', 'store']);
