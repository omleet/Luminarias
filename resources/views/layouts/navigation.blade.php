<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="h-8 w-8 bg-indigo-600 rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-lightbulb text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-indigo-800">Plataforma</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('controlos') }}">
                        <i class="fas fa-sliders-h mr-2"></i>{{ __('Controles') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('relatorios') }}">
                        <i class="fas fa-chart-line mr-2"></i>{{ __('Relatórios') }}
                    </x-nav-link>

                    @if(auth()->user()->admin == 1)
                    <x-nav-link href="#">
                        <i class="fas fa-user mr-2"></i>{{ __('Utilizadores') }}
                    </x-nav-link>
                    @endif

                    <x-nav-link href="{{ route('about') }}">
                        <i class="fas fa-info-circle mr-2"></i>{{ __('About') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-indigo-600 focus:outline-none transition ease-in-out duration-150">
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
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-indigo-600 transition duration-150 ease-in-out">
                    <i class="fas fa-bars text-xl" x-show="!open"></i>
                    <i class="fas fa-times text-xl" x-show="open"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('controlos') }}">
                <i class="fas fa-sliders-h mr-2"></i>{{ __('Controles') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('relatorios') }}">
                <i class="fas fa-chart-line mr-2"></i>{{ __('Relatórios') }}
            </x-responsive-nav-link>

            @if(auth()->user()->admin == 1)
            <x-responsive-nav-link href="#">
                <i class="fas fa-user mr-2"></i>{{ __('Utilizadores') }}
            </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link href="{{ route('about') }}">
                <i class="fas fa-info-circle mr-2"></i>{{ __('About') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-cog mr-2"></i>{{ __('Perfil') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Sair') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>