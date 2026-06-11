<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $fillable = [
        'user_id',
        'kode_penyewaan',
        'nama',
        'no_wa',
        'alamat',
        'tanggal_ambil',
        'tanggal_kembali',
        'catatan',
        'subtotal',
        'discount',
        'total',
        'voucher_code',
        'metode_pembayaran',
        'status_pembayaran',
        'status_penyewaan',
        'bukti_transfer',
        'catatan_admin',
    ];

    public function items()
    {
        return $this->hasMany(PenyewaanItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
{
    return $this->hasMany(PenyewaanHistory::class)->latest();
}
}
