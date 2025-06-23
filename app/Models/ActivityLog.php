<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Jika kamu punya nama tabel khusus:
    // protected $table = 'nama_tabel';

    // Kolom yang bisa diisi massal (opsional, tergantung kebutuhan):
    // protected $fillable = ['user_id', 'action', 'created_at'];
}
