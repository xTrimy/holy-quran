<?php

use App\Http\Controllers\PagesController;
use App\Models\Ayah;
use App\Models\Surah;
use App\Models\SurahAudio;
use App\Models\SurahAudioSegment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PagesController::class, 'index'])->name( 'home');
Route::get('/surah/{surah_name}', [ PagesController::class, 'surah'])->name('surah');
Route::get( '/surah/{surah_name}/s', [PagesController::class, 'surah_s'])->name('surah_s');
Route::post('/surah/{surah_name}/s', [PagesController::class, 'surah_s_action']);
Route::get('/q/{reciter}/{file_path}', [PagesController::class, 'get_file_chunks'])->name('get_file_chunks');

Route::get('/testtest',function(){
    dd('x');
    $audio_segments = SurahAudioSegment::where("surah_audio_id",">=", 229)->get();
    foreach ($audio_segments as $audio_segment) {
        $audio_segment->delete();
    }
   
    $reciter = "Abdul_Basit_Mujawwad";
    $segments_file = fopen("json/segments/". $reciter."_segments.json", "r");
    $segments_json = fread($segments_file, filesize("json/segments/". $reciter."_segments.json"));
    $segments_array = json_decode($segments_json, true);
    $surah_audio = 229;
    $ayah = 1;
    foreach($segments_array as $surah){
        $surah_number = $surah['surah'];
        $i = 0;
        foreach($surah["segments"] as $segment){
            $surah_db = Surah::where('surah_order', $surah_number)->first();
            $ayah_db = Ayah::where('surah_id', $surah_db->id)->get();
            $ayah_count = $ayah_db->count();
            
            if($i == $ayah_count){
                break;
            }
            $i++;

            $surah_ayah = $ayah++;
            $surah_audio_segment = new SurahAudioSegment;
            $surah_audio_segment->start_at = $segment;
            $surah_audio_segment->surah_audio_id = $surah_audio;
            $surah_audio_segment->ayah_id = $surah_ayah;
            $surah_audio_segment->save();
        }
        $surah_audio++;
    }
    dd($segments_array);
    $i = 8;
    $segment_delete = SurahAudioSegment::where('surah_audio_id', '=', 116)->get();
    foreach ($segment_delete as $segment) {
        $segment->delete();
    }
    foreach($segments as $segment_value){
        $segment = new SurahAudioSegment();
        $segment->ayah_id = $i++;
        $segment->surah_audio_id = 116;
        $segment->start_at = $segment_value;
        $segment->save();
    }
});


Route::get('add_audio_files',function(){
    for($i=1; $i<=114; $i++){
        $surah_audio = new SurahAudio();
        $surah_audio->surah_id = $i+1;
        $surah_audio->path = "Quran/Abdul_Bassit_Mujawwad/".str_pad($i, 3, "0", STR_PAD_LEFT).".mp3";
        $surah_audio->reciter = "Abdul Bassit (Mujawwad)";
        $surah_audio->save();
    }
});