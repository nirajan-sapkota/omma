<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: upcoming bookings
     */
    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>=', now()->toDateString())
                     ->orderBy('appointment_date')
                     ->orderBy('appointment_time');
    }
    protected $casts = [
    'appointment_date' => 'date',
    'appointment_time' => 'string', // keep as string
];

}
