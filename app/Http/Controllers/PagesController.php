<?php

namespace App\Http\Controllers;

use App\Models\Ayah;
use App\Models\Surah;
use App\Models\SurahAudioSegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

class PagesController extends Controller
{
    public function index(){
        $surah = Surah::all();
        return view('index',['surah'=>$surah]);
    }
    public function surah($surah_name)
    {
        $surah_name = str_replace("-"," ",trim($surah_name," "));
        $surah = Surah::where('name', $surah_name)->first();
        // Session::put('reciter', "Abdul Bassit (Mujawwad)");
        Session::put('reciter', "Nasser Al Qatami");
        if (Session::get('reciter') == null) {
            Session::put('reciter', $surah->surah_audio->first()->reciter);
        }
        $reciter = Session::get('reciter');
        $surah = Surah::where('name', $surah_name)->with('surah_audio',function($q) use($reciter){
             $q->reciter($reciter)->with('segments')->first();
        })->first();
        if(!$surah){
            return redirect()->route('home');
        }
        $ayah = Ayah::where('surah_id',$surah->id)->orderBy('ayah_count','ASC')->get();
        return view('surah', ['surah' => $surah,'ayah'=>$ayah]);
    }

    public function surah_s($surah_name)
    {
        $surah_name = str_replace("-", " ", trim($surah_name, " "));
        $surah = Surah::where('name', $surah_name)->with('surah_audio', function ($q) {
            $q->first();
        })->first();
        if (!$surah) {
            return redirect()->route('home');
        }
        
        $ayah = Ayah::where('surah_id', $surah->id)->orderBy('ayah_count', 'ASC')->get();
        return view('surah_segmenting', ['surah' => $surah, 'ayah' => $ayah]);
    }
    public function surah_s_action(Request $request)
    {
        $audio_id = $request->audio_id;
        for($i=0; $i<count($request->ayah_id);$i++){
            $time = $request->time[$i];
            $ayah_id = $request->ayah_id[$i];
            $segment = new SurahAudioSegment;
            $segment->start_at = $time;
            $segment->ayah_id = $ayah_id;
            $segment->surah_audio_id = $audio_id;
            $segment->save();
        }
    }

    public function get_file_chunks($reciter,$file_path)
    {
        $file = "Quran/" . $reciter . "/" . $file_path;

        $extension = "mp3";
        $mime_type = "audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3";
        if (file_exists($file)) {
            header("Content-type: {$mime_type}");
            header("Accept-Ranges: bytes");
            header('Content-Length: ' . filesize($file));
            header('Content-Range: 0-' . (filesize($file)-1) . '/' . filesize($file));
            header('Content-Disposition: filename="' . $file_path);
            header('X-Pad: avoid browser bug');
            header('Cache-Control: no-cache');
            readfile($file);
        } else {
            header("HTTP/1.0 404 Not Found");
        }

    }
}
