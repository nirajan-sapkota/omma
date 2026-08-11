<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiometricAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'booking_id',
        'tested_by',
        'sight',
        'hearing',
        'speaking',
        'colour_blindness',
        'physical_ability',
        'overall_result',
        'notes',
        'tested_at',
    ];

    protected $casts = [
        'tested_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function tester()
    {
        return $this->belongsTo(
            User::class,
            'tested_by'
        );
    }
}   