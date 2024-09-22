<div class="session-content">
    <div class="session-card">
        <div class="session-info">
            {{ __('Si es necesario, puedes cerrar la sesión en todos tus otros navegadores y dispositivos. Algunas de tus sesiones recientes están listadas abajo; sin embargo, esta lista puede no ser exhaustiva. Si crees que tu cuenta ha sido comprometida, también deberías actualizar tu contraseña.') }}
        </div>

        @if (count($sessions) > 0)
            <div class="session-list">
                @foreach ($sessions as $session)
                    <div class="session-item">
                        <div class="session-icon">
                            @if ($session->agent['is_desktop'])
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="session-device-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                                {{-- <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-android"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10l0 6" /><path d="M20 10l0 6" /><path d="M7 9h10v8a1 1 0 0 1 -1 1h-8a1 1 0 0 1 -1 -1v-8a5 5 0 0 1 10 0" /><path d="M8 3l1 2" /><path d="M16 3l-1 2" /><path d="M9 18l0 3" /><path d="M15 18l0 3" /></svg> --}}
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="session-device-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="session-details">
                            <div class="session-platform">
                                {{ $session->agent['platform'] ? $session->agent['platform'] : __('Desconocido') }}
                                -
                                {{ $session->agent['browser'] ? $session->agent['browser'] : __('Desconocido') }}
                            </div>

                            <div class="session-ip">
                                {{ $session->ip_address }},
                                @if ($session->is_current_device)
                                    <span class="current-device">{{ __('Este dispositivo') }}</span>
                                @else
                                    {{ __('Última actividad') }} {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="session-logout">
            <!-- Button to open the modal -->
            <x-button x-data="" x-on:click="$dispatch('open-modal', 'deleteSesion')" color="fuchsia">
                {{ __('Eliminar sesiones') }}
            </x-button>
        </div>

        @include('components.message-alert')

    </div>
</div>
{{-- <x-modal name="deleteSesion" :show="$errors->errorsSesion->isNotEmpty() || session('openModal') === 'deleteSesion'" focusable maxWidth="md"> --}}
<x-modal name="deleteSesion" :show="$errors->errorsSesion->isNotEmpty()" focusable maxWidth="md" position="top">

    <x-slot name="header">
        <h2 class="text-2xl font-semibold">
            {{ __('Eliminar sesiones') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('logout.other.devices') }}" id="logout-form">
        @csrf
        <div>
            <p style="margin-bottom: 10px;">
                {{ __('¿Estás seguro de que quieres cerrar sesión en todos tus otros dispositivos?') }}
            </p>
            <x-text-input type="password" name="password" placeholder="Contraseña"/>
            <x-input-error :messages="$errors->errorsSesion->get('password')" />
        </div>


        <x-slot name="footer">
            <div class="p-2 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-button class="ml-3" x-on:click.prevent="document.getElementById('logout-form').submit();">
                    {{ __('Confirmar eliminación') }}
                </x-button>
            </div>
        </x-slot>
    </form>
</x-modal>


<style>
    .session-content {
        max-width: 1120px;
        width: 100%;
    }

    .session-card {
        background-color: light-dark(#efedea, #424242);
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }

    .session-info {
        font-size: 0.875rem;
        color: light-dark(#000000, #efefec);
        margin-bottom: 1.5rem;
    }

    .session-list {
        margin-top: 1.25rem;
    }

    .session-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .session-icon {
        margin-right: 0.75rem;
    }

    .session-device-icon {
        width: 32px;
        height: 32px;
        color: light-dark(#000000, #efefec);
    }

    .session-details {
        flex: 1;
    }

    .session-platform {
        font-size: 0.875rem;
        color: light-dark(#000000, #efefec);
        margin-bottom: 0.25rem;
    }

    .session-ip {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .current-device {
        color: #10B981;
        font-weight: bold;
    }

    .session-logout {
        display: flex;
        align-items: center;
        margin-top: 1.25rem;
    }

    .logout-form-group {
        flex: 1;
    }

    .logout-input {
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        width: calc(100% - 1.5rem);
        margin-right: 1rem;
    }

    .logout-button {
        background-color: #2563EB;
        color: #ffffff;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .logout-button:hover {
        background-color: #1E40AF;
    }

    .session-status {
        margin-top: 0.75rem;
        font-weight: 500;
        font-size: 0.875rem;
        color: #10B981;
    }
</style>
