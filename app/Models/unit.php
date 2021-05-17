<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function penilaian()
    {
        return $this->hasMany(penilaian::class); 
    }
    public function unit_detail()
    {
        return $this->hasMany(unit_detail::class); 
    }
}
