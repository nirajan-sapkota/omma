<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'payment_image',
        'instructions',
        'amount',
        'account_name',
        'account_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getActiveSetting(): ?self
    {
        try {
            return self::where('is_active', true)->latest()->first() 
                ?? self::latest()->first();
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->payment_image) {
            return null;
        }

        if (str_starts_with($this->payment_image, 'http://') || str_starts_with($this->payment_image, 'https://')) {
            return $this->payment_image;
        }

        return Storage::url($this->payment_image);
    }
}
