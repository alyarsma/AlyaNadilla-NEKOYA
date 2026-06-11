<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanHistory extends Model
{
    protected $fillable = [
        'penyewaan_id',
        'judul',
        'keterangan',
    ];
}
