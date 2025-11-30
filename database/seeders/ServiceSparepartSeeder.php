<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSparepartSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('service_sparepart')->truncate();

        $serviceParts = [
            [
                'service_id' => 1,
                'sparepart_id' => 1,
                'quantity' => 1,
                'price' => 850000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_id' => 2,
                'sparepart_id' => 7,
                'quantity' => 1,
                'price' => 280000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_id' => 3,
                'sparepart_id' => 11,
                'quantity' => 1,
                'price' => 120000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('service_sparepart')->insert($serviceParts);
    }
}