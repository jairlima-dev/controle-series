<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/checkToken', [AuthController::class, 'checkToken']);
    Route::post('/getUser', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/register', [UserController::class, 'index']);
    Route::post('/register', [UserController::class, 'store']);
    Route::delete('/register/{user}', [UserController::class, 'destroy']);

    Route::get('/series', [SeriesController::class, 'index']);
    Route::get('/series/{search}', [SeriesController::class, 'search']);
    Route::get('/series/{serie}', [SeriesController::class, 'show']);
    Route::put('/series/{serie}', [SeriesController::class, 'update']);
    Route::delete('/series/{serie}', [SeriesController::class, 'destroy']);
    Route::post('/series', [SeriesController::class, 'store']);

    Route::get('/seasons/{id}', [SeasonsController::class, 'index']);
    Route::post('/seasons', [SeasonsController::class, 'store']);

    Route::get('/season/{season}', [EpisodesController::class, 'index']);
    Route::post('/episodes', [EpisodesController::class, 'store']);

    Route::get('/episodes/{episodio}', [EpisodesController::class, 'show']);
    Route::put('/episodes/{episodio}', [EpisodesController::class, 'update']);
    Route::delete('/episodes/{episodio}', [EpisodesController::class, 'destroy']);

});

