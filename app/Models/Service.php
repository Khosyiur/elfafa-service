<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'booking_id',
        'technician_id',
        'estimated_cost',
        'final_cost',
        'status',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'estimated_cost' => 'integer',
            'final_cost' => 'integer',
        ];
    }

    // Relasi ke Booking
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    // Relasi ke Admin (teknisi)
    public function technician(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'technician_id');
    }

    // Relasi ke Status History
    public function statusHistories(): HasMany
    {
        return $this->hasMany(ServiceStatusHistory::class)->orderBy('created_at', 'asc');
    }

    // Relasi ke Sparepart (many-to-many dengan pivot)
    public function spareparts(): BelongsToMany
    {
        return $this->belongsToMany(Sparepart::class, 'service_sparepart')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Total biaya sparepart
    public function getTotalSparepartCostAttribute(): int
    {
        return $this->spareparts->sum(function ($sp) {
            return $sp->pivot->quantity * $sp->pivot->price;
        });
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

    // Daftar status yang tersedia
    public static function getStatusList(): array
    {
        return [
            'Menunggu Konfirmasi',
            'HP Diterima',
            'Pengecekan Kerusakan',
            'Menunggu Persetujuan Harga',
            'Dalam Proses Perbaikan',
            'Selesai & Siap Diambil',
            'Diambil Pelanggan',
        ];
    }
}