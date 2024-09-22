<!-- resources/views/components/auth-link.blade.php -->
@props([
    'perfil' => '',
    'width' => '36',
    'href' => '/',
])

@php
    $sizes = [
        '24' => '24px',
        '36' => '36px',
        '48' => '48px',
        '60' => '60px',
        '72' => '72px',
        '96' => '96px',
    ];
    $size = $sizes[$width] ?? '36px';
    $totalSize = (int)$size + 5; // Ajustar para padding (8px a cada lado)
@endphp

<div class="profile-container">
    <a href="{{ $href }}" class="profile-link" style="width: {{ $totalSize }}px; height: {{ $totalSize }}px;">
        <img src="{{ $perfil }}" alt="Perfil" class="profile-img" style="width: {{ $size }}; height: {{ $size }};" />
    </a>
</div>

<style>
    .profile-container {
        display: flex;
        justify-content: center;
    }

    .profile-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        background-color: #f0f0f0;
        /* background-color: light-dark(#000000, #ffffff); */

        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(209, 7, 7, 0.08);
        overflow: hidden;
        padding: 8px;
    }

    .profile-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    }

    .profile-img {
        border-radius: 50%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-link:hover .profile-img {
        transform: scale(1.05);
    }
</style>