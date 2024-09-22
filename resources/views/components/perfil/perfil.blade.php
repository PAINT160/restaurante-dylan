    <x-menu.dropdown align="right">
        <x-slot name="trigger">
            <x-user-profile />

        </x-slot>
        <x-slot name="content">
            <x-list.list>
                <x-list.li>
                    <x-link.link color="green" href="/some-page">Inicio</x-link.link>

                </x-list.li>
                <x-list.li>
                    <x-link.link color="blue" href="/some-page">Inicio</x-link.link>
                </x-list.li>
                <x-list.li>
                    <x-logout />
                </x-list.li>
            </x-list.list>
        </x-slot>
    </x-menu.dropdown>
