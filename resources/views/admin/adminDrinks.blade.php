<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Getränke verwalten') }}
        </h2>
    </x-slot>

    <div id="wrapper" class="pt-6">
        <div class="max-w-7xl mt-6 mx-auto  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table class="table-auto border-collapse w-full border border-slate-400 border-slate-500 bg-white bg-slate-800 text-sm shadow-sm">
                <thead class="bg-slate-50 bg-slate-700">
                <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                    Id
                </th>
                <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                    Getränk
                </th>
                <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                    Preis
                </th>
                <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                    Logo
                </th>
                <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-slate-900 text-slate-200 text-left">
                    Bearbeiten
                </th>
                </thead>
                <tbody>
                @foreach($drinks as $drink)
                    <tr class="">
                        <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">{{$drink->id}}</th>
                        <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">{{$drink->name}}</th>
                        <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">{{$drink->price}}</th>
                        <th class="border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">
                            <img class="h-10 mr-6 md:block"
                                 src="{{$drink->picture ? asset('storage/'.$drink->picture) : asset('storage/img/no-image.png')}}"
                                 alt=""/></th>
                        <th class="max-h-3 border border-slate-300 border-slate-700 p-4 text-slate-500 text-slate-400">
                            <a href="/admin/drinks/{{$drink->id}}/edit"
                               class="w-100 mt-1 px-4 py-2 font-semibold text-sm bg-slate-700 text-slate-700 bg-slate-700 text-white rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-sky-500 border-2 border-solid">
                                Edit</a>
                        </th>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>


        <div class="max-w-7xl mt-6 mx-auto  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="post" action="export">
                @csrf
                <input type="hidden" name="id" value="">
                <input class="w-100 mt-1 px-4 py-2 font-semibold text-sm bg-slate-700 text-slate-700 bg-slate-700 text-white rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-sky-500 border-2 border-solid"
                       type="submit" value="Neues Getränk Erstellen">
            </form>
        </div>
    </div>


</x-app-layout>
