<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = [
        'nama',
        'pengalaman',
        'lokasi',
        'alamat',
        'jadwal',
        'foto'
    ];

    public function ratings()
    {
        
        return $this->hasMany(Rating::class);
    }
}