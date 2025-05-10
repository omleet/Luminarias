<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-tachometer-alt mr-3"></i>{{ __('Dashboard de Sensores') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Status Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Sensor de Movimento -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                <i class="fas fa-walking text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Movimento</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900" id="movement-status">--</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600 hidden" id="movement-active">
                                        <i class="fas fa-circle mr-1 text-xs"></i> Ativo
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-gray-500" id="movement-inactive">
                                        <i class="fas fa-circle mr-1 text-xs"></i> Inativo
                                    </div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LED Status -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <i class="fas fa-lightbulb text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">LED</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900" id="led-status">--</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600 hidden" id="led-on">
                                        <i class="fas fa-circle mr-1 text-xs"></i> Ligado
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-gray-500" id="led-off">
                                        <i class="fas fa-circle mr-1 text-xs"></i> Desligado
                                    </div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sensor de Temperatura -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                                <i class="fas fa-thermometer-half text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Temperatura</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900" id="temperature-value">--°C</div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sensor de Luminosidade -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-sun text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Luminosidade</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900" id="light-value">-- lx</div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sensor de Humidade -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <i class="fas fa-tint text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Humidade</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900" id="humidity-value">--%</div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Teste para o Vue -->
            <div id="app" class="bg-white rounded-lg p-6">
                    <example-component></example-component>
                </div>    
            <!-- Temperature Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-thermometer-half text-red-500 mr-2"></i> Variação de Temperatura
                    </h3>
                    <div class="h-64" id="temperature-chart"></div>
                </div>

                <!-- Light Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-sun text-yellow-500 mr-2"></i> Níveis de Luminosidade
                    </h3>
                    <div class="h-64" id="light-chart"></div>
                </div>
            </div>

            <!-- Controls Section -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-sliders-h text-indigo-500 mr-2"></i> Controles
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- LED Control -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Controle da Luminária</label>
                        <div class="flex items-center">
                            <button id="led-on-btn" class="px-4 py-2 bg-green-600 text-white rounded-l-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Ligar
                            </button>
                            <button id="led-off-btn" class="px-4 py-2 bg-red-600 text-white rounded-r-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Desligar
                            </button>
                        </div>
                    </div>

                    <!-- Motion Sensor Settings -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Configuração de Sensibilidade</label>
                        <div class="flex items-center">
                            <input type="range" min="1" max="10" value="5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" id="sensitivity-range">
                            <span class="ml-3 text-sm text-gray-600" id="sensitivity-value">5</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-history text-indigo-500 mr-2"></i> Atividade Recente
                    </h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-2">
                                <i class="fas fa-lightbulb text-indigo-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">LED ligado automaticamente</p>
                                <p class="text-sm text-gray-500">Há 2 minutos - Detecção de movimento</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <i class="fas fa-sun text-blue-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Luminosidade abaixo do limite</p>
                                <p class="text-sm text-gray-500">Há 15 minutos - 150 lx</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                                <i class="fas fa-thermometer-half text-red-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Temperatura acima do normal</p>
                                <p class="text-sm text-gray-500">Há 32 minutos - 28°C</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Aqui você pode adicionar a lógica para atualizar os valores dos sensores em tempo real
        // via AJAX ou WebSocket quando integrar com o ESP
        
        // Exemplo de atualização simulada
        setInterval(() => {
            // Simular dados dos sensores
            document.getElementById('temperature-value').textContent = Math.floor(Math.random() * 10 + 20) + '°C';
            document.getElementById('light-value').textContent = Math.floor(Math.random() * 500 + 100) + ' lx';
            document.getElementById('humidity-value').textContent = Math.floor(Math.random() * 30 + 50) + '%';
            
            // Simular estado do LED (alternar a cada 5 segundos)
            if(Math.random() > 0.5) {
                document.getElementById('led-status').textContent = 'ON';
                document.getElementById('led-on').classList.remove('hidden');
                document.getElementById('led-off').classList.add('hidden');
            } else {
                document.getElementById('led-status').textContent = 'OFF';
                document.getElementById('led-on').classList.add('hidden');
                document.getElementById('led-off').classList.remove('hidden');
            }
            
            // Simular sensor de movimento
            if(Math.random() > 0.7) {
                document.getElementById('movement-status').textContent = 'DETECTADO';
                document.getElementById('movement-active').classList.remove('hidden');
                document.getElementById('movement-inactive').classList.add('hidden');
            } else {
                document.getElementById('movement-status').textContent = 'INATIVO';
                document.getElementById('movement-active').classList.add('hidden');
                document.getElementById('movement-inactive').classList.remove('hidden');
            }
        }, 2000);
        
        // Controles
        document.getElementById('led-on-btn').addEventListener('click', function() {
            // Enviar comando para ligar o LED via API
            document.getElementById('led-status').textContent = 'ON';
            document.getElementById('led-on').classList.remove('hidden');
            document.getElementById('led-off').classList.add('hidden');
        });
        
        document.getElementById('led-off-btn').addEventListener('click', function() {
            // Enviar comando para desligar o LED via API
            document.getElementById('led-status').textContent = 'OFF';
            document.getElementById('led-on').classList.add('hidden');
            document.getElementById('led-off').classList.remove('hidden');
        });
        
        document.getElementById('sensitivity-range').addEventListener('input', function() {
            document.getElementById('sensitivity-value').textContent = this.value;
            // Enviar configuração de sensibilidade para o ESP
        });
    </script>
    @endpush
</x-app-layout>