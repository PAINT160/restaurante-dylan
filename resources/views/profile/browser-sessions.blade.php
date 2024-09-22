<!-- resources/views/profile/browser-sessions.blade.php -->
<x-app-layout>
    <div class="session-container">
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

                                    <div>
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
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="session-logout">
                    <form method="POST" action="{{ route('logout.other.devices') }}">
                        @csrf
                        <div>
                            <input type="password" name="password" placeholder="Password" class="logout-input" />
                        </div>
                        <button type="submit" class="logout-button">
                            {{ __('Log Out Other Browser Sessions') }}
                        </button>
                    </form>
                </div>

                @if (session('status'))
                    <div class="session-status">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .session-container {
        padding: 3rem 0;
    }

    .session-content {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .session-card {
        background-color: light-dark(#557db144, #1f1e1e);
        overflow: hidden;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        padding: 1.5rem;
    }

    .session-info {
        font-size: 0.875rem;
        color: light-dark(#000000, #efefec);
    }

    .session-list {
        margin-top: 1.25rem;
    }

    .session-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
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
        margin-left: 0.75rem;
    }

    .session-platform {
        font-size: 0.875rem;
        color: light-dark(#000000, #efefec);
    }

    .session-ip {
        font-size: 0.75rem;
        color: light-dark(#000000, #efefec);
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

    .logout-input {
        padding: 0.5rem;
        border: 1px solid #D1D5DB;
        border-radius: 0.375rem;
        margin-right: 0.75rem;
    }

    .logout-button {
        background-color: #2563EB;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
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
