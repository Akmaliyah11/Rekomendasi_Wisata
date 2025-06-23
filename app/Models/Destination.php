<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;


class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'lokasi', 'deskripsi', 'kategori_id', 'fasilitas', 'rating_rata2', 'image'];

    protected $casts = [
        'fasilitas' => 'array',
    ];

    public function kategori()
{
    return $this->belongsTo(Category::class, 'kategori_id');
}


    public function reviews()
    {
        return $this->hasMany(Review::class, 'destinasi_id');
    }

    public function preferences()
    {
        return $this->hasMany(UserPreference::class, 'destinasi_id');
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'destinasi_id');
    }
    public function getFasilitasArrayAttribute()
{
    if (is_array($this->fasilitas)) {
        return $this->fasilitas;
    }

    return explode(',', $this->fasilitas);
}


}

