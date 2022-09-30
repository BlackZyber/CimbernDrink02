<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$user->name}} ändern
        </h2>
    </x-slot>

    <x-auth-card-register>
        <!-- Validation Errors -->

        <form method="POST" action="/admin/user/{{$user->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus />
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <!-- E-Mail -->
            <div>
                <x-input-label for="email" :value="__('E-Mail')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required/>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Passwort')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" value="" required/>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-4">
                    {{ __('Ändern') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card-register>
</x-app-layout>
