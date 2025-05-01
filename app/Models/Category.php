<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function destinations()
    {
        return $this->hasMany(Destination::class, 'kategori_id');
    }

    public function preferences()
    {
        return $this->hasMany(UserPreference::class);
    }
}
