@if (session('error'))
    <div id="message" class="message error">
        {{ session('error') }}
    </div>
@elseif(session('success'))
    <div id="message" class="message success">
        {{ session('success') }}
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const message = document.getElementById('message');
        if (message) {
            setTimeout(() => {
                message.classList.add('hidden');
            }, 3000);
        }
    });
</script>

<style>
    .hidden {
        display: none;
    }

    .message {
        position: fixed;
        top: 16px;
        right: 16px;
        margin: 16px;
        padding: 8px;
        border-radius: 8px;
        color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: opacity 0.3s ease-in-out;
        z-index: 9999;
        /* Ensure the message appears above other content */
    }

    .message.error {
        background-color: #c53030;
        /* Red for errors */
    }

    .message.success {
        background-color: #2f855a;
        /* Green for success */
    }
</style>
