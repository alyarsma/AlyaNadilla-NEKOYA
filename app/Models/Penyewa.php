<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Costume;

class Penyewa extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
    ];

   public function costumes()
{
    return $this->belongsToMany(Costume::class, 'penyewaans', 'penyewa_id', 'costume_id')
        ->withPivot('tanggal_sewa', 'tanggal_kembali', 'jumlah', 'total_harga')
        ->withTimestamps();
}
}
