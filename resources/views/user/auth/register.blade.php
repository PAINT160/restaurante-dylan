<x-modal-auth name="registerUser" :show="$errors->userRegisterErrors->isNotEmpty() || session('openModal') === 'register-modal'" focusable maxWidth="md">

    <x-img.logo-auth class="logo-auth">
        <x-slot name="logo">
            <x-img.img width="36"
                perfil="https://static.vecteezy.com/system/resources/previews/003/738/464/non_2x/blue-galaxy-background-free-vector.jpg"
                shape="square" />
        </x-slot>
        Dylan
    </x-img.logo-auth>

    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf
        <div class="p-6">
            <div id="step1">
                <x-text-input label="Email" id="email" name="email" type="email" :value="old('email')"
                    placeholder="Enter your email" />
                <x-input-error :messages="$errors->userRegisterErrors->get('email')" />

                <x-text-input label="Password" id="password" name="password" type="password"
                    placeholder="Enter your password" />
                <x-input-error :messages="$errors->userRegisterErrors->get('password')" />

                <x-text-input label="Confirmar contraseña" id="password_confirmation" name="password_confirmation"
                    type="password" placeholder="Confirme su contraseña" />
                <x-input-error :messages="$errors->userRegisterErrors->get('password_confirmation')" />

                <x-button type="button" onclick="showStep2()" fullWidth="true" backgroundColor="indigo" textColor="white">
                    {{ __('Siguiente') }} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M13 18l6 -6" />
                        <path d="M13 6l6 6" />
                    </svg>
                </x-button>

                <x-split />
                <x-link.auth text="O registrarse con"/>
            </div>

            <div id="step2" style="display: none;">
                <x-text-input label="First Name" id="firstname" name="firstname" type="text" :value="old('firstname')"
                    placeholder="Enter your first name" />
                <x-input-error :messages="$errors->userRegisterErrors->get('firstname')" />

                <x-text-input label="Last Name" id="lastname" name="lastname" type="text" :value="old('lastname')"
                    placeholder="Enter your last name" />
                <x-input-error :messages="$errors->userRegisterErrors->get('lastname')" />
                <x-date-input label="Date of Birth" id="dob" name="dob" type="date" :value="old('dob')"
                    placeholder="Enter your date of birth" />
                <x-input-error :messages="$errors->userRegisterErrors->get('dob')" />

                <x-button type="button" onclick="showStep1()" fullWidth="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M5 12l6 6" />
                        <path d="M5 12l6 -6" />
                    </svg>
                    Atras
                </x-button>

                <x-button type="submit" fullWidth="true">
                    {{ __('Register') }}
                </x-button>
            </div>
        </div>
    </form>
</x-modal-auth>

<script>
    function showStep2() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
    }

    function showStep1() {
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step2').style.display = 'none';
    }
</script>

<x-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'registerUser')" color="fuchsia">
    {{ __('Register') }}
</x-button>
