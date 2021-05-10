<?php


namespace App\Services;


use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeTemporadas
{
    public function criarTemporada (int $numeroTemporada, int $idSerie, int $qtdEpisodios)
    {
        DB::beginTransaction();
            $temporada = Temporada::create([
                'numero' => $numeroTemporada,
                'serie_id' => $idSerie
                ]
            );
            $this->criarEpisodio($temporada, $qtdEpisodios);
        DB::commit();

        return $temporada;
    }

    public function criarEpisodio ($temporada, $qtdEpisodios)
    {
        for ($i = 1; $i <= $qtdEpisodios; $i++) {
            $temporada->episodios()->create(['numero' => $i]);
        }

    }

}
