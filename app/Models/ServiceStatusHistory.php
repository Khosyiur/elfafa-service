<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceStatusHistory extends Model
{
    protected $table = 'service_status_histories';

    protected $fillable = [
        'service_id',
        'status',
        'note',
    ];

    // Relasi ke Service
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Status icon untuk timeline
    public function getStatusIconAttribute(): string
    {
        return match ($this->status) {
            'Menunggu Konfirmasi' => 'fa-clock',
            'HP Diterima' => 'fa-box',
            'Pengecekan Kerusakan' => 'fa-search',
            'Menunggu Persetujuan Harga' => 'fa-dollar-sign',
            'Dalam Proses Perbaikan' => 'fa-wrench',
            'Selesai & Siap Diambil' => 'fa-check-circle',
            'Diambil Pelanggan' => 'fa-handshake',
            'Ditolak' => 'fa-times-circle',
            default => 'fa-info-circle',
        };
    }

    // Status color untuk timeline
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'Menunggu Konfirmasi' => 'text-yellow-500',
            'HP Diterima' => 'text-blue-500',
            'Pengecekan Kerusakan' => 'text-indigo-500',
            'Menunggu Persetujuan Harga' => 'text-orange-500',
            'Dalam Proses Perbaikan' => 'text-purple-500',
            'Selesai & Siap Diambil' => 'text-green-500',
            'Diambil Pelanggan' => 'text-gray-500',
            'Ditolak' => 'text-red-500',
            default => 'text-gray-400',
        };
    }
}