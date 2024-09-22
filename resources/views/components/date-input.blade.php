@props([
    'label' => 'Date of Birth',
    'error' => false,
])

<div class="date-input-group" x-data="{ focused: false, filled: false }">
    <div class="date-input-wrapper">
        <input type="date" x-on:focus="focused = true" x-on:blur="focused = false; filled = $el.value.length > 0"
            x-on:input="filled = $el.value.length > 0" placeholder="dd/mm/aaaa" {!! $attributes->merge([
                'class' => 'date-input' . ($error ? ' date-input-error' : ''),
            ]) !!}>
        <label for="{{ $attributes->get('id') }}" class="date-input-label">
            {{ $label }}
        </label>
    </div>
    @if ($error)
        <p class="date-error-message">{{ $error }}</p>
    @endif
</div>

<style>
    .date-input-group {
        position: relative;
        margin-bottom: 1.5rem;
        width: 100%;
    }

    .date-input-wrapper {
        position: relative;
        width: 100%;
    }

    .date-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #3a3f47;
        border-radius: 0.25rem;
        background-color: light-dark(#d6d4d0, #1e2227);
        color: #fff;
        font-size: 1rem;
        line-height: 1.5;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        box-sizing: border-box;
    }

    .date-input:focus {
        outline: none;
        border-color: #3794ff;
        box-shadow: 0 0 0 3px rgba(55, 148, 255, 0.5);
    }

    .date-input::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }

    .date-input-label {
        position: absolute;
        left: 0.75rem;
        top: -0.75rem;
        font-size: 0.75rem;
        padding: 0 0.25rem;
        background-color: light-dark(#d6d4d0, #1e2227);
        color: #3794ff;
        transition: all 0.2s ease-out;
        pointer-events: none;
        line-height: 1.5;
    }

    .date-error-message {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #f56565;
    }

    .date-input-error {
        border-color: #f56565;
    }

    .date-input-error:focus {
        box-shadow: 0 0 0 3px rgba(245, 101, 101, 0.5);
    }
</style>
