@props(['text' => ''])

<div class="auth-container">
    <h2 class="auth-title">
        {{ $text }}
    </h2>
    <div class="auth-options">
        <x-link.auth-link perfil="https://www.google.com/favicon.ico" width="24" href="{{ route('google.redirect') }}" />
        <x-link.auth-link perfil="https://www.microsoft.com/favicon.ico" width="24" href="#" />
        <x-link.auth-link perfil="https://slack.com/favicon.ico" width="24" href="{{ route('facebook.redirect') }}"/>
        <x-link.auth-link perfil="https://github.com/favicon.ico" width="24" href="{{ route('github.redirect') }}" />
    </div>
</div>

<style>
    .auth-container {
        text-align: center;
        margin: 10px;
    }

    .auth-title {
        color: light-dark(#000000, #efefec);
        font-size: 13px;
    }

    .auth-options {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        padding-top: 20px;
    }
</style>
