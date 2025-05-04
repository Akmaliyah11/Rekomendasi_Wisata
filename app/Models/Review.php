<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id', 'user_id', 'komentar', 'rating'
    ];

    // Relasi dengan model Destination
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


