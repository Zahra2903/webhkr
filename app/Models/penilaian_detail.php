<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian_detail extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function penilaian()
    {
        return $this->belongsTo(penilaian::class); 
    }
    public function kriteria()
    {
        return $this->belongsTo(kriteria::class); 
    }
}
