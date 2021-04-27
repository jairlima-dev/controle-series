<?php


namespace App\Services;


use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeSeries
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada)
    {
        DB::beginTransaction();
            $serie = Serie::create([
                'nome' => $nomeSerie
                ]
            );
            $this->criarTemporada($serie, $epPorTemporada, $qtdTemporadas);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $qtdTemporadas
     * @param $serie
     * @param int $epPorTemporada
     */
    private function criarTemporada(Serie $serie, int $epPorTemporada, int $qtdTemporadas)
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criarEpisodio($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     */
    private function criarEpisodio(int $epPorTemporada, $temporada)
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }


}
