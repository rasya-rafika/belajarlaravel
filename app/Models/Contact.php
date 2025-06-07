<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'category',
        'message',
        'photo',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute()
    {
        $labels = [
            'aduan_permasalahan' => 'Aduan Permasalahan',
            'pendaftaran_dokter' => 'Pendaftaran Dokter',
            'pendaftaran_hewan_adopsi' => 'Pendaftaran Hewan Adopsi',
            'lainnya' => 'Lainnya'
        ];

        return $labels[$this->category] ?? 'Unknown';
    }
}