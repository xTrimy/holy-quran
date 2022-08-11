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
    $western_arabic = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $eastern_arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
@endphp
  
    <div class="fixed bottom-0 w-full px-12 text-white bg-blue-500 py-4">
            <div class="text-center py-4 text-3xl">
                {{ $surah->name }}
            </div>
            <audio id="players" controls class="w-full py-4">
            <source src="{{ asset($surah->surah_audio->first()->path) }}" type="audio/mp3" />
            </audio>
    </div>
    
    <form method="post">
    @csrf
    <div class="surah p-5 max-w-7xl w-full mx-auto text-center pb-72">    
    <div class="w-90 max-w-full h-14 mb-8">
        <img src="{{ asset('images/بسم-الله-الرحمن-الرحيم.png') }}" class="w-full h-full object-contain object-center {{ ($surah->surah_order == 1)?"hidden":"" }}" alt="">
    </div>
    <input type="hidden" name="audio_id" value="{{ $surah->surah_audio->first()->id }}">
    @foreach ($ayah as $a)
        <span> {{ $a->ayah }} </span><span> {{ str_replace($western_arabic, $eastern_arabic, strrev($a->ayah_count)) }}</span> <br>
        <input type="hidden" name="ayah_id[]" value="{{ $a->id }}">
        <input class="border border-black border-solid" type="text" name="time[]" value=""><br>
    @endforeach
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 mt-4" >حفظ</button>
    </div>

    </form>
    <script>
        
const player = new Plyr('#players',{
      title: '{{ $surah->name }}',
});
console.log(player);
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
document.addEventListener('keydown', function(e) {
    if (e.keyCode == 32) {  
        document.activeElement.value = player.currentTime;
    }
    var target = e.srcElement || e.target;
    var next = target;
    while (next = next.nextElementSibling) {
        if (next == null)
            break;
        if (next.tagName.toLowerCase() === "input" && next.type === "text") {
            next.focus();
            break;
        }
    }
});

setInterval(function(){
    console.log(player.currentTime);
},500);
    </script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>