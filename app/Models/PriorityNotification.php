<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriorityNotification extends Model
{
    protected $fillable = ['id_kunjungan', 'message', 'is_read', 'urgency_level'];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan', 'id_kunjungan');
    }
}
