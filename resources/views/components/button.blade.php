@props(['backgroundColor' => 'default', 'textColor' => 'default-color', 'fullWidth' => false])

@php
    $backgroundColors = [
        'green' => 'bg-green',
        'blue' => 'bg-blue',
        'red' => 'bg-red',
        'yellow' => 'bg-yellow',
        'purple' => 'bg-purple',
        'pink' => 'bg-pink',
        'orange' => 'bg-orange',
        'teal' => 'bg-teal',
        'cyan' => 'bg-cyan',
        'indigo' => 'bg-indigo',
        'gray' => 'bg-gray',
        'lime' => 'bg-lime',
        'amber' => 'bg-amber',
        'emerald' => 'bg-emerald',
        'rose' => 'bg-rose',
        'violet' => 'bg-violet',
        'slate' => 'bg-slate',
        'neutral' => 'bg-neutral',
        'stone' => 'bg-stone',
        'fuchsia' => 'bg-fuchsia',
        'light-blue' => 'bg-light-blue',
        'lime-green' => 'bg-lime-green',
        'default' => 'default-color',
    ];

    $textColors = [
        'white' => 'text-white',
        'black' => 'text-black',
        'gray' => 'text-gray',
        'default-color' => 'default-color',
    ];

    $backgroundClass = $backgroundColors[$backgroundColor] ?? $backgroundColors['default'];
    $textClass = $textColors[$textColor] ?? $textColors['default-color'];

    // Añadimos la clase 'w-full' si fullWidth es verdadero, si no, 'w-auto'.
    $widthClass = $fullWidth ? 'w-full' : 'w-auto';
@endphp

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => "button {$backgroundClass} {$textClass} {$widthClass}",
]) }}>
    {{ $slot }}
</button>

<style>
    /* Colores de fondo */
    .bg-green {
        background-color: light-dark(#04fd3a, #0d5803);
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

    .bg-purple {
        background-color: #9f7aea;
    }

    .bg-pink {
        background-color: #ed64a6;
    }

    .bg-orange {
        background-color: #f6ad55;
    }

    .bg-teal {
        background-color: #38b2ac;
    }

    .bg-cyan {
        background-color: #00bcd4;
    }

    .bg-indigo {
        background-color: #5a67d8;
    }

    .bg-gray {
        background-color: gray;
    }

    .bg-lime {
        background-color: #d9f99d;
    }

    .bg-amber {
        background-color: #fbbf24;
    }

    .bg-emerald {
        background-color: #34d399;
    }

    .bg-rose {
        background-color: #f43f5e;
    }

    .bg-violet {
        background-color: #7f3fbb;
    }

    .bg-slate {
        background-color: #2d3748;
    }

    .bg-neutral {
        background-color: #6b7280;
    }

    .bg-stone {
        background-color: #c4b5fd;
    }

    .bg-fuchsia {
        background-color: #d946ef;
    }

    .bg-light-blue {
        background-color: #bae6fd;
    }

    .bg-lime-green {
        background-color: #32a852;
    }

    /* Nuevo color */
    .default-color {
        background-color: light-dark(#e6e6bd, #062f58);
    }

    /* Colores de texto */
    .text-white {
        color: white;
    }

    .text-black {
        color: black;
    }

    .text-gray {
        color: gray;
    }

    .default-color {
        color: light-dark(#000000, #ffffffe3);
    }

    /* Estilos del botón */
    .button {
        display: inline-flex;
        justify-content: center; /* Centra el contenido horizontalmente */
        align-items: center;
        padding: 0.5rem;
        border: 2px solid transparent;
        border-radius: 0.375rem;
        font-weight: bold;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        transition: all 0.15s ease-in-out;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        margin-bottom: 10px;
    }

    .button:hover {
        filter: brightness(90%);
    }

    .button:focus {
        outline: 2px solid;
        outline-offset: 2px;
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
