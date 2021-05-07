<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index (Request $request, $id)
    {
        return SerieResource::collection(Serie::whereId($id)->with('temporadas')->get());
    }

}
