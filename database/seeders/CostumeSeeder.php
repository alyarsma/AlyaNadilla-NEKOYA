<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Costume;

class CostumeSeeder extends Seeder
{
    public function run(): void
    {
        Costume::updateOrCreate([
            'kode_kostum' => 'C003',
            'nama_kostum' => 'Ada Wong',
            'kategori' => 'anime',
            'ukuran' => 'M',
            'harga_sewa' => 100000,
            'stok' => 5,
            'tersedia' => true,
            'foto' => 'Ada Wong.jpg',
        ]);

        Costume::updateOrCreate([
        'kode_kostum' => 'C004',
        'nama_kostum' => 'Ayunda Risu',
        'kategori' => 'vtuber',
        'ukuran' => 'L',
        'harga_sewa' => 150000,
        'stok' => 3,
        'tersedia' => true,
        'foto' => 'Ayunda Risu.jpg',
    ]);

        Costume::updateOrCreate([
        'kode_kostum' => 'C005',
        'nama_kostum' => 'Ai Hoshino',
        'kategori' => 'anime',
        'ukuran' => 'L',
        'harga_sewa' => 150000,
        'stok' => 3,
        'tersedia' => true,
        'foto' => 'Ai Hoshino.jpg',
    ]);

        Costume::updateOrCreate([
        'kode_kostum' => 'C006',
        'nama_kostum' => 'Hu Tao',
        'kategori' => 'game',
        'ukuran' => 'L',
        'harga_sewa' => 150000,
        'stok' => 3,
        'tersedia' => true,
        'foto' => 'hu tao.jpg',
    ]);

        Costume::updateOrCreate([
        'kode_kostum' => 'C007',
        'nama_kostum' => 'Kobo Kanaeru',
        'kategori' => 'vtuber',
        'ukuran' => 'L',
        'harga_sewa' => 150000,
        'stok' => 3,
        'tersedia' => true,
        'foto' => 'Kobo Kanaeru.jpg',
    ]);

        Costume::updateOrCreate([
        'kode_kostum' => 'C008',
        'nama_kostum' => 'Luffy Gear 5',
        'kategori' => 'anime',
        'ukuran' => 'L',
        'harga_sewa' => 150000,
        'stok' => 3,
        'tersedia' => true,
        'foto' => 'Luffy Gear 5.jpg',
    ]);

        Costume::updateOrCreate([
        'kode_kostum' => 'C009',
        'nama_kostum' => 'Nezuko Kamado',
        'kategori' => 'anime',
        'ukuran' => 'L',
        'harga_sewa' => 150000,
        'stok' => 3,
        'tersedia' => true,
        'foto' => 'Nezuko.jpg',
    ]);

        Costume::updateOrCreate([
        'kode_kostum' => 'C010',
        'nama_kostum' => 'Rem',
        'kategori' => 'anime',
        'ukuran' => 'L',
        'harga_sewa' => 150000,
        'stok' => 3,
        'tersedia' => true,
        'foto' => 'rem.jpg',
    ]);
    }
}
