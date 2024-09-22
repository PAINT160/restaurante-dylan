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
            <div class="modal-body">
                <button @click="show = false" class="modal-close-button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
                {{ $slot }}
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

    .modal-body {
        padding: 1.5rem;
        position: relative;
    }

    .modal-close-button {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        font-size: 1.5rem;
        background: none;
        border: none;
        cursor: pointer;
        color: light-dark(#333b3c, #efefec);
        opacity: 0.7;
        transition: opacity 0.2s ease-in-out;
    }

    .modal-close-button:hover {
        opacity: 1;
    }

    .fade-enter { transition: opacity 0.3s ease-out; }
    .fade-enter-start { opacity: 0; }
    .fade-enter-end { opacity: 1; }
    .fade-leave { transition: opacity 0.2s ease-in; }
    .fade-leave-start { opacity: 1; }
    .fade-leave-end { opacity: 0; }

    .modal-enter { transition: all 0.3s ease-out; }
    .modal-enter-start { opacity: 0; transform: scale(0.95); }
    .modal-enter-end { opacity: 1; transform: scale(1); }
    .modal-leave { transition: all 0.2s ease-in; }
    .modal-leave-start { opacity: 1; transform: scale(1); }
    .modal-leave-end { opacity: 0; transform: scale(0.95); }

    .overflow-y-hidden { overflow-y: hidden; }
</style>