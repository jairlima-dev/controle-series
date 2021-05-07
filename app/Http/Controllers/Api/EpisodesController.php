<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EpisodeResource;
use App\Http\Resources\SeasonResource;
use App\Models\Episodio;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index (Request $request, $id)
    {
        return EpisodeResource::collection(Episodio::where('temporada_id', $id)->get());
    }
}
