<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * A user can have many bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * A user can have one patient profile.
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * A staff member can perform many biometric assessments.
     */
    public function biometricAssessments()
    {
        return $this->hasMany(
            BiometricAssessment::class,
            'tested_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isPatient(): bool
    {
        return $this->role === 'patient';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDoctor(): bool
    {
        return $this->role === 'doctor';
    }

    public function isTestingStaff(): bool
    {
        return $this->role === 'testing_staff';
    }


    /*
    |--------------------------------------------------------------------------
    | Filament Access
    |--------------------------------------------------------------------------
    */

    public function canAccessPanel(
        \Filament\Panel $panel
    ): bool {
        return in_array($this->role, [
            'admin',
            'doctor',
            'testing_staff',
        ]);
    }
}