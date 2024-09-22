<div x-data="searchComponent()" class="search-component">
    <button @click="openSearch" class="search-icon" aria-label="Abrir búsqueda">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </button>

    <div x-show="isOpen" @click.self="closeSearch" class="search-overlay"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="search-modal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 transform scale-95 translate-y-4">
            <button @click="closeSearch" class="close-button" aria-label="Cerrar búsqueda">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            </button>
            <form @submit.prevent="performSearch" class="search-form">
                <input type="text" x-model="query" x-ref="searchInput" id="search-input" class="search-input"
                    name="query" placeholder="Buscar..." autocomplete="off" @input="performSearch">
                <button type="submit" class="search-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span class="sr-only">Buscar</span>
                </button>
            </form>
            <div class="search-results">
                <template x-for="result in results" :key="result.id">
                    <div class="result-item">
                        <h3 x-text="result.title"></h3>
                        <p x-text="result.description"></p>
                    </div>
                </template>
                <div x-show="results.length === 0 && query !== ''" class="no-results">
                    No se encontraron resultados para "<span x-text="query"></span>"
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function searchComponent() {
        return {
            isOpen: false,
            query: '',
            results: [],
            items: @json($items), // Pasamos los items desde PHP a JavaScript

            openSearch() {
                this.isOpen = true;
                this.$nextTick(() => {
                    this.$refs.searchInput.focus();
                });
            },
            closeSearch() {
                this.isOpen = false;
                this.query = '';
                this.results = [];
            },
            performSearch() {
                if (this.query.trim() === '') {
                    this.results = [];
                    return;
                }

                // Filtramos los items que coincidan con la consulta
                this.results = this.items.filter(item => {
                    return item.title.toLowerCase().includes(this.query.toLowerCase());
                });
            }
        }
    }
</script>





<style>
    .search-component {
        font-family: 'Poppins', 'Inter', sans-serif;
        position: relative;
    }

    .search-icon {
        background: linear-gradient(45deg, #6366F1, #8B5CF6);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
    }

    .search-icon:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .search-icon svg {
        color: white;
    }

    .search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(17, 24, 39, 0.8);
        backdrop-filter: blur(5px);
        display: flex;
        justify-content: center;
        z-index: 1000;
    }

    .search-modal {
        top: 10px;
        width: 90%;
        max-width: 500px;
        height: fit-content;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .close-button {
        position: absolute;
        top: 2px;
        right: 2px;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;

    }

    .close-button:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);

    }

    .close-button svg {
        width: 20px;
        height: 20px;
    }

    .search-form {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        overflow: hidden;
        margin-bottom: 20px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-form:focus-within {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
    }

    .search-input {
        width: 100%;
        padding: 12px 15px;
        border: none;
        background: transparent;
        font-size: 16px;
        color: white;
        transition: all 0.3s ease;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-input:focus {
        outline: none;
    }

    .search-button {
        background: linear-gradient(45deg, #6366F1, #8B5CF6);
        border: none;
        padding: 12px;
        cursor: pointer;
        color: white;
        transition: all 0.3s ease;
    }

    .search-button:hover {
        transform: scale(1.05);
    }

    .search-results {
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        color: white;
    }

    .result-item {
        padding: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        font-size: 14px;
        cursor: pointer;
    }



    .result-item:last-child {
        border-bottom: none;
    }

    .no-results {
        padding: 12px;
        color: rgba(255, 255, 255, 0.7);
        font-style: italic;
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

    @media (max-width: 600px) {
        .search-modal {
            width: 90%;
            padding: 20px;
        }

        .search-input {
            font-size: 14px;
        }
    }

    .search-results::-webkit-scrollbar {
        width: 4px;
    }

    .search-results::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 2px;
    }

    .search-results::-webkit-scrollbar-track {
        background-color: rgba(0, 0, 0, 0.1);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
        }
    }

    .search-icon {
        animation: pulse 2s infinite;
    }
</style>
