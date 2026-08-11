<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'service_name',
        'appointment_date',
        'appointment_time',
        'status',
        'meet_link',
        'payment_receipt',
        'payment_reference',
        'payment_status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->hasOne(
            Patient::class,
            'user_id',
            'user_id'
        );
    }

    public function biometricAssessment()
    {
        return $this->hasOne(BiometricAssessment::class);
    }

    public function scopeUpcoming($query)
    {
        return $query
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time');
    }

    public function getIsOnlineAttribute()
    {
        return $this->category === 'online';
    }

    public function getFormattedDateAttribute()
    {
        return $this->appointment_date->format('D, M j, Y');
    }

    public function getFormattedTimeAttribute()
    {
        try {
            return \Carbon\Carbon::parse($this->appointment_time)->format('g:i A');
        } catch (\Throwable $e) {
            return $this->appointment_time;
        }
    }

    public function getPaymentReceiptUrlAttribute(): ?string
    {
        if (!$this->payment_receipt) {
            return null;
        }

        if (str_starts_with($this->payment_receipt, 'http://') || str_starts_with($this->payment_receipt, 'https://')) {
            return $this->payment_receipt;
        }

        return \Illuminate\Support\Facades\Storage::url($this->payment_receipt);
    }
}