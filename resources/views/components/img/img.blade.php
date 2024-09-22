@props([
    'perfil' => '',
    'width' => '36',
    'shape' => 'circle', // Propiedad para controlar la forma
])

@php
    // Establecer el tamaño basado en el valor de $width
    $sizes = [
        '24' => '24px',
        '36' => '36px',
        '48' => '48px',
        '60' => '60px',
        '72' => '72px',
        '96' => '96px',
    ];

    $size = $sizes[$width] ?? '36px';
@endphp

<img src="{{ $perfil }}" alt="Perfil" class="profile-img {{ $shape }}"
    style="
        width: {{ $size }}; 
        height: {{ $size }}; 
    " />

<style>
    .profile-img {
        object-fit: cover;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        display: block;
        margin: 0 auto;
        cursor: pointer;
    }

    .profile-img.circle {
        border-radius: 50%; /* Círculo */
    }

    .profile-img.square {
        border-radius: 6px; /* Cuadrado con bordes redondeados */
    }
</style>
