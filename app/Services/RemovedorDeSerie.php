<?php


namespace App\Services;


use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId)
    {
        $nomeSerie = '';
        DB::transaction(function () use(&$nomeSerie, $serieId) {
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $this->removerTemporada($serie);
            $serie->delete();
        });

        return $nomeSerie;

    }

    /**
     * @param $serie
     */
    private function removerTemporada($serie)
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });

    }

    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

}
