<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EpisodesFormRequest;
use App\Http\Requests\EpisodiosFormRequest;
use App\Http\Resources\EpisodeResource;
use App\Http\Resources\SeasonResource;
use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class EpisodesController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwtauth');
    }

    public function index(Request $request, $id)
    {
        return EpisodeResource::collection(Episodio::whereTemporadaId($id)->paginate(10));

    }

    public function show(Episodio $episodio)
    {
        return new EpisodeResource($episodio);
    }

    public function store(EpisodesFormRequest $request)
    {
        $numeroEpisodio = (Episodio::where('temporada_id', $request->temporada_id)->max('numero') + 1);

        DB::beginTransaction();
            $episodio = Episodio::create([
                'numero' =>$numeroEpisodio,
                'nome' => $request->nome,
                'temporada_id' => $request->temporada_id
            ]);
        DB::commit();

        return new EpisodeResource($episodio);
    }

    public function update(EpisodesFormRequest $request, Episodio $episodio)
    {

        $data = $request->validate([
            'nome' => 'required',
            'assistido' => 'boolean'
        ]);

        $episodio->update($data);

        return new EpisodeResource($episodio);
    }

    public function destroy(Episodio $episodio)
    {
        $ultimoEpisodio = Episodio::where('temporada_id', $episodio->temporada_id)->max('numero');
        $numeroEpisodio = $episodio->numero;

        if ($numeroEpisodio !== $ultimoEpisodio) {

            return Response::json([
                'errors' => [
                'episodios' => ['Só é permitido excluir o último Episódio!']
                ]], 401);

        } else {
            $episodio->delete();
        }


    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use($episodiosAssistidos) {
            if(!empty($episodiosAssistidos)) {
                $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
            } else {
                $episodio->assistido = '';
            }
        });
    }


}
