<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NilaiResource extends JsonResource
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
            'kriteria_id' => $this->kriteria_id,
            'kriteria' => $this->kriteria->kriteria,
            'nilai' => $this->nilai,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
