<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('services')->truncate();

        $services = [
            [
                'booking_id' => 1,
                'technician_id' => 1,
                'estimated_cost' => 900000,
                'final_cost' => 850000,
                'status' => 'Diambil Pelanggan',
                'completed_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'booking_id' => 2,
                'technician_id' => 1,
                'estimated_cost' => 300000,
                'final_cost' => 280000,
                'status' => 'Selesai & Siap Diambil',
                'completed_at' => Carbon::now()->subDay(),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDay(),
            ],
            [
                'booking_id' => 3,
                'technician_id' => 2,
                'estimated_cost' => 350000,
                'final_cost' => null,
                'status' => 'Dalam Proses Perbaikan',
                'completed_at' => null,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_id' => 4,
                'technician_id' => 1,
                'estimated_cost' => 500000,
                'final_cost' => null,
                'status' => 'Menunggu Persetujuan Harga',
                'completed_at' => null,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_id' => 5,
                'technician_id' => 2,
                'estimated_cost' => null,
                'final_cost' => null,
                'status' => 'HP Diterima',
                'completed_at' => null,
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_id' => 6,
                'technician_id' => null,
                'estimated_cost' => null,
                'final_cost' => null,
                'status' => 'Menunggu Konfirmasi',
                'completed_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('services')->insert($services);
    }
}