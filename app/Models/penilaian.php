<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function penilaian_detail()
    {
        return $this->hasMany(penilaian_detail::class); 
    }
    public function karyawan()
    {
        return $this->belongsTo(karyawan::class); 
    }
    public function tim()
    {
        return $this->belongsTo(tim::class); 
    }
    public function unit()
    {
        return $this->belongsTo(unit::class); 
    }

}
