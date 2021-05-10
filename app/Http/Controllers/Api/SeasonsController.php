<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemporadasFormRequest;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\CriadorDeSeries;
use App\Services\CriadorDeTemporadas;
use http\Env\Response;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index (Request $request, $id)
    {

        return SerieResource::collection(Serie::whereId($id)->with('temporadas')->get());

//        return SeasonResource::collection(Temporada::where('serie_id', $id)->
//            with('episodios')->get());


    }

    public function store (TemporadasFormRequest $request, CriadorDeTemporadas $criadorDeTemporadas)
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
