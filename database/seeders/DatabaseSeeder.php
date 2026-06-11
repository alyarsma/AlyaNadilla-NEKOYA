<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CostumeSeeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // ⬇️ TAMBAHKAN INI
        $this->call([
            CostumeSeeder::class,
        ]);
    }
}
