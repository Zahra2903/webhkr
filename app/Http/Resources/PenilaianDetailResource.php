<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenilaianDetailResource extends JsonResource
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
            'penilaian_id' => $this->penilaian_id,
            'penilaian' => $this->penilaian->tanggal,
            'nilai' => $this->nilai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
