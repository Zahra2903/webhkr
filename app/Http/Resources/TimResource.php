<?php

namespace App\Http\Resources;

use App\Models\karyawan;
use App\Models\unit;
use Illuminate\Http\Resources\Json\JsonResource;

class TimResource extends JsonResource
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
            'nama_tim' => $this->nama_tim,
            'tim_detail' => TimDetailResource::collection($this->tim_detail),
            'unit_detail' => UnitDetailResource::collection($this->unit_detail),

        ];
    }
}
