<style>
    .theme-switcher {
        width: 24px;
        height: 24px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden;
        outline: none;
        border: none;
        background-color: transparent;
        cursor: pointer;
    }

    .theme-switcher:focus {
        outline: none;
    }

    .theme-switcher .icon {
        width: 24px;
        height: 24px;
        color: light-dark(#000000, #ffffff);
    }

    [data-theme="light"] {
        color-scheme: light;
    }

    [data-theme="dark"] {
        color-scheme: dark;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
</style>
<button x-data="themeSwitcher()" @click="cycleTheme()" class="theme-switcher" :aria-label="getAriaLabel()"
    :title="getThemeLabel(currentTheme)">
    <svg x-show="currentTheme === 'light'" xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
    <svg x-show="currentTheme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
    </svg>
    <svg x-show="currentTheme === 'system'"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brightness-half"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9a3 3 0 0 0 0 6v-6z" /><path d="M6 6h3.5l2.5 -2.5l2.5 2.5h3.5v3.5l2.5 2.5l-2.5 2.5v3.5h-3.5l-2.5 2.5l-2.5 -2.5h-3.5v-3.5l-2.5 -2.5l2.5 -2.5z" /></svg>


    <span x-show="currentTheme === 'light'" class="sr-only">Tema claro</span>
    <span x-show="currentTheme === 'dark'" class="sr-only">Tema oscuro</span>
    <span x-show="currentTheme === 'system'" class="sr-only">Tema del sistema</span>
</button>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('themeSwitcher', () => ({
            themes: ['light', 'dark', 'system'],
            currentTheme: localStorage.getItem('theme') || 'system',

            init() {
                this.applyTheme(this.currentTheme);
            },

            applyTheme(theme) {
                if (theme === 'system') {
                    this.applySystemTheme();
                } else {
                    document.documentElement.setAttribute('data-theme', theme);
                }
            },

            applySystemTheme() {
                const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
                const theme = prefersDarkScheme.matches ? 'dark' : 'light';
                document.documentElement.setAttribute('data-theme', theme);

                prefersDarkScheme.addEventListener('change', (event) => {
                    if (this.currentTheme === 'system') {
                        this.applySystemTheme();
                    }
                });
            },

            cycleTheme() {
                const currentIndex = this.themes.indexOf(this.currentTheme);
                const nextIndex = (currentIndex + 1) % this.themes.length;
                this.currentTheme = this.themes[nextIndex];
                this.applyTheme(this.currentTheme);
                localStorage.setItem('theme', this.currentTheme);
            },

            getThemeLabel(theme) {
                const labels = {
                    'light': 'Tema claro',
                    'dark': 'Tema oscuro',
                    'system': 'Tema del sistema'
                };
                return labels[theme] || 'Tema desconocido';
            },

            getAriaLabel() {
                return `Cambiar tema (actual: ${this.getThemeLabel(this.currentTheme)})`;
            }
        }));
    });
</script>
