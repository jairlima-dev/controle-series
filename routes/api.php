<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\EpisodiosController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('/users', function () {
//    return User::factory()->count(5)->make();
//});

Route::namespace('Api')->group(function () {
    Route::get('/series', [SeriesController::class, 'index']);
    Route::get('/series/{serie}', [SeriesController::class, 'show']);
    Route::put('/series/{serie}', [SeriesController::class, 'update']);
    Route::delete('/series/{serie}', [SeriesController::class, 'destroy']);
    Route::post('/series', [SeriesController::class, 'store']);

    Route::get('/serie/{serie}', [SeasonsController::class, 'index']);

    Route::get('/season/{serie}/episodes', [EpisodesController::class, 'index']);

});

