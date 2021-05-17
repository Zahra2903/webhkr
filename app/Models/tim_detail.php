<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tim_detail extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class); 
    }
    public function tim()
    {
        return $this->belongsTo(tim::class); 
    }
}
