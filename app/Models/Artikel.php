<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    // Nama tabel jika tidak menggunakan penamaan default (artikels)
    // protected $table = 'artikels';
    

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'link_artikel',
        'user_id',  // Pastikan user_id termasuk kolom yang dapat diisi
    ];

    // Relasi dengan model User (Artikel dimiliki oleh satu User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');  // 'user_id' adalah kolom di tabel 'artikels' yang merujuk ke kolom 'id' di tabel 'users'
    }
}
