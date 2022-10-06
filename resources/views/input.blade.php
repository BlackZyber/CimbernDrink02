<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-slate-800 text-cyan-400">
    <div id="wrapper" class="w-11/12 mx-auto justify-center">
        @error('barcode')
        <p>{{$message}}</p>
        @enderror
        <div class="w-100 flex justify-center items-center pt-6 sm:pt-0 bg-slate-800 text-cyan-400">

            <div class="w-100 mt-6 mx-auto justify-center  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <table class="border-collapse w-100 w-full border border-slate-400 border-slate-500 bg-white text-sm shadow-sm">
                    <thead class="bg-slate-50 bg-white">
                    <th class="w-1/2 border border-slate-300 border-slate-600 font-semibold p-4 text-slate-200 text-left align-baseline">
                        <p class="w-60 mt-1 float-start">Name</p>
                        <form class="opacity: 0" method="POST" action="/presssystem/user" enctype="multipart/form-data">
                            @csrf
                            <input type="number" name="barcode" autofocus
                                   class="w-40 opacity: 0 border-0 text-white focus:outline-none focus:border-0 focus:box-shadow-0 bg-slate-700"
                                   style="outline: none !important;
    border:0;
    box-shadow: 0 0 0px #ffffff;
    -webkit-appearance: none !important;
    float: right;">
                        </form>
                    </th>
                    <th class="w-1/2 border border-slate-300 border-slate-600 font-semibold p-4 text-slate-200 text-left">
                        <p class="w-60 float-start">Kontostand</p>
                    </th>
                    </thead>
                    <tbody>
                    @php
                        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    @endphp
                    @foreach($users as $user)
                        <tr>
                            <th class="border bg-slate-800 text-cyan-400 p-4 text-slate-400">{{$user->name}}</th>
                            <th class="border bg-slate-800 text-cyan-400 p-4 text-slate-400">{{($user->amount)}}
                                €
                            </th>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
</body>




