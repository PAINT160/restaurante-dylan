@props(['backgroundColor' => null, 'textColor' => null, 'fullWidth' => false])

@php
    // Definir la clase de ancho basado en la opción fullWidth
    $widthClass = $fullWidth ? 'w-full' : 'w-auto';

    $backgroundColors = [
        'green' => 'bg-green',
        'blue' => 'bg-blue',
        'red' => 'bg-red',
        'yellow' => 'bg-yellow',
    ];

    $textColors = [
        'blue' => 'text-blue',
        'white' => 'text-white',
        'black' => 'text-black',
        'gray' => 'text-gray',
    ];

    $backgroundClass = $backgroundColor ? $backgroundColors[$backgroundColor] ?? '' : '';
    $textClass = $textColor ? $textColors[$textColor] ?? $textColors['blue'] : $textColors['blue'];

    $defaultStyle = !$backgroundColor && !$textColor ? 'link-default' : '';
    $linkClass = trim("link {$backgroundClass} {$textClass} {$widthClass} {$defaultStyle}");
@endphp

<a {{ $attributes->merge([
    'class' => $linkClass,
]) }}>
    {{ $slot }}
</a>

<style>
    /* Colores de fondo */
    .bg-green {
        background-color: #48bb78;
    }

    .bg-blue {
        background-color: #4299e1;
    }

    .bg-red {
        background-color: #f56565;
    }

    .bg-yellow {
        background-color: #ecc94b;
    }

    /* Colores de texto */
    .text-blue {
        color: #3182ce !important;
    }

    .text-white {
        color: white !important;
    }

    .text-black {
        color: black !important;
    }

    .text-gray {
        color: gray !important;
    }

    /* Estilos de enlaces */
    .link {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem;
        border: 2px solid transparent;
        border-radius: 0.375rem;
        font-weight: normal;
        font-size: 0.875rem;
        text-transform: none;
        letter-spacing: normal;
        text-decoration: none;
        color: inherit;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
    }

    .link:hover {
        color: #2b6cb0;
    }

    .link:focus {
        outline: 2px solid;
        outline-offset: 2px;
    }

    /* Enlaces por defecto (azul con subrayado siempre) */
    .link-default {
        text-decoration: underline !important;
        /* Subrayado siempre */
        color: #3182ce !important;
        /* Azul por defecto */
    }

    /* Clase para ancho completo */
    .w-full {
        width: 100%;
    }

    /* Clase para ancho automático basado en el contenido */
    .w-auto {
        width: auto;
    }
</style>
