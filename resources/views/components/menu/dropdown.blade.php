@props([
    'contentClasses' => '',
    'perfil' => '',
    'content' => '',
    'align' => 'right',
    'trigger' => '',
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'dropdown-left',
        'right' => 'dropdown-right',
        'top' => 'dropdown-top',
        'none', 'false' => '',
        default => 'dropdown-right',
    };
@endphp

<div data-component="mi-dropdown">
    <div class="dropdown {{ $alignmentClasses }}" x-data="{ open: false }" @click.away="open = false">
        <button.circle-button size="36" @click="open = !open">
            {{-- Aquí ya no se incluye la imagen --}}
            {{ $trigger }}
        </button.circle-button>

        <div x-show="open" class="dropdown-menu {{ $contentClasses }}" :class="{ 'show': open }"
            x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95">
            {{ $content }}
        </div>
    </div>
</div>

<style>
    [data-component="mi-dropdown"] {
        .dropdown {
            position: relative;
            display: inline-block;
        }
        /* La clase .profile-img ha sido eliminada */

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background-color: light-dark(#0b80f5, #383838);
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            width: max-content;
            min-width: min-content;
            /* padding: 0.5rem; */
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .dropdown-right .dropdown-menu {
            left: auto;
            right: -10px;
            transform: translateX(0) translateY(10px);
        }

        .dropdown-right .dropdown-menu.show {
            transform: translateX(0) translateY(0);
        }

        .dropdown-left .dropdown-menu {
            left: 0;
            right: auto;
            transform: translateX(0) translateY(10px);
        }

        .dropdown-left .dropdown-menu.show {
            transform: translateX(0) translateY(0);
        }

        .dropdown-top .dropdown-menu {
            top: auto;
            bottom: 100%;
            transform: translateX(-50%) translateY(-10px);
        }

        .dropdown-top .dropdown-menu.show {
            transform: translateX(-50%) translateY(0);
        }

        .dropdown-item {
            display: block;
            color: light-dark(#333, #efefec);
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            white-space: nowrap;
        }

        .dropdown-item:hover {
            background-color: light-dark(#92afcc, #080808);
        }
    }
</style>
