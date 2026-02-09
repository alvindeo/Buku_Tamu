<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'data_kunjungan';
    protected $primaryKey = 'id_kunjungan';

    protected $fillable = [
        'id_pengunjung',
        'keperluan',
        'tanggal_jam_masuk',
        'tanggal_jam_keluar',
        'durasi_kunjungan',
        'status'
    ];

    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'id_pengunjung', 'id_pengunjung');
    }
}
