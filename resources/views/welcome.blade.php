<x-app-layout>
    <x-slot name="title">
        {{ config('app.name', 'Dylan11') }} - Inicio
    </x-slot>

    <div class="welcome-content">
        {{ __("You're logged in!") }}
        <h1>hola</h1>
    </div>
</x-app-layout>

<style>
    .welcome-content {
        color: light-dark(#000000, #efefec);
        background-color: light-dark(#5910cf54, #1d1d1d8e);
        padding: 5px;
        border-radius: 5px;
    }
</style>
