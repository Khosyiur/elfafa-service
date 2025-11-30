<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sparepart extends Model
{
    protected $table = 'spareparts';

    protected $fillable = [
        'name',
        'compatible_for',
        'price',
        'stock',
        'warranty',
        'image',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock' => 'integer',
            'active' => 'boolean',
        ];
    }

    // Relasi ke Stock History
    public function stockHistories(): HasMany
    {
        return $this->hasMany(SparepartStockHistory::class)->orderBy('created_at', 'desc');
    }

    // Relasi ke Service (many-to-many)
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_sparepart')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Status stok
    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) {
            return 'Habis';
        } elseif ($this->stock < 5) {
            return 'Hampir Habis';
        }
        return 'Tersedia';
    }

    // Badge stok
    public function getStockBadgeAttribute(): string
    {
        return match ($this->stock_status) {
            'Habis' => 'bg-red-100 text-red-800',
            'Hampir Habis' => 'bg-yellow-100 text-yellow-800',
            'Tersedia' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    // Format harga
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // URL gambar
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/spareparts/' . $this->image);
        }
        return null;
    }

    // Scope: hanya aktif
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    // Scope: stok tersedia
    public function scopeAvailable($query)
    {
        return $query->where('active', true)->where('stock', '>', 0);
    }

    // Scope: stok menipis (< 5)
    public function scopeLowStock($query)
    {
        return $query->where('active', true)->where('stock', '>', 0)->where('stock', '<', 5);
    }

    // Scope: stok habis
    public function scopeOutOfStock($query)
    {
        return $query->where('active', true)->where('stock', '<=', 0);
    }
}