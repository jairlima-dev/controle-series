<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SerieResource;
use App\Http\Resources\SeasonResource;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class SeasonsController extends Controller
{
    public function index (Request $request, Serie $serie)
    {
        return SeasonResource::collection(Temporada::all());
//        $serieId = $request->validate(['id' => 'required' ]);
//        return SeasonResource::collection(Temporada::where('serie_id', $serieId)->get());

    }




}
