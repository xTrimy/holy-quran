<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurahAudio extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'surah_id',
    ];

    public function surah(){
        return $this->belongsTo(Surah::class);
    }
    
    public function scopeReciter($query, $reciter)
    {
        return $query->where('reciter', $reciter);
    }

    public function segments()
    {
        return $this->hasMany(SurahAudioSegment::class);
    }

}
