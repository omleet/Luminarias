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
                        <div id="led-control-status" class="mt-2 text-sm text-gray-600"></div>
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

    
    <script>
    // Configuration
    const ESP_IP = '192.168.1.100'; // VERIFY THIS IS YOUR ESP's IP
    const UPDATE_INTERVAL = 2000; // 2 seconds
    
    // DOM Elements
    const ledStatusElement = document.getElementById('led-status');
    const ledOnElement = document.getElementById('led-on');
    const ledOffElement = document.getElementById('led-off');
    const statusMessage = document.getElementById('led-control-status');
    const lightValueElement = document.getElementById('light-value');
    const temperatureElement = document.getElementById('temperature-value');
    const humidityElement = document.getElementById('humidity-value');
    
    // Update LED display
    function updateLedDisplay(status) {
        console.log("Updating LED display to:", status);
        ledStatusElement.textContent = status;
        
        if (status === 'ON') {
            ledOnElement.classList.remove('hidden');
            ledOffElement.classList.add('hidden');
            // Visual feedback
            document.querySelector('#led-status').closest('.bg-white')
                .classList.add('ring-2', 'ring-green-500');
        } else {
            ledOnElement.classList.add('hidden');
            ledOffElement.classList.remove('hidden');
            document.querySelector('#led-status').closest('.bg-white')
                .classList.remove('ring-2', 'ring-green-500');
        }
    }
    
    // Get current LED state from ESP
    async function fetchLedState() {
        try {
            const response = await fetch(`http://${ESP_IP}/status`);
            if (!response.ok) throw new Error('Network error');
            const data = await response.json();
            return data.led;
        } catch (error) {
            console.error('Error fetching LED state:', error);
            statusMessage.textContent = 'Erro ao obter status';
            return null;
        }
    }

    // Fetch light level
    async function fetchLightLevel() {
        try {
            const response = await fetch(`http://${ESP_IP}/light`);
            const data = await response.json();
            
            const analogValue = data.light;
            const lux = analogToLux(analogValue);
            
            lightValueElement.textContent = `${lux} lx`;
        } catch (error) {
            console.error("Failed to fetch light level:", error);
        }
    }

    // Convert analog value to lux
    function analogToLux(analogValue) {
        const inverted = 1024 - analogValue;
        const lux = Math.round((inverted / 1024) * 1000);  // Adjust max lux as needed
        return lux;
    }
    
    // Fetch temperature and humidity from the ESP8266
    async function fetchTemperatureHumidity() {
        try {
            const response = await fetch(`http://${ESP_IP}/temperature`);
            const data = await response.json();

            // Display the temperature and humidity
            const temperature = data.temperature;
            const humidity = data.humidity;

            temperatureElement.textContent = `${temperature} °C`;
            humidityElement.textContent = `${humidity} %`;
        } catch (error) {
            console.error("Failed to fetch temperature and humidity:", error);
        }
    }
    
    // Control LED
    async function controlLed(state) {
        try {
            statusMessage.textContent = `Enviando comando para ${state === 'on' ? 'LIGAR' : 'DESLIGAR'}...`;
            
            const response = await fetch(`http://${ESP_IP}/led/${state}`, {
                method: 'POST'
            });
            
            if (!response.ok) throw new Error('Command failed');
            
            // Verify change
            const newState = await fetchLedState();
            if (newState !== state.toUpperCase()) throw new Error('State not changed');
            
            updateLedDisplay(newState);
            statusMessage.textContent = `LED ${state === 'on' ? 'LIGADO' : 'DESLIGADO'} com sucesso (${new Date().toLocaleTimeString()})`;
        } catch (error) {
            console.error('Error controlling LED:', error);
            statusMessage.textContent = `ERRO: ${error.message}`;
            statusMessage.classList.add('text-red-500');
            setTimeout(() => statusMessage.classList.remove('text-red-500'), 3000);
        }
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        console.log("Dashboard initialized");
        
        // Button event listeners
        document.getElementById('led-on-btn').addEventListener('click', () => controlLed('on'));
        document.getElementById('led-off-btn').addEventListener('click', () => controlLed('off'));
        
        // Sensitivity slider
        document.getElementById('sensitivity-range').addEventListener('input', (e) => {
            document.getElementById('sensitivity-value').textContent = e.target.value;
        });
        
        // Initial load
        fetchLedState().then(state => {
            if (state) updateLedDisplay(state);
        });

        // Upload data to DB (with light, temperature, and LED state)
        async function uploadToDatabase(lux, temp, state) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                await fetch('http://localhost/history', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        light: lux,
                        temperature: temp,
                        led_state: state
                    })
                });
                console.log("Data saved to DB.");
            } catch (err) {
                console.error("Failed to save to DB:", err);
            }
        }
        
        // Auto-refresh
        setInterval(async () => {
            const state = await fetchLedState();
            
            try {
                // Fetch the light level
                await fetchLightLevel();

                // Fetch temperature and humidity
                await fetchTemperatureHumidity();

                const response = await fetch(`http://${ESP_IP}/light`);
                const data = await response.json();
                const analogValue = data.light;
                const lux = analogToLux(analogValue);

                // Auto control LED based on lux value
                if (lux < 150 && state !== 'ON') {
                    await controlLed('on');
                } else if (lux >= 150 && state !== 'OFF') {
                    await controlLed('off');
                }
                
                if (state) updateLedDisplay(state);
                uploadToDatabase(lux, analogValue, state);
            } catch (error) {
                console.error("Error in light/LED logic:", error);
            }

        }, UPDATE_INTERVAL);
    });
</script>

   
</x-app-layout>