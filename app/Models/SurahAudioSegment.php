<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurahAudioSegment extends Model
{
    use HasFactory;
    protected $fillable = [
        'ayah_id',
        'surah_audio_id',
        'start_at',
    ];
}
