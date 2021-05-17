<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenilaianResource extends JsonResource
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
            'tanggal' => $this->tanggal,
            'nik' => $this->nik,
            'karyawan' => $this->karyawan,
            'tim_id' => $this->tim_id,
            'nama_tim' => $this->tim->nama_tim,
            'unit_id' => $this->unit_id,
            'nama_unit' => $this->tim->nama,
            'status' => $this->status,
            'rekomendasi' => $this->rekomendasi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
