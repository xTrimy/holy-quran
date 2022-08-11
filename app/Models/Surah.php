<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;
    protected $table = "surah";
    protected $fillable = [
        'name',
        'ayah_count',
        'surah_order',
    ];
    public function surah_audio()
    {
        return $this->hasMany(SurahAudio::class);
    }
    
    public function ayat(){
        return $this->hasMany(Ayah::class);
    }

    
}
