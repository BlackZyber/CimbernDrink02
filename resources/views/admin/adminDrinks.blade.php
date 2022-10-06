<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Getränke verwalten') }}
        </h2>
    </x-slot>

    <div id="wrapper" class="w-11/12 mx-auto mt-6 justify-center container-fluid">
        <div class="w-100 flex justify-center items-center pt-6 sm:pt-0 bg-slate-800">
            <div class="w-100 mt-6 mx-auto justify-center  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <table class="table-auto border-collapse w-full border-slate-400 border-slate-500 bg-slate-800 text-sm
                 shadow-sm">
            <thead class="bg-slate-800 text-cyan-400">
            <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                Id
            </th>
            <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                Getränk
            </th>
            <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                Preis
            </th>
            <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                Logo
            </th>
            <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                Bearbeiten
            </th>
            </thead>
            <tbody class="bg-slate-700">
            @foreach($drinks as $drink)
                <tr class="">
                    <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$drink->id}}</th>
                    <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$drink->name}}</th>
                    <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$drink->price}}</th>
                    <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">
                        <img class="h-10 mr-6 md:block"
                             src="{{$drink->picture ? asset('storage/'.$drink->picture) : asset('storage/img/no-image.png')}}"
                             alt=""/></th>
                    <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400 flex">
                        <a href="/admin/drinks/{{$drink->id}}/edit"
                           class="w-fit mt-1 px-4 py-2 font-semibold text-sm bg-slate-700 text-slate-700 bg-slate-700 text-white rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-sky-500 border-2 border-solid">
                            Edit</a>
                    </th>
                </tr>
            @endforeach

            </tbody>
            </table>
        </div>
    </div>


    <div class="max-w-7xl mt-6 mx-auto  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <a href="/admin/drinks/create"
           class="w-f mt-1 px-4 py-2 font-semibold text-sm bg-slate-700 text-slate-700 bg-slate-700 text-white rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-sky-500 border-2 border-solid">
            Getränke erstellen
        </a>
    </div>
    </div>


</x-app-layout>
