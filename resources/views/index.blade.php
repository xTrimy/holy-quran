<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <title>القرآن الكريم</title>
</head>
<body dir="rtl" class="overflow-x-hidden">
    <div class="flex flex-wrap justify-center">    
    @foreach ($surah as $s)
    <a href="{{ route('surah',str_replace(' ','-',rtrim($s->name," "))) }}">
        <div class="bg-blue-500 text-white w-64 m-4 py-4 px-8 items-center flex text-3xl">
            <div class="w-12 h-12 bg-blue-700 ml-4 rounded-full text-xl flex justify-center items-center">
                {{ $s->surah_order }}
            </div>
            <span class="icon-surah icon-surah-surah"></span>
            <span class="icon-surah icon-surah{{ $s->surah_order }}"></span>
        </div>
        </a>
    @endforeach
    </div>

</body>
</html>