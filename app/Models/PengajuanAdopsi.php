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
    'usia',
    'pekerjaan',
    'tipe_hunian',
    'status_hunian',
    'ada_halaman',
    'pengalaman_hewan',
    'detail_pengalaman',
    'hewan_lain',
    'detail_hewan_lain',
    'alasan_adopsi',
    'komitmen_waktu',
    'rencana_perawatan',
    'setuju_kunjungan',
    'setuju_followup',
    'setuju_tanggung_jawab',
];


    public function adopsi()
    {
        return $this->belongsTo(Adopsi::class);
    }
}
