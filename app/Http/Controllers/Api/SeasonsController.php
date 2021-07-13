<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeasonsFormRequest;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\Criador4DeSeries;
use App\Services\CriadorDeTemporadas;
use http\Env\Response;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index (Request $request, $id)
    {
        return SeasonResource::collection(Temporada::whereSerieId($id)->with('episodios')->paginate(10));
    
    }

    public function store (SeasonsFormRequest $request, CriadorDeTemporadas $criadorDeTemporadas)
    {
        $numeroTemporada = (Temporada::where('serie_id', $request->serie_id)->max('numero') + 1);

        $temporada = $criadorDeTemporadas->criarTemporada(
            $numeroTemporada,
            $request->serie_id,
            $request->episodios
        );

        return new SeasonResource($temporada);
        
    }

}
