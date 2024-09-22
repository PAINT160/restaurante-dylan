@props(['name', 'show' => false, 'maxWidth' => '2xl', 'position' => 'center'])

@php
    $maxWidth = [
        'sm' => '300px',
        'md' => '500px',
        'lg' => '800px',
        'xl' => '1000px',
        '2xl' => '1200px',
    ][$maxWidth];

    $positionClass = [
        'top' => 'align-items-start',
        'bottom' => 'align-items-end',
        'center' => 'align-items-center',
    ][$position];
@endphp

<div x-data="{
    show: @js($show),
    focusables() {
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)].filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
}" x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden', 'modal-open');
        {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
    } else {
        document.body.classList.remove('overflow-y-hidden', 'modal-open');
    }
})"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null" x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false" x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="show" class="modal-container" style="display: none;">

    <div x-show="show" x-transition:enter="fade-enter" x-transition:enter-start="fade-enter-start"
        x-transition:enter-end="fade-enter-end" x-transition:leave="fade-leave"
        x-transition:leave-start="fade-leave-start" x-transition:leave-end="fade-leave-end" class="modal-overlay"
        @click="show = false" aria-hidden="true"></div>

    <div x-show="show" x-transition:enter="modal-enter" x-transition:enter-start="modal-enter-start"
        x-transition:enter-end="modal-enter-end" x-transition:leave="modal-leave"
        x-transition:leave-start="modal-leave-start" x-transition:leave-end="modal-leave-end"
        class="modal-content-wrapper {{ $positionClass }}">
        <div @click.outside="show = false" class="modal-content" style="max-width: {{ $maxWidth }};">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-headline">
                    {{ $header ?? '' }}
                </h3>
                <button @click="show = false" class="modal-close" aria-label="Cerrar modal">&times;</button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</div>

<style>
    .modal-container {
        position: fixed;
        inset: 0;
        z-index: 9999;
        overflow-y: auto;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.822);
        z-index: 9999;
        backdrop-filter: blur(5px);
    }

    .modal-content-wrapper {
        position: fixed;
        inset: 0;
        display: flex;
        justify-content: center;
        z-index: 10000;
        padding: 1rem;
    }

    /* Agregar estilos para las posiciones top, bottom y center */
    .modal-content-wrapper.align-items-start {
        align-items: flex-start;
    }

    .modal-content-wrapper.align-items-end {
        align-items: flex-end;
    }

    .modal-content-wrapper.align-items-center {
        align-items: center;
    }

    .modal-content {
        background-color: light-dark(#efedea, #0e0d0d);
        color: light-dark(#333b3c, #efefec);
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin: 0 auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid light-dark(#e2e8f0, #2d3748);
    }

    .modal-title {
        font-size: 1.2rem;
        font-weight: 600;
        line-height: 1.5;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: light-dark(#9ca3af, #a0aec0);
        transition: color 0.2s ease;
    }

    .modal-close:hover {
        color: light-dark(#6b7280, #e2e8f0);
    }

    .modal-body {
        padding: 0.8rem;
    }

    .modal-footer {
        background-color: light-dark(#f7fafc, #1a202c);
        padding: 0.5rem;
        gap: 0.5rem;
        border-top: 1px solid light-dark(#e2e8f0, #2d3748);
    }

    .fade-enter {
        transition: opacity 0.3s ease-out;
    }

    .fade-enter-start {
        opacity: 0;
    }

    .fade-enter-end {
        opacity: 1;
    }

    .fade-leave {
        transition: opacity 0.2s ease-in;
    }

    .fade-leave-start {
        opacity: 1;
    }

    .fade-leave-end {
        opacity: 0;
    }

    .modal-enter {
        transition: all 0.3s ease-out;
    }

    .modal-enter-start {
        opacity: 0;
        transform: scale(0.95);
    }

    .modal-enter-end {
        opacity: 1;
        transform: scale(1);
    }

    .modal-leave {
        transition: all 0.2s ease-in;
    }

    .modal-leave-start {
        opacity: 1;
        transform: scale(1);
    }

    .modal-leave-end {
        opacity: 0;
        transform: scale(0.95);
    }

    .overflow-y-hidden {
        overflow-y: hidden;
    }
</style>
