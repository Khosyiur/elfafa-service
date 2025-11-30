<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'booking_code',
        'customer_name',
        'customer_phone',
        'phone_type',
        'complaint',
        'photo',
        'estimated_arrival_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'estimated_arrival_date' => 'date',
        ];
    }

    // Relasi ke Service (1 booking = 1 service)
    public function service(): HasOne
    {
        return $this->hasOne(Service::class);
    }

    // Generate booking code otomatis
    public static function generateBookingCode(): string
    {
        $date = now()->format('Ymd');
        $prefix = "ELF-{$date}-";
        
        $lastBooking = self::where('booking_code', 'like', $prefix . '%')
            ->orderBy('booking_code', 'desc')
            ->first();

        if ($lastBooking) {
            $lastNumber = (int) substr($lastBooking->booking_code, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $prefix . $newNumber;
    }

    // Status badge color
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Menunggu Konfirmasi' => 'bg-yellow-100 text-yellow-800',
            'HP Diterima' => 'bg-blue-100 text-blue-800',
            'Pengecekan Kerusakan' => 'bg-indigo-100 text-indigo-800',
            'Menunggu Persetujuan Harga' => 'bg-orange-100 text-orange-800',
            'Dalam Proses Perbaikan' => 'bg-purple-100 text-purple-800',
            'Selesai & Siap Diambil' => 'bg-green-100 text-green-800',
            'Diambil Pelanggan' => 'bg-gray-100 text-gray-800',
            'Ditolak' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}