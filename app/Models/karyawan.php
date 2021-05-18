<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function penilaian()
    {
        return $this->hasMany(penilaian::class);
    }

    public function tim_detail()
    {
        return $this->hasMany(tim_detail::class);
    }
}
