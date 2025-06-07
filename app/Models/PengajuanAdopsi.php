<?php
// app/Models/PengajuanAdopsi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanAdopsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'adopsi_id',
        'nama_pengaju',
        'alamat',
        'nomor_telepon',
        'alasan_adopsi',
    ];

    public function adopsi()
    {
        return $this->belongsTo(Adopsi::class);
    }
}
