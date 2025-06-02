<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    // Jika nama tabel bukan 'artikels', tambahkan:
    // protected $table = 'artikels';

    // Kolom yang bisa diisi
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'link_artikel',
    ];
}
