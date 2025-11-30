<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('bookings')->truncate();

        $bookings = [
            [
                'booking_code' => 'ELF-20250101-001',
                'customer_name' => 'Budi Santoso',
                'customer_phone' => '081234567890',
                'phone_type' => 'iPhone 11',
                'complaint' => 'LCD retak dan touchscreen tidak responsif setelah jatuh',
                'photo' => null,
                'estimated_arrival_date' => Carbon::now()->subDays(5)->toDateString(),
                'status' => 'Diambil Pelanggan',
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'booking_code' => 'ELF-20250102-002',
                'customer_name' => 'Siti Nurhaliza',
                'customer_phone' => '081298765432',
                'phone_type' => 'Samsung Galaxy A52',
                'complaint' => 'Baterai cepat habis dan HP panas saat dipakai',
                'photo' => null,
                'estimated_arrival_date' => Carbon::now()->subDays(3)->toDateString(),
                'status' => 'Selesai & Siap Diambil',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'booking_code' => 'ELF-20250103-003',
                'customer_name' => 'Ahmad Rizki',
                'customer_phone' => '082112345678',
                'phone_type' => 'Xiaomi Redmi Note 10',
                'complaint' => 'HP mati total, tidak bisa dicas',
                'photo' => null,
                'estimated_arrival_date' => Carbon::now()->subDays(1)->toDateString(),
                'status' => 'Dalam Proses Perbaikan',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_code' => 'ELF-20250104-004',
                'customer_name' => 'Dewi Lestari',
                'customer_phone' => '085678901234',
                'phone_type' => 'iPhone 12',
                'complaint' => 'Kamera belakang blur dan tidak fokus',
                'photo' => null,
                'estimated_arrival_date' => Carbon::now()->toDateString(),
                'status' => 'Menunggu Persetujuan Harga',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_code' => 'ELF-20250105-005',
                'customer_name' => 'Rudi Hermawan',
                'customer_phone' => '087890123456',
                'phone_type' => 'Oppo A54',
                'complaint' => 'Speaker tidak bersuara',
                'photo' => null,
                'estimated_arrival_date' => Carbon::now()->addDays(1)->toDateString(),
                'status' => 'HP Diterima',
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_code' => 'ELF-20250106-006',
                'customer_name' => 'Linda Susanti',
                'customer_phone' => '089012345678',
                'phone_type' => 'Samsung Galaxy S21',
                'complaint' => 'Layar bergaris-garis hijau',
                'photo' => null,
                'estimated_arrival_date' => Carbon::now()->addDays(2)->toDateString(),
                'status' => 'Menunggu Konfirmasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('bookings')->insert($bookings);
    }
}