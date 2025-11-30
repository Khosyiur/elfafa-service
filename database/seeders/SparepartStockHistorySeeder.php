<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SparepartStockHistorySeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('sparepart_stock_histories')->truncate();

        $histories = [
            ['sparepart_id' => 1, 'change_type' => 'IN', 'quantity' => 20, 'note' => 'Stok awal', 'created_at' => Carbon::now()->subDays(30), 'updated_at' => Carbon::now()->subDays(30)],
            ['sparepart_id' => 1, 'change_type' => 'OUT', 'quantity' => 3, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(15), 'updated_at' => Carbon::now()->subDays(15)],
            ['sparepart_id' => 1, 'change_type' => 'OUT', 'quantity' => 1, 'note' => 'Service #1 - Budi Santoso', 'created_at' => Carbon::now()->subDays(4), 'updated_at' => Carbon::now()->subDays(4)],
            ['sparepart_id' => 1, 'change_type' => 'OUT', 'quantity' => 1, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(2), 'updated_at' => Carbon::now()->subDays(2)],
            ['sparepart_id' => 3, 'change_type' => 'IN', 'quantity' => 25, 'note' => 'Stok awal', 'created_at' => Carbon::now()->subDays(30), 'updated_at' => Carbon::now()->subDays(30)],
            ['sparepart_id' => 3, 'change_type' => 'OUT', 'quantity' => 5, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(10), 'updated_at' => Carbon::now()->subDays(10)],
            ['sparepart_id' => 7, 'change_type' => 'IN', 'quantity' => 35, 'note' => 'Stok awal', 'created_at' => Carbon::now()->subDays(30), 'updated_at' => Carbon::now()->subDays(30)],
            ['sparepart_id' => 7, 'change_type' => 'OUT', 'quantity' => 4, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(12), 'updated_at' => Carbon::now()->subDays(12)],
            ['sparepart_id' => 7, 'change_type' => 'OUT', 'quantity' => 1, 'note' => 'Service #2 - Siti Nurhaliza', 'created_at' => Carbon::now()->subDays(2), 'updated_at' => Carbon::now()->subDays(2)],
            ['sparepart_id' => 11, 'change_type' => 'IN', 'quantity' => 60, 'note' => 'Stok awal', 'created_at' => Carbon::now()->subDays(30), 'updated_at' => Carbon::now()->subDays(30)],
            ['sparepart_id' => 11, 'change_type' => 'OUT', 'quantity' => 9, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(14), 'updated_at' => Carbon::now()->subDays(14)],
            ['sparepart_id' => 11, 'change_type' => 'OUT', 'quantity' => 1, 'note' => 'Service #3 - Ahmad Rizki', 'created_at' => Carbon::now()->subHours(12), 'updated_at' => Carbon::now()->subHours(12)],
            ['sparepart_id' => 12, 'change_type' => 'IN', 'quantity' => 10, 'note' => 'Stok awal', 'created_at' => Carbon::now()->subDays(30), 'updated_at' => Carbon::now()->subDays(30)],
            ['sparepart_id' => 12, 'change_type' => 'OUT', 'quantity' => 10, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(5), 'updated_at' => Carbon::now()->subDays(5)],
            ['sparepart_id' => 9, 'change_type' => 'IN', 'quantity' => 10, 'note' => 'Stok awal', 'created_at' => Carbon::now()->subDays(30), 'updated_at' => Carbon::now()->subDays(30)],
            ['sparepart_id' => 9, 'change_type' => 'OUT', 'quantity' => 7, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(8), 'updated_at' => Carbon::now()->subDays(8)],
            ['sparepart_id' => 15, 'change_type' => 'IN', 'quantity' => 10, 'note' => 'Stok awal', 'created_at' => Carbon::now()->subDays(30), 'updated_at' => Carbon::now()->subDays(30)],
            ['sparepart_id' => 15, 'change_type' => 'OUT', 'quantity' => 6, 'note' => 'Dipakai service', 'created_at' => Carbon::now()->subDays(7), 'updated_at' => Carbon::now()->subDays(7)],
        ];

        DB::table('sparepart_stock_histories')->insert($histories);
    }
}