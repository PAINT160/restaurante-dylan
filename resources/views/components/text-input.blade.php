@props([
    'disabled' => false,
    'label' => '',
    'autocomplete' => '',
    'placeholder' => '',
    'type' => 'text',
    'value' => '',
])
<div class="input-container" x-data="{ focused: false, filled: false }" x-init="filled = $refs.input.value.length > 0">
    <div class="input-wrapper">
        <input x-ref="input" type="{{ $type }}" {{ $disabled ? 'disabled' : '' }}
            {{ $autocomplete ? "autocomplete=$autocomplete" : '' }} x-on:focus="focused = true"
            x-on:blur="focused = false" x-on:input="filled = $refs.input.value.length > 0"
            :placeholder="focused ? '{{ $placeholder }}' : ''" value="{{ $value }}" {!! $attributes->merge([
                'class' => 'input-field' . ($disabled ? ' disabled' : ''),
            ]) !!}>
        <label for="{{ $attributes->get('id') }}" class="input-label" :class="{ 'label-float': focused || filled }">
            {{ $label }}
        </label>
    </div>
</div>
<style>
    .input-container {
        position: relative;
        margin-bottom: 1.5rem;
        width: 100%;
    }

    .input-wrapper {
        position: relative;
        width: 100%;
    }

    .input-field {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #4a5568;
        border-radius: 1rem;
        background-color: light-dark(#d6d4d0, #1e2227);
        color: #fff;
        font-size: 1rem;
        line-height: 1.5;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        box-sizing: border-box;
    }

    .input-field:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    }

    .input-field::placeholder {
        color: light-dark(#000000, #efefec);
        opacity: 1;
    }

    .input-label {
        position: absolute;
        left: 1rem;
        top: 0.75rem;
        color: light-dark(#000000, #efefec);
        transition: all 0.2s ease-out;
        pointer-events: none;
        line-height: 1.5;
        background-color: transparent;
    }

    .label-float {
        top: -0.75rem;
        left: 0.75rem;
        font-size: 0.75rem;
        padding: 0 0.25rem;
        background-color: light-dark(#dfddda, #000000);
        color: #4299e1;
        border-radius: 6px;
    }
</style>
