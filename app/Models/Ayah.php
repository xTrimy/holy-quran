<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    use HasFactory;
    protected $table = "ayah";

    protected $fillable = [
        'ayah',
        'ayah_count',
        'surah_id',
    ];

    
}
