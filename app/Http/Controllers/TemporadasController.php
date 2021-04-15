<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function index(Serie $serie)
    {
        $temporadas = $serie->temporadas;

        return view('temporadas.index', compact('temporadas', 'serie'));

    }
}
