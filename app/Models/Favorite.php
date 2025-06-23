<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'destinasi_id'];

    public function destinasi()
{
    return $this->belongsTo(Destination::class, 'destinasi_id');
}

}
