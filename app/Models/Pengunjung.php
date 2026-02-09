<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'data_pengunjung';
    protected $primaryKey = 'id_pengunjung';

    protected $fillable = [
        'no_hp',
        'nama',
        'asal_institusi',
        'tanggal_jam_masuk',
        'tanggal_jam_keluar',
        'keperluan'
    ];

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'id_pengunjung', 'id_pengunjung');
    }
}
