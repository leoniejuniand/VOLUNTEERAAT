<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'event_date',
        'registration_deadline',
        'quota',
        'location',
        'secretariat_id',
        'status'
    ];

    // Relasi: 1 Event dimiliki oleh 1 Sekretariat
    public function secretariat()
    {
        return $this->belongsTo(Secretariat::class);
    }
    // Relasi: 1 Event bisa memiliki banyak pendaftar (User)
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}