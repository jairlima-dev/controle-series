<?php

namespace App\Models;

use App\Models\Episodio;
use App\Models\Serie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $fillable = ['numero', 'serie_id'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getEpisodiosAssistidos()
    {
        return $this->episodios->filter(function (Episodio $episodio){
            return $episodio->assistido;
        });

    }

}
