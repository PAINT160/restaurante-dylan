<!-- resources/views/components/li.blade.php -->
<div data-component="mi-li">

    <li class="simple-list-item">
        {{ $slot }}
    </li>
</div>

<style>
    [data-component="mi-li"] {

        .simple-list-item {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            text-align: center;
        }

        .simple-list-item:last-child {
            border-bottom: none;
        }
    }
</style>
