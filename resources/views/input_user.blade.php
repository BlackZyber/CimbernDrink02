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
<div class="min-h-screen bg-gray-100">
    <form method="POST" action="/drinks" enctype="multipart/form-data">
        @csrf
        <input type="number" name="barcode" autofocus>
    </form>
    <div id="wrapper" class="w-11/12 mx-auto justify-center">
        @error('barcode')
        <p>{{$message}}</p>
        @enderror
        <div class="w-100 flex justify-center items-center pt-6 sm:pt-0 bg-gray-100">

            <div class="w-100 mt-6 mx-auto justify-center  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <table class="table-auto border-collapse w-full border border-slate-400 border-slate-500 bg-white bg-slate-800 text-sm shadow-sm">
                    <thead class="bg-slate-50 bg-slate-700">
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                      Deine aktuelle Rechnung: {{ Auth::user()->amount }}€
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                        Bezeichnung
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                        Preis
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                        Abgestrichen am
                    </th>
                    </thead>
                    <tbody>
                    @foreach($drinks as $drink)
                        <tr class="">
                            <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">
                                <img class="h-10 mr-6 md:block"
                                     src="{{$drink->picture ? asset('storage/'.$drink->picture) : asset('storage/img/no-image.png')}}"
                                     alt=""/>
                            </th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">{{$drink->name}}</th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">{{$drink->price}}€</th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">{{$drink->pivot->created_at->format('d.m.Y H:i')}}</th>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    setTimeout(function() {
        //window.location.href = "{{ route('logout') }}"
        $.ajax({
            type: "POST",
            url: "{{ route('logout') }}",
            data: {"_token": "{{ csrf_token() }}"},
        })
            .done(function () {
                window.location.replace("/presssystem")
            })
            .fail(function () {
                window.location.replace("/presssystem")
            })
    }, 70000);
</script>

</body>







