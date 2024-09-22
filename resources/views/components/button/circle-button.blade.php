@props([
    'size' => '36', // Tamaño por defecto
])

@php
    // Establecer el tamaño basado en el valor de $size
    $sizes = [
        '24' => '24px',
        '36' => '36px',
        '48' => '48px',
        '60' => '60px',
        '72' => '72px',
        '96' => '96px',
    ];

    $buttonSize = $sizes[$size] ?? '36px';
@endphp

<button class="circular-btn" style="
        width: {{ $buttonSize }}; 
        height: {{ $buttonSize }};
    ">
    {{ $slot }}
</button>

<style>
    .circular-btn {
        border: none;
        border-radius: 50%;
        background-color: transparent;
        padding: 0;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

</style>
