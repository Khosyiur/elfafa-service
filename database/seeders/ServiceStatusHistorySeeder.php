<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceStatusHistorySeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('service_status_histories')->truncate();

        $histories = [
            // Service 1 - Complete journey
            ['service_id' => 1, 'status' => 'Menunggu Konfirmasi', 'note' => 'Booking baru diterima', 'created_at' => Carbon::now()->subDays(7), 'updated_at' => Carbon::now()->subDays(7)],
            ['service_id' => 1, 'status' => 'HP Diterima', 'note' => 'HP sudah diterima di toko', 'created_at' => Carbon::now()->subDays(6), 'updated_at' => Carbon::now()->subDays(6)],
            ['service_id' => 1, 'status' => 'Pengecekan Kerusakan', 'note' => 'Sedang dicek oleh teknisi', 'created_at' => Carbon::now()->subDays(6)->addHours(2), 'updated_at' => Carbon::now()->subDays(6)->addHours(2)],
            ['service_id' => 1, 'status' => 'Menunggu Persetujuan Harga', 'note' => 'LCD perlu diganti, estimasi Rp 900.000', 'created_at' => Carbon::now()->subDays(5), 'updated_at' => Carbon::now()->subDays(5)],
            ['service_id' => 1, 'status' => 'Dalam Proses Perbaikan', 'note' => 'Customer setuju, mulai pengerjaan', 'created_at' => Carbon::now()->subDays(4), 'updated_at' => Carbon::now()->subDays(4)],
            ['service_id' => 1, 'status' => 'Selesai & Siap Diambil', 'note' => 'Perbaikan selesai, HP siap diambil', 'created_at' => Carbon::now()->subDays(2), 'updated_at' => Carbon::now()->subDays(2)],
            ['service_id' => 1, 'status' => 'Diambil Pelanggan', 'note' => 'HP sudah diambil oleh pelanggan', 'created_at' => Carbon::now()->subDay(), 'updated_at' => Carbon::now()->subDay()],

            // Service 2 - Ready for pickup
            ['service_id' => 2, 'status' => 'Menunggu Konfirmasi', 'note' => 'Booking baru diterima', 'created_at' => Carbon::now()->subDays(5), 'updated_at' => Carbon::now()->subDays(5)],
            ['service_id' => 2, 'status' => 'HP Diterima', 'note' => 'HP sudah diterima di toko', 'created_at' => Carbon::now()->subDays(4), 'updated_at' => Carbon::now()->subDays(4)],
            ['service_id' => 2, 'status' => 'Pengecekan Kerusakan', 'note' => 'Baterai sudah soak perlu diganti', 'created_at' => Carbon::now()->subDays(4)->addHours(3), 'updated_at' => Carbon::now()->subDays(4)->addHours(3)],
            ['service_id' => 2, 'status' => 'Menunggu Persetujuan Harga', 'note' => 'Estimasi ganti baterai Rp 300.000', 'created_at' => Carbon::now()->subDays(3), 'updated_at' => Carbon::now()->subDays(3)],
            ['service_id' => 2, 'status' => 'Dalam Proses Perbaikan', 'note' => 'Customer setuju, proses penggantian', 'created_at' => Carbon::now()->subDays(2), 'updated_at' => Carbon::now()->subDays(2)],
            ['service_id' => 2, 'status' => 'Selesai & Siap Diambil', 'note' => 'Baterai sudah diganti, HP siap diambil', 'created_at' => Carbon::now()->subDay(), 'updated_at' => Carbon::now()->subDay()],

            // Service 3 - In progress
            ['service_id' => 3, 'status' => 'Menunggu Konfirmasi', 'note' => 'Booking baru diterima', 'created_at' => Carbon::now()->subDays(3), 'updated_at' => Carbon::now()->subDays(3)],
            ['service_id' => 3, 'status' => 'HP Diterima', 'note' => 'HP sudah diterima di toko', 'created_at' => Carbon::now()->subDays(2), 'updated_at' => Carbon::now()->subDays(2)],
            ['service_id' => 3, 'status' => 'Pengecekan Kerusakan', 'note' => 'IC Charger rusak perlu diganti', 'created_at' => Carbon::now()->subDays(2)->addHours(4), 'updated_at' => Carbon::now()->subDays(2)->addHours(4)],
            ['service_id' => 3, 'status' => 'Menunggu Persetujuan Harga', 'note' => 'Estimasi Rp 350.000', 'created_at' => Carbon::now()->subDay(), 'updated_at' => Carbon::now()->subDay()],
            ['service_id' => 3, 'status' => 'Dalam Proses Perbaikan', 'note' => 'Sedang dikerjakan', 'created_at' => Carbon::now()->subHours(12), 'updated_at' => Carbon::now()->subHours(12)],

            // Service 4 - Waiting price approval
            ['service_id' => 4, 'status' => 'Menunggu Konfirmasi', 'note' => 'Booking baru diterima', 'created_at' => Carbon::now()->subDays(2), 'updated_at' => Carbon::now()->subDays(2)],
            ['service_id' => 4, 'status' => 'HP Diterima', 'note' => 'HP sudah diterima', 'created_at' => Carbon::now()->subDay(), 'updated_at' => Carbon::now()->subDay()],
            ['service_id' => 4, 'status' => 'Pengecekan Kerusakan', 'note' => 'Modul kamera perlu diganti', 'created_at' => Carbon::now()->subDay()->addHours(3), 'updated_at' => Carbon::now()->subDay()->addHours(3)],
            ['service_id' => 4, 'status' => 'Menunggu Persetujuan Harga', 'note' => 'Estimasi Rp 500.000, menunggu konfirmasi customer', 'created_at' => Carbon::now()->subHours(6), 'updated_at' => Carbon::now()->subHours(6)],

            // Service 5 - Just received
            ['service_id' => 5, 'status' => 'Menunggu Konfirmasi', 'note' => 'Booking baru diterima', 'created_at' => Carbon::now()->subDay(), 'updated_at' => Carbon::now()->subDay()],
            ['service_id' => 5, 'status' => 'HP Diterima', 'note' => 'HP sudah diterima, menunggu pengecekan', 'created_at' => Carbon::now()->subHours(3), 'updated_at' => Carbon::now()->subHours(3)],

            // Service 6 - New booking
            ['service_id' => 6, 'status' => 'Menunggu Konfirmasi', 'note' => 'Booking baru masuk', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('service_status_histories')->insert($histories);
    }
}