<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'numero' => $this->numero,
            'serie_id' => $this->serie_id,
            'episodios' => EpisodioResource::collection($this->episodios)
//            'episodios' => EpisodioResource::collection($this->whenLoaded('episodios'))
        ];
    }
}
