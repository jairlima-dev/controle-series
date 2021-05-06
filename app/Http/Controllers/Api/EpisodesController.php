<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EpisodioResource;
use App\Models\Episodio;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index (Request $request)
    {
        return EpisodioResource::collection(Episodio::all()->where($request->id));
    }
}
