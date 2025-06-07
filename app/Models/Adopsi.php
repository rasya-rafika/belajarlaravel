<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_hewan',
        'jenis_hewan',
        'jenis_kelamin',
        'umur',
        'deskripsi',
        'status',
        'gambar',
        'user_id',
    ];

    // Relasi dengan User (admin yang menambahkan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan PengajuanAdopsi
    public function pengajuanAdopsi()
    {
        return $this->hasMany(PengajuanAdopsi::class);
    }
}
