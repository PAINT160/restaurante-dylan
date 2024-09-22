@props([
    'type' => 'button',
    'size' => 'md', // Tamaños: sm, md, lg
])

@php
    // Definir las clases de tamaño
    $sizeClasses = [
        'sm' => 'btn-small',
        'md' => 'btn-medium',
        'lg' => 'btn-large',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$sizeClass btn"]) }}>
    <span class="btn-icon">
        {{ $icon ?? '' }}
    </span>
    <span class="btn-text">
        {{ $content }}
    </span>
</button>

<style>
    /* Estilos básicos del botón */
    .btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: light-dark(#333, #efefec);
        text-decoration: none;
        padding: 0.7rem 1.2rem;
        border-radius: 5px;
        transition: all 0.3s ease;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn:hover {
        background-color: #4e4e4e54;
        color: white;
    }

    /* Tamaños del botón */
    .btn-small {
        padding: 0.8rem;
        font-size: 1rem;
    }

    .btn-medium {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }

    .btn-large {
        padding: 1rem 2rem;
        font-size: 1.25rem;
    }

    /* Estilos para el ícono */
    .btn-icon {
        display: flex;
        align-items: center;
        margin-right: 0.5rem;
        /* Espaciado entre ícono y texto */
    }

    .btn-icon svg {
        width: 1em;
        height: 1em;
        vertical-align: middle;
    }

    /* Estilos para el texto del botón */
    .btn-text {
        display: inline;
    }
</style>
