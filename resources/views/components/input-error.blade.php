@props(['messages'])

@if ($messages)
    <ul class="alert-message">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
    <script>
        setTimeout(function() {
            var messageElements = document.querySelectorAll('.alert-message');
            if (messageElements) {
                messageElements.forEach(function(element) {
                    element.classList.add('fade-out');
                    setTimeout(function() {
                        element.style.display = 'none';
                    }, 500);
                });
            }
        }, 3000);
    </script>
@endif

<style>
.alert-message {
    font-size: 0.75rem; /* text-xs */
    color: #dc2626; /* text-red-600 */
    list-style-type: none; /* Elimina los puntos de la lista */
    transition: opacity 0.5s ease; /* Transición suave para desvanecimiento */
    margin-top: -0.5rem; /* Ajusta el margen superior negativo para mover el contenedor hacia arriba */
}

/* Si deseas ajustar el espaciado entre los elementos de la lista, puedes añadir: */
.alert-message li {
    margin-bottom: 0.25rem; /* Espacio entre los elementos de la lista */
}

/* Estilo para desvanecer el contenedor */
.alert-message.fade-out {
    opacity: 0; /* Hace el contenedor transparente */
}

</style>
