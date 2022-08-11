<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ $surah->name }}</title>
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
    <style>
        #list {
    margin: 0 auto;
    width: 60%;
    height: 100%;
    position: relative;
    overflow: auto;
    background: #2879364f;
    justify-content: flex-start; 
}
    </style>
</head>
<body dir="rtl" class="overflow-x-hidden">
    {{-- <div id="player" class="fixed bottom-0 w-full h-48">
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-40"></div>
<div id="title">
    <span id="track"></span>
    <div id="timer">0:00</div>
    <div id="duration">0:00</div>
  </div>

  <!-- Controls -->
  <div class="controlsOuter">
    <div class="controlsInner">
      <div id="loading"></div>
      <div class="btn" id="playBtn"></div>
      <div class="btn" id="pauseBtn"></div>
      <div class="btn opacity-0" id="prevBtn"></div>
      <div class="btn opacity-0" id="nextBtn"></div>
    </div>
    <div class="btn hidden" id="playlistBtn"></div>
    <div class="btn" id="volumeBtn"></div>
  </div>

  <!-- Progress -->
  <div id="waveform"></div>
  <div id="bar"></div>
  <div id="progress"></div>

  <!-- Playlist -->
  <div id="playlist" c>
    <div id="list"></div>
  </div>

  <!-- Volume -->
  <div id="volume" class="fadeout">
    <div id="barFull" class="bar"></div>
    <div id="barEmpty" class="bar"></div>
    <div id="sliderBtn"></div>
  </div>


    </div> --}}

@php

    if(Session::get('reciter') == null){
        Session::put('reciter',$surah->surah_audio->first()->reciter);
    }
    $current_reciter = Session::get('reciter');
    $audio = explode('/',$surah->surah_audio->first()->path);
    $reciter = $audio[1];
    $surah_file = $audio[2];
    $western_arabic = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $eastern_arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
@endphp
  
    <div class="fixed bottom-0 w-full px-12 z-50 text-white bg-blue-500 py-4">
            <div class="text-center py-4 text-3xl">
                {{ $surah->name }}
            </div>
            <audio id="players" controls class="w-full py-4">
            <source src="{{ route('get_file_chunks',["reciter"=>$reciter,"file_path"=>$surah_file]) }}" type="audio/mp3" />
            </audio>
    </div>
    
    
    <div class="surah p-5 max-w-7xl w-full mx-auto text-center pb-72">    
    <div class="w-90 max-w-full h-14 mb-8">
        <img src="{{ asset('images/بسم-الله-الرحمن-الرحيم.png') }}" class="w-full h-full object-contain object-center {{ ($surah->surah_order == 1 || $surah->surah_order == 9)?"hidden":"" }}" alt="">
    </div>
    @foreach ($ayah as $a)
        <span class="ayah inline group relative cursor-pointer hover:bg-gray-100" id="ayah-{{ $a->id }}">
             <span class="z-30 relative">{{ $a->ayah }}</span>
            {{-- <div class="hidden group-hover:block absolute left-1/2 bottom-1/2 transform -translate-x-1/2 -translate-y-1/2 z-40 -mt-4  py-2 px-6 bg-gray-500 ">
                <i class="las la-play"></i>
            </div> --}}
        </span>
        <span class="inline"> {{ str_replace($western_arabic, $eastern_arabic, $a->ayah_count) }}</span>
    @endforeach
    </div>
    <script>
    
const player = new Plyr('#players',{
      title: '{{ $surah->name }}',
});
        var albumData = {
    title: "{{ $surah->name }}",
    tracks: [
        {
            id: ":1:",
            title: "{{ $surah->name }}",
            mp3_link:
                "{{ asset("Quran_test/001.mp3") }}"
        },
    ]
};

    </script>
    <script>
        
const segments = [
    @foreach ($surah->surah_audio->first()->segments as $segment)
        '{{ $segment->ayah_id }}',
    @endforeach
    ];
const segments_times = [
@foreach ($surah->surah_audio->first()->segments as $segment)
        '{{ $segment->start_at }}',
    @endforeach
    "999999"
];

var ayat = document.getElementsByClassName('ayah');
for(let i = 0; i < ayat.length; i++){
    let ayah = ayat[i];
    ayah.addEventListener('click', function(){
        let id = ayah.id.split('-')[1];
        let index = segments.indexOf(id);
        let time = segments_times[index];

        player.currentTime = Math.ceil(time);
        if(!player.playing){
            player.play();
        }
    });
}

var current_ayah_style = "text-red-500";
var current_segment = 0;
var current_ayah_temp;
setInterval(function(){
    if(player.stopped || player.ended){
        for(var i = 0; i<ayat.length;i++){
            ayat[i].classList.remove(current_ayah_style)
        }
    }
    if(player.playing){
        var currentTime = player.currentTime;
        console.log(currentTime);
        var current = 0;
        for(let i = 0; i<segments.length; i++){
            if(segments_times[i] < currentTime && segments_times[i+1] > currentTime){
                current_ayah = document.getElementById('ayah-'+segments[i]);
                    for(var j = 0; j<ayat.length;j++){
                        ayat[j].classList.remove(current_ayah_style)
                    }
                    current_ayah.classList.add(current_ayah_style);
                if(current_ayah != current_ayah_temp){
                    current_ayah_temp = current_ayah;
                    current_ayah.scrollIntoView();
                }
                return;
            }
        }
    }
},500);
</script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>