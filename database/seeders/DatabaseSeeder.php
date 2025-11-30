<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan foreign key check agar truncate bisa jalan
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            AdminSeeder::class,
            SparepartSeeder::class,
            BookingSeeder::class,
            ServiceSeeder::class,
            ServiceStatusHistorySeeder::class,
            TestimoniSeeder::class,
            ServiceSparepartSeeder::class,
            SparepartStockHistorySeeder::class,
        ]);

        // Aktifkan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}