<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanItem extends Model
{
    protected $fillable = [
        'penyewaan_id',
        'costume_id',
        'nama_kostum',
        'foto',
        'harga_sewa',
        'durasi',
        'subtotal',
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
