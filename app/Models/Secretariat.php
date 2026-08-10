<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretariat extends Model
{
    use HasFactory;

    // Mengizinkan kolom name untuk diisi massal
    protected $fillable = ['name'];

    // Relasi: 1 Sekretariat memiliki banyak User (Relawan/Admin)
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}