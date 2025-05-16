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
                                        <i class="fas fa-circle mr-1 text-xs"></i> Ligado
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-gray-500" id="movement-inactive">
                                        <i class="fas fa-circle mr-1 text-xs"></i> Desligado
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
    const UPDATE_INTERVAL = 2000;   // 2 seconds

    // DOM Elements
    const ledStatusElement    = document.getElementById('led-status');
    const ledOnElement        = document.getElementById('led-on');
    const ledOffElement       = document.getElementById('led-off');
    const statusMessage       = document.getElementById('led-control-status');
    const lightValueElement   = document.getElementById('light-value');
    const temperatureElement  = document.getElementById('temperature-value');
    const humidityElement     = document.getElementById('humidity-value');

    // PIR Elements
    const motionStatusElement = document.getElementById('movement-status');
    const motionActiveBadge   = document.getElementById('movement-active');
    const motionInactiveBadge = document.getElementById('movement-inactive');
    const motionContainer     = motionStatusElement.closest('.bg-white');

    // Update LED display
    function updateLedDisplay(status) {
        ledStatusElement.textContent = status;
        if (status === 'ON') {
            ledOnElement.classList.remove('hidden');
            ledOffElement.classList.add('hidden');
            ledStatusElement.closest('.bg-white')
                .classList.add('ring-2', 'ring-green-500');
        } else {
            ledOnElement.classList.add('hidden');
            ledOffElement.classList.remove('hidden');
            ledStatusElement.closest('.bg-white')
                .classList.remove('ring-2', 'ring-green-500');
        }
    }

    // Update Motion display (big text, badge, ring)
    function updateMotionDisplay(active) {
        // text
        motionStatusElement.textContent = active ? 'Ligado' : 'Inativo';
        // badges
        motionActiveBadge.classList.toggle('hidden', !active);
        motionInactiveBadge.classList.toggle('hidden', active);
        // ring
        motionContainer.classList.toggle('ring-2', active);
        motionContainer.classList.toggle('ring-green-500', active);
    }

    // Generic fetch+json helper
    async function fetchJson(path, opts = {}) {
        const res = await fetch(`http://${ESP_IP}${path}`, opts);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
    }

    // Fetchers
    async function fetchLedState() {
        try {
            const data = await fetchJson('/status');
            return data.led;  // "ON" or "OFF"
        } catch (e) {
            statusMessage.textContent = 'Erro ao obter status';
            throw e;
        }
    }

    async function fetchLightLevel() {
        const data = await fetchJson('/light');
        const lux = analogToLux(data.light);
        lightValueElement.textContent = `${lux} lx`;
        return { analog: data.light, lux };
    }

    async function fetchTemperatureHumidity() {
        const data = await fetchJson('/temperature');
        temperatureElement.textContent = `${data.temperature} °C`;
        humidityElement.textContent    = `${data.humidity} %`;
        return data;
    }

    async function fetchMotionRaw() {
        const data = await fetchJson('/motion');
       
        return data.motion;  // true or false
    }

    // Convert analog value to lux
    function analogToLux(analogValue) {
        const inverted = 1024 - analogValue;
        return Math.round((inverted / 1024) * 1000);
    }

    // Control LED
    async function controlLed(state) {
        statusMessage.textContent = `Enviando comando para ${state==='on'?'LIGAR':'DESLIGAR'}...`;
        await fetch(`http://${ESP_IP}/led/${state}`, { method: 'POST' });
        const newState = await fetchLedState();
        updateLedDisplay(newState);
        statusMessage.textContent = `LED ${state==='on'?'LIGADO':'DESLIGADO'} (${new Date().toLocaleTimeString()})`;
    }

    // Upload data to DB
    async function uploadToDatabase(lux, temperature, ledState,motion,humidity) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            await fetch('http://localhost/history', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept':       'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ light: lux, temperature, led_state: ledState,motion: motion,humidity: humidity })
            });
            console.log("Data saved to DB.");
        } catch (err) {
            console.error("Failed to save to DB:", err);
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        // Button listeners
        document.getElementById('led-on-btn').addEventListener('click',  () => controlLed('on'));
        document.getElementById('led-off-btn').addEventListener('click', () => controlLed('off'));

        // Clear initial displays
        updateLedDisplay('OFF');
        updateMotionDisplay(false);

        // Polling loop
        setInterval(async () => {
            try {
                // 1) Fetch LED, light and temp in parallel
                const [ ledState, lightData, tempHum,rawMotion ] = await Promise.all([
                    fetchLedState(),
                    fetchLightLevel(),
                    fetchTemperatureHumidity(),
                    fetchMotionRaw()
                ]);
                updateLedDisplay(ledState);
                updateMotionDisplay(rawMotion); // 2)  display motion
               
                
                

                // 3) Auto‑LED by lux
                if (lightData.lux < 150 && ledState !== 'ON') {
                    await controlLed('on');
                } else if (lightData.lux >= 150 && ledState !== 'OFF') {
                    await controlLed('off');
                }

                // 4) Save to DB
                await uploadToDatabase(lightData.lux, tempHum.temperature, ledState,rawMotion,tempHum.humidity);

            } catch (err) {
                console.error('Polling error:', err);
            }
        }, UPDATE_INTERVAL);
    });
</script>



   
</x-app-layout>