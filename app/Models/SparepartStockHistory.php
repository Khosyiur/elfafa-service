<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SparepartStockHistory extends Model
{
    protected $table = 'sparepart_stock_histories';

    protected $fillable = [
        'sparepart_id',
        'change_type',
        'quantity',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    // Relasi ke Sparepart
    public function sparepart(): BelongsTo
    {
        return $this->belongsTo(Sparepart::class);
    }

    // Badge type
    public function getTypeBadgeAttribute(): string
    {
        return match ($this->change_type) {
            'IN' => 'bg-green-100 text-green-800',
            'OUT' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    // Label type
    public function getTypeLabelAttribute(): string
    {
        return match ($this->change_type) {
            'IN' => 'Masuk',
            'OUT' => 'Keluar',
            default => '-',
        };
    }
}