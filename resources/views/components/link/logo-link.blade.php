<!-- resources/views/components/logo-link.blade.php -->
@props([
    'href' => '/',
])

<a href="{{ $href }}" class="logo" >
    @if (isset($logo))
        <span class="logo-img">
            {{ $logo }}
        </span>
    @endif
    <span class="logo-text">
        {{ $slot }}
    </span>
</a>

<style>
    .logo {
        display: flex;
        align-items: center;
        transition: color 0.3s;
        display: inline-flex; /* Cambiado a inline-flex para que ocupe solo el ancho del contenido */
        align-items: center;
        justify-content: center;
        transition: color 0.3s ease, transform 0.3s ease;
        padding: 0; /* Mantener el padding para un mejor espacio interno */
    }

    .logo-img {
        max-height: 2rem;
        /* Ajusta el tamaño máximo del logo */
        max-width: 100%;
        height: auto;
        width: auto;
        margin-right: 0.1rem;
        /* Espacio entre la imagen y el texto */
        border: none;
    }

    .logo-text {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>
