<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Abrechnungen Verwalten') }}
        </h2>
    </x-slot>


    <div id="wrapper" class="w-11/12 mx-auto mt-6 justify-center container-fluid">
        <div class="w-100 flex justify-center items-center pt-6 sm:pt-0 bg-slate-800">
            <div class="w-100 mt-6 mx-auto justify-center  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <table class="table-auto border-collapse w-full border-slate-400 border-slate-500 bg-slate-800 text-sm shadow-sm">
                    <thead class="bg-slate-800 text-cyan-400">
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                        Abrechnungsnummer
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                        Datum
                    </th>
                    <th class="border border-slate-300 border-slate-600 font-semibold p-4 text-cyan-400 text-left">
                        Download
                    </th>
                    </thead>
                    <tbody class="bg-slate-700">
                    @foreach($invoices as $invoice)
                        <tr>
                            <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$invoice->id}}</th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">{{$invoice->created_at}}</th>
                            <th class="border border-slate-300 border-slate-700 p-4 text-cyan-400">
                                <form method="post" action="download">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$invoice->id}}">
                                    <input class="w-100 mt-1 px-4 py-2 font-semibold text-sm bg-slate-700 text-slate-700 bg-slate-700 text-white rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-sky-500 border-2 border-solid"
                                           type="submit" value="Download">
                                </form>
                            </th>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>


        <div class="max-w-7xl mt-6 mx-auto  p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="post" action="export">
                @csrf
                <input type="hidden" name="id" value="{{$invoice->id}}">
                <input class="w-100 mt-1 px-4 py-2 font-semibold text-sm bg-slate-700 text-slate-700 bg-slate-700 text-white rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-sky-500 border-2 border-solid"
                       type="submit" value="Neue Abbrechnung Erstellen">
            </form>
        </div>
    </div>



</x-app-layout>
