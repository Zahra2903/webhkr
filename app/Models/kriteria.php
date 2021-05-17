<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function nilai()
    {
        return $this->hasMany(nilai::class); 
    }
    public function penilaian_detail()
    {
        return $this->hasMany(penilaian_detail::class); 
    }
}
