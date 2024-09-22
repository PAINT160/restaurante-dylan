<x-modal-auth name="loginUser" :show="$errors->userLoginErrors->isNotEmpty() || session('openModal') === 'login-modal'" focusable maxWidth="md">

    <x-img.logo-auth class="logo-auth">
        <x-slot name="logo">
            <x-img.img width="36"
                perfil="https://static.vecteezy.com/system/resources/previews/003/738/464/non_2x/blue-galaxy-background-free-vector.jpg"
                shape="square" />
        </x-slot>
        Dylan
    </x-img.logo-auth>
    <form method="POST" action="{{ route('login') }}" id="login-form"
        x-on:keydown.enter.prevent="document.getElementById('login-form').submit();">
        @csrf
        <div>
            <x-text-input label="Correo electrónico" id="email_login" name="email" type="email" :value="old('email')"
                placeholder="Ingrese su correo electrónico" />
            <x-input-error :messages="$errors->userLoginErrors->get('email')" />

            <x-text-input label="Contraseña" id="password_login" name="password" type="password"
                placeholder="Ingrese su contraseña" />
            <x-input-error :messages="$errors->userLoginErrors->get('password')" />
        </div>
        <x-button class="ml-3" x-on:click.prevent="document.getElementById('login-form').submit();"
            backgroundColor="blue" textColor="white" fullWidth="true">
            {{ __('Iniciar sesión') }}
        </x-button>

    </form>
    <x-split />
    <p>
        ¿No tienes cuenta? <a href="#"
            x-on:click="$dispatch('close'); $dispatch('open-modal', 'registerUser')">Crear
            cuenta</a>
    </p>
    <x-link.auth text="O iniciar  sesión con"/>

</x-modal-auth>

<x-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'loginUser')" color="fuchsia">
    {{ __('Login') }}
</x-button>
