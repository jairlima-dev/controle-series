<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index ()
    {
        return SerieResource::collection(Serie::paginate(5));

    }

    public function show (Serie $serie)
    {

        return new SerieResource($serie);

    }

    public function update(Serie $serie, Request $request)
    {

        $data = $request->validate([

            'name' => 'required'

        ]);

        $serie->update($data);

        return new SerieResource($serie);

    }

}


