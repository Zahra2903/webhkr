<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit_detail extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function tim()
    {
        return $this->belongsTo(tim::class); 
    }
    public function unit()
    {
        return $this->belongsTo(unit::class); 
    }
}
