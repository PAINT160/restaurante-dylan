@if ($avatarUrl)
    <img src="{{ $avatarUrl }}" width="36" alt="Foto de perfil" style="border-radius: 50%; cursor: pointer;">
@else
    <div style="width: 36px; height: 36px; background-color: rgba(255, 255, 255, 0.521); border-radius: 50%; border: 1px solid #ccc;">
        <span style="display: flex; justify-content: center; align-items: center; height: 100%; color: #e9e3e3d8;">No</span>
    </div>
@endif