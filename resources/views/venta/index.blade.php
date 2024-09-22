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
                    <h3 class="text-lg font-semibold mb-4">{{ __('Usuarios') }}</h3>
                    <x-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'my-modal')"
                        color="gray">
                        {{ __('Abrir modal') }}
                    </x-button>

                    <x-modal name="my-modal" :show="false" focusable maxWidth="sm">

                        <x-slot name="header">
                            Título del Modal
                        </x-slot>
                        <form action="{{ route('ventas.store') }}" method="POST">
                            @csrf

                            <!-- Puedes añadir un campo CSRF para seguridad si estás usando Laravel o algún otro framework -->
                            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" required>
                            <br><br>

                            <label for="description">Descripción:</label>
                            <textarea id="description" name="description" required></textarea>
                            <br><br>

                            <button type="submit">Guardar Venta</button>
                        </form>

                        <x-slot name="footer">
                            <x-button @click="show = false" color="pink">Cerrar</x-button>
                            {{-- <button @click="// Acción de guardar">Guardar</button> --}}
                        </x-slot>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
