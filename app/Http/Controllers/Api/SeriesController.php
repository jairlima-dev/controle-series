<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateRequest;
use App\Http\Resources\SerieResource;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\CriadorDeSeries;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwtauth');
    }

    public function index ()
    {
        return SerieResource::collection(Serie::orderBy('nome')
            ->paginate(8));
    }

    public function search ($search, Request $request)
    {
        return SerieResource::collection(Serie::orderBy('nome')
            ->where('nome','LIKE','%'.$search.'%')
            ->paginate(8));
    }

    public function show(Serie $serie)
    {
        return new SerieResource($serie);
    }

    public function store(SeriesFormRequest $request, CriadorDeSeries $criadorDeSeries)
    {
        $serie = $criadorDeSeries->criarSerie(
            $request->nome,
            $request->temporadas,
            $request->episodios
        );

        return new SerieResource($serie);
    }

    public function update(Serie $serie, SeriesUpdateRequest $request)
    {
        $data = $request->validate([
            'nome' => 'required'
        ]);

        $serie->update($data);

        return new SerieResource($serie);
    }

    public function destroy(Serie $serie)
    {
        $this->destroyTemporada($serie);
        $serie->delete();

        return response(null, 204);
    }

    /**
     * @param Serie $serie
     */
    private function destroyTemporada($serie)
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->destroyEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     */
    private function destroyEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

}


