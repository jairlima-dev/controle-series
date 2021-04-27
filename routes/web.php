<?php
/*
use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use Illuminate\Support\Facades\Auth;
*/

use Illuminate\Support\Facades\Route;


Route::get('/{any}', function (){
    return view('app');
})->where('any','.*');

/*
Route::get('/series', [SeriesController::class, 'index'])
    ->name('listar_series');
Route::get('/series/criar', [SeriesController::class, 'create'])
    ->name('form_criar_serie');
Route::post('series/criar', [SeriesController::class, 'store']);
Route::delete('/series/{id}', [SeriesController::class, 'destroy']);
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome']);

Route::get('/series/{serie}/temporadas', [TemporadasController::class, 'index']);
Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index']);
Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/registrar', [RegistroController::class, 'create']);
Route::post('/registrar', [RegistroController::class, 'store']);

Route::get('/logout', function (){
    Auth::logout();
    return redirect('/login');
});
*/
