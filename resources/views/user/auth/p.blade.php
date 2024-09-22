
<x-modal name="my-modal" :show="false" focusable maxWidth="md">

    <x-slot name="header">
        Título del Modal
    </x-slot>
    <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf
        <!-- Puedes añadir un campo CSRF para seguridad si estás usando Laravel o algún otro framework -->
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br><br>

        <button type="submit">Registrarse</button>
    </form>

    <x-slot name="footer">
        <x-button @click="show = false" color="pink">Cerrar</x-button>
        {{-- <button @click="// Acción de guardar">Guardar</button> --}}
    </x-slot>
</x-modal>

<x-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'my-modal')" color="gray">
    {{ __('Abrir modal') }}
</x-button>