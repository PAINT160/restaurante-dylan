@props([
    'href' => '/',
])

<div class="auth-logo">
    @if (isset($logo))
        <span class="auth-logo__img">
            {{ $logo }}
        </span>
    @endif
    <span class="auth-logo__text">
        {{ $slot }}
    </span>
</div>

<style>
    .auth-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        border-radius: 8px;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .auth-logo__img {
        max-height: 2rem;
        max-width: 100%;
        height: auto;
        width: auto;
        margin-right: 0.75rem; /* Espacio aumentado */
        border: none;
        transition: transform 0.3s ease;
    }

    .auth-logo__text {
        font-size: 1.5rem;
        font-weight: bold;
        background: linear-gradient(135deg, #6a11cb, #2575fc); /* Degradado de púrpura a azul */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent; /* Relleno transparente para el degradado */
        font-family: 'Arial', sans-serif; /* Cambia a la fuente deseada */
    }

    .auth-logo:hover .auth-logo__img {
        transform: scale(1.1); /* Efecto de escala al pasar el mouse */
    }
</style>
