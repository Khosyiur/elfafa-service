<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimonis';

    protected $fillable = [
        'title',
        'description',
        'before_photo',
        'after_photo',
    ];

        public function getBeforePhotoUrlAttribute(): ?string
    {
        if ($this->before_photo) {
            return asset('storage/testimonis/' . $this->before_photo); // ✅
        }
        return null;
    }

    public function getAfterPhotoUrlAttribute(): ?string
    {
        if ($this->after_photo) {
            return asset('storage/testimonis/' . $this->after_photo); // ✅
        }
        return null;
    }

    // Cek apakah punya foto
    public function getHasPhotosAttribute(): bool
    {
        return $this->before_photo || $this->after_photo;
    }
}