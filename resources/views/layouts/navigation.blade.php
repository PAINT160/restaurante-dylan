<header x-data="{
    isOpen: false,
    activeLink: window.location.pathname,
    setActiveLink(link) {
        this.activeLink = link;
        this.isOpen = false;
    }
}" @keydown.escape.window="isOpen = false" @click.away="isOpen = false">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <x-link.logo-link href="/" ariaLabel="Home" activeLink="/">
                <x-slot name="logo">
                    <x-img.img width="36"
                        perfil="https://static.vecteezy.com/system/resources/previews/003/738/464/non_2x/blue-galaxy-background-free-vector.jpg" />
                </x-slot>
            </x-link.logo-link>

            <div style="display: flex; align-items: center;">
                <div style="padding-right: 20px;">
                    <x-global-search />
                </div>
                <div style="padding-right: 20px;">
                    <x-theme />
                </div>
            </div>
        </div>
        <button @click="isOpen = !isOpen" class="navbar-toggle" :class="{ 'active': isOpen }" :aria-expanded="isOpen"
            aria-controls="navbar-links" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-menu" viewBox="0 0 24 24">
                <path d="M4 6h16" />
                <path d="M4 12h16" />
                <path d="M4 18h16" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-close" viewBox="0 0 24 24">
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>

        <div id="navbar-links" class="navbar-links" :class="{ 'active': isOpen }">
            <button @click="isOpen = false" class="close-menu-btn" aria-label="Close menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <a href="/" class="nav-link" :class="{ 'active': activeLink === '/' }"
                @click="setActiveLink('/')"><span>Inicio</span></a>
            <a href="/dashboard" class="nav-link" :class="{ 'active': activeLink === '/dashboard' }"
                @click="setActiveLink('/dashboard')">
                <span>Dashboard</span>
            </a>
            <a href="/users" class="nav-link" :class="{ 'active': activeLink === '/users' }"
                @click="setActiveLink('/users')"><span>Usuario</span>
            </a>
            <div class="auth-button-container">
                @auth

                    <div class="contenido-login">
                        <x-perfil.perfil />
                    </div>
                @endauth
                @guest

                    <div class="contenido-login">
                        @include('user.auth.login')
                    </div>
                    <div class="contenido-register">
                        @include('user.auth.register')
                    </div>
                @endguest

            </div>
        </div>
    </nav>
</header>

<style>
    .navbar {
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: light-dark(#b0c8e2, #121212);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .navbar-toggle {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .navbar-toggle svg {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: opacity 0.3s ease;
    }

    .navbar-toggle .icon-menu {
        opacity: 1;
    }

    .navbar-toggle .icon-close {
        opacity: 0;
        position: absolute;
    }

    .navbar-toggle.active .icon-menu {
        opacity: 0;
    }

    .navbar-toggle.active .icon-close {
        opacity: 1;
    }

    .navbar-links {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .nav-link {
        color: light-dark(#333, #efefec);
        text-decoration: none;
        padding: 0.7rem 1.2rem;
        border-radius: 5px;
        transition: all 0.3s ease;
        position: relative;
        font-size: 1rem;
    }

    .nav-link:hover,
    .nav-link.active {
        background-color: light-dark(#92afcc, #1e1e1e);
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: light-dark(#3498db, #4eac6d);
    }

    .close-menu-btn {
        display: none;
        /* Hide by default */
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
    }

    .close-menu-btn svg {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    @media (max-width: 768px) {
        .navbar {
            padding: 1rem;
        }

        .navbar-toggle {
            display: flex;
        }

        .navbar-links {
            position: fixed;
            right: -100%;
            top: 0;
            flex-direction: column;
            background-color: light-dark(#b0c8e2, #121212);
            width: 50%;
            height: 100vh;
            padding-top: 4rem;
            text-align: left;
            transition: all 0.3s ease;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-links.active {
            right: 0;
        }

        .nav-link {
            padding: 1rem 2rem;
            font-size: 1.2rem;
            border-bottom: 1px solid light-dark(rgba(0, 0, 0, 0.1), rgba(255, 255, 255, 0.1));
        }

        .nav-link:last-child {
            border-bottom: none;
        }

        .close-menu-btn {
            display: block;
            /* Show only on small screens */
        }

        .auth-button-container {
            flex-direction: column;
            /* Cambia la dirección a columna en pantallas pequeñas */
            width: 100%;
            /* Asegura que ocupe todo el ancho */
        }

        .contenido-login,
        .contenido-register {
            width: 100%;
            /* Cada contenedor ocupa todo el ancho disponible */
            padding-right: 0;
            /* Elimina el espacio a la derecha */
            margin-bottom: 10px;
            /* Espacio inferior entre los contenedores */
            display: flex;
            /* Utiliza Flexbox para centrar el contenido */
            justify-content: center;
            /* Centra el contenido dentro del contenedor */
        }

    }


    .auth-button-container {
        display: flex;
        align-items: center;
        justify-content: center;
        /* Centra horizontalmente en pantallas grandes */
    }

    .contenido-login,
    .contenido-register {
        padding-right: 20px;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
</style>
