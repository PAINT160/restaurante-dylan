<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Usuario') }}</h3>
                    <h1>Detalles del Usuario</h1>
                    <p>ID: {{ $user->id }}</p>
                    <p>Nombre: {{ $user->name }}</p>
                    <p>Correo Electrónico: {{ $user->email }}</p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
