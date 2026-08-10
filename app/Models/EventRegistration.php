<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'is_present',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}