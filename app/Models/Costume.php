<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penyewa;

class Costume extends Model
{
    protected $fillable = [
    'kode_kostum',
    'nama_kostum',
    'kategori',
    'ukuran',
    'harga_sewa',
    'stok',
    'tersedia',
    'foto',
];

    protected $casts = [
        'tersedia' => 'boolean',
        'harga_sewa' => 'decimal:2',
    ];

    public function scopeTersedia($query)
    {
        return $query->where('tersedia', true);
    }

    public function penyewas()
{
    return $this->belongsToMany(Penyewa::class, 'penyewaans', 'costume_id', 'penyewa_id')
        ->withPivot('tanggal_sewa', 'tanggal_kembali', 'jumlah', 'total_harga')
        ->withTimestamps();
}
}
