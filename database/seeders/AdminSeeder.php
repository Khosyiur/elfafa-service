<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu untuk hindari duplikasi
        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi1',
                'password' => Hash::make('teknisi123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}