<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'tim_id' => $this->tim_id,
            'nama_tim' => $this->tim->nama_tim,
            'nik' =>$this->nik,
            'karyawan' =>$this->karyawan->nama,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
