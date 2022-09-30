<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Neues Getränk erstellen
        </h2>
    </x-slot>

    <x-auth-card-register>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/admin/drinks/create" enctype="multipart/form-data">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="" required autofocus />
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <!-- Barcode -->
            <div>
                <x-input-label for="barcode" :value="__('Barcode')" />

                <x-text-input id="barcode" class="block mt-1 w-full" type="number" name="barcode" value="" required/>
                @error('barcode')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <!-- Preis -->
            <div>
                <x-input-label for="price" :value="__('Preis')" />

                <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" value="" required/>
                @error('price')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <!-- Picture -->
            <div>
                <x-input-label for="picture" :value="__('Bild')" />

                <x-text-input id="picture" class="block mt-1 w-full" type="file" name="picture" value=""/>
                @error('picture')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-4">
                    {{ __('Erstellen') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card-register>
</x-app-layout>
