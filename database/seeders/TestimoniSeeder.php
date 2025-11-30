<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('testimonis')->truncate();

        $testimonis = [
            [
                'title' => 'iPhone 11 - Ganti LCD Retak',
                'description' => 'LCD iPhone 11 retak parah akibat jatuh dari ketinggian 1 meter. Setelah diganti dengan LCD original, HP kembali normal dan touchscreen responsif seperti baru. Pengerjaan hanya 2 jam.',
                'before_photo' => null,
                'after_photo' => null,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'Samsung A52 - Ganti Baterai',
                'description' => 'Baterai Samsung A52 sudah soak, HP hanya bertahan 2 jam. Setelah diganti baterai baru, HP bisa bertahan seharian penuh. Customer sangat puas dengan hasilnya.',
                'before_photo' => null,
                'after_photo' => null,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Xiaomi Redmi Note 10 - Perbaikan Mati Total',
                'description' => 'HP mati total tidak bisa dicas. Setelah dicek ternyata IC Charger rusak. Setelah diganti IC baru, HP kembali normal dan bisa dicas dengan lancar.',
                'before_photo' => null,
                'after_photo' => null,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'iPhone 12 - Ganti Kamera Belakang',
                'description' => 'Kamera belakang iPhone 12 blur dan tidak fokus. Modul kamera sudah rusak. Setelah diganti dengan modul kamera original, hasil foto kembali jernih dan tajam.',
                'before_photo' => null,
                'after_photo' => null,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Oppo A54 - Perbaikan Speaker',
                'description' => 'Speaker Oppo A54 tidak mengeluarkan suara sama sekali. Setelah dicek, speaker internal rusak. Setelah diganti speaker baru, suara kembali jernih dan kencang.',
                'before_photo' => null,
                'after_photo' => null,
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
        ];

        DB::table('testimonis')->insert($testimonis);
    }
}