<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div id="wrapper" class="w-11/12 mx-auto mt-6 justify-center">
        <div class="w-100 flex justify-center items-center pt-6 sm:pt-0 bg-slate-800">

            <div class="w-100 mt-6 mx-auto justify-center  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <table class="table-auto border-collapse w-full border border-slate-400 border-slate-500 bg-slate-800 text-sm shadow-sm">
                    <thead class="bg-slate-800 text-cyan-400">
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                        Deine aktuelle Rechnung: {{ Auth::user()->amount }}€
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                        Bezeichnung
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                        Preis
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                        Abgestrichen am
                    </th>
                    </thead>
                    <tbody>
                    @foreach($drinks as $drink)
                        <tr class="">
                            <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">
                                <img class="h-10 mr-6 md:block"
                                     src="{{$drink->picture ? asset('storage/'.$drink->picture) : asset('storage/img/no-image.png')}}"
                                     alt=""/>
                            </th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$drink->name}}</th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$drink->price}}€</th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$drink->pivot->created_at->format('d.m.Y H:i')}}</th>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
