<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <!-- Menu Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logótipo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="h-8 w-8 bg-indigo-600 rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-lightbulb text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-indigo-800">Plataforma</span>
                    </a>
                </div>

                <!-- Ligações de navegação -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('controlos')" :active="request()->routeIs('controlos')">
                        <i class="fas fa-sliders-h mr-2"></i>{{ __('Controlos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('relatorios')" :active="request()->routeIs('relatorios')">
                        <i class="fas fa-chart-line mr-2"></i>{{ __('Relatórios') }}
                    </x-nav-link>

                    @if(auth()->user()->admin == 1)
                        <x-nav-link :href="route('users_all')" :active="request()->routeIs('users_all')">
                            <i class="fas fa-user mr-2"></i>{{ __('Utilizadores') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        <i class="fas fa-info-circle mr-2"></i>{{ __('Sobre') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Dropdown de Utilizador -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-white hover:text-indigo-600 focus:outline-none transition ease-in-out duration-150">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center mr-2">
                                <i class="fas fa-user text-indigo-600"></i>
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fas fa-user-cog mr-2"></i>{{ __('Perfil') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Botão Mobile (Hambúrguer) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-indigo-600 transition duration-150 ease-in-out">
                    <i class="fas fa-bars text-xl" x-show="!open"></i>
                    <i class="fas fa-times text-xl" x-show="open" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 bg-white sm:hidden">
        <div class="flex flex-col h-full">
            <!-- Cabeçalho -->
            <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="h-8 w-8 bg-indigo-600 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-lightbulb text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-indigo-800">Plataforma</span>
                </div>
                <button @click="open = false" class="p-2 rounded-md text-gray-500 hover:text-indigo-600 hover:bg-gray-100">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Ligações -->
            <div class="flex-1 overflow-y-auto py-4 px-4 space-y-4">
                <x-nav-link :href="route('dashboard')" class="block w-full px-4 py-2 text-gray-800 hover:bg-gray-100" :active="request()->routeIs('dashboard')">
                    <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('controlos')" class="block w-full px-4 py-2 text-gray-800 hover:bg-gray-100" :active="request()->routeIs('controlos')">
                    <i class="fas fa-sliders-h mr-2"></i>{{ __('Controlos') }}
                </x-nav-link>
                <x-nav-link :href="route('relatorios')" class="block w-full px-4 py-2 text-gray-800 hover:bg-gray-100" :active="request()->routeIs('relatorios')">
                    <i class="fas fa-chart-line mr-2"></i>{{ __('Relatórios') }}
                </x-nav-link>

                @if(auth()->user()->admin == 1)
                    <x-nav-link :href="route('users_all')" class="block w-full px-4 py-2 text-gray-800 hover:bg-gray-100" :active="request()->routeIs('users_all')">
                        <i class="fas fa-user mr-2"></i>{{ __('Utilizadores') }}
                    </x-nav-link>
                @endif

                <x-nav-link :href="route('about')" class="block w-full px-4 py-2 text-gray-800 hover:bg-gray-100" :active="request()->routeIs('about')">
                    <i class="fas fa-info-circle mr-2"></i>{{ __('Sobre') }}
                </x-nav-link>
            </div>

            <!-- Área do Utilizador -->
            <div class="px-4 py-3 border-t border-gray-200">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-indigo-600"></i>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-user-cog mr-2"></i>{{ __('Perfil') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
