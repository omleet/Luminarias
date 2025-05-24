<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-sliders-h mr-3"></i>{{ __('Controlos de Iluminação') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Auto/Manual Toggle -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex flex-col items-center space-y-4">
                    <button id="toggle-controls" class="bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-8 rounded-md transition duration-200 shadow-md">
                        Desligar controlo automático
                    </button>
                    <div id="sensor-status-text" class="text-center text-gray-600 italic">
                        Os sensores estão a operar de forma automática, de acordo com a programação definida no Arduino.
                    </div>
                </div>
            </div>

            <!-- Controls Grid -->
            <div id="controls-container" class="hidden space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- LED Control -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> LED Principal
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="led-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">--</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button id="led-on-btn" class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                                        Ligar
                                    </button>
                                    <button id="led-off-btn" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 text-sm">
                                        Desligar
                                    </button>

                                </div>
                                <div class="mt-6">
                                    <label for="led-brightness-slider" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nível de Brilho (0–255)
                                    </label>
                                    <input type="range" id="led-brightness-slider" min="0" max="255" value="128"
                                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                    <div class="text-sm text-gray-600 mt-2">
                                        Valor atual: <span id="led-brightness-value">128</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div id="led-control-status" class="text-sm text-gray-600 mb-3 italic"></div>
                        </div>
                    </div>

                    <!-- Motion Sensor -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-running text-blue-500 mr-2"></i> Sensor de Movimento
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="motion-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">--</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="motion-sensor-toggle" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-sm font-medium text-gray-700">Detecção:</span>
                                <span id="movement-status" class="text-sm font-medium text-gray-700">--</span>
                                <span id="movement-active" class="hidden px-2 py-1 ml-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">Ativo</span>
                                <span id="movement-inactive" class="px-2 py-1 ml-2 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inativo</span>
                            </div>
                        </div>
                    </div>

                    <!-- Light Sensor -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-sun text-yellow-400 mr-2"></i> Sensor de Luminosidade
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="light-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">--</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="light-sensor-toggle" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-sm font-medium text-gray-700">Nível:</span>
                                <span id="light-value" class="text-sm font-medium text-gray-700">-- lx</span>
                            </div>
                        </div>
                    </div>

                    <!-- Temperature Sensor -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-temperature-high text-red-500 mr-2"></i> Sensor de Temperatura
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="temperature-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">--</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="temperature-sensor-toggle" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-sm font-medium text-gray-700">Temperatura:</span>
                                <span id="temperature-value" class="text-sm font-medium text-gray-700">-- °C</span>
                            </div>
                        </div>
                    </div>

                    <!-- Humidity Sensor -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-tint text-blue-400 mr-2"></i> Sensor de Humidade
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="humidity-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">--</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="humidity-sensor-toggle" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-sm font-medium text-gray-700">Humidade:</span>
                                <span id="humidity-value" class="text-sm font-medium text-gray-700">-- %</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-controls');
            const statusText = document.getElementById('sensor-status-text');
            const container = document.getElementById('controls-container');
            const ledOnBtn = document.getElementById('led-on-btn');
            const ledOffBtn = document.getElementById('led-off-btn');
            const brightnessSlider = document.getElementById('led-brightness-slider');
            const brightnessValueText = document.getElementById('led-brightness-value');

            const sensorToggles = {
                'motion-sensor-toggle': 'motion-sensor-status',
                'light-sensor-toggle': 'light-sensor-status',
                'temperature-sensor-toggle': 'temperature-sensor-status',
                'humidity-sensor-toggle': 'humidity-sensor-status',
            };

            // --- Restore toggle states from localStorage ---
            Object.keys(sensorToggles).forEach(toggleId => {
                const saved = localStorage.getItem(toggleId);
                const toggle = document.getElementById(toggleId);
                if (toggle && saved !== null) {
                    toggle.checked = saved === 'true';
                }
            });

            // --- Update sensor status text and color ---
            const updateSensorStatuses = () => {
                for (const [toggleId, statusId] of Object.entries(sensorToggles)) {
                    const toggle = document.getElementById(toggleId);
                    const status = document.getElementById(statusId);
                    if (toggle && status) {
                        status.textContent = toggle.checked ? 'Ligado' : 'Desligado';
                        status.classList.toggle('bg-green-100', toggle.checked);
                        status.classList.toggle('text-green-800', toggle.checked);
                        status.classList.toggle('bg-gray-100', !toggle.checked);
                        status.classList.toggle('text-gray-800', !toggle.checked);
                    }
                }
            };

            function updateLedStatusBadge(isOn) {
                const el = document.getElementById('led-status');
                if (!el) return;

                el.textContent = isOn ? 'Ligado' : 'Desligado';

                el.classList.toggle('bg-green-100', isOn);
                el.classList.toggle('text-green-800', isOn);
                el.classList.toggle('bg-gray-100', !isOn);
                el.classList.toggle('text-gray-800', !isOn);
            }

            // --- Save toggle changes and update status ---
            Object.keys(sensorToggles).forEach(toggleId => {
                const toggle = document.getElementById(toggleId);
                if (toggle) {
                    toggle.addEventListener('change', () => {
                        localStorage.setItem(toggleId, toggle.checked);
                        updateSensorStatuses();
                    });
                }
            });

            // --- Enable/disable LED buttons ---
            const updateLedButtons = (enabled) => {
                [ledOnBtn, ledOffBtn].forEach(btn => {
                    if (btn) {
                        btn.disabled = !enabled;
                        btn.classList.toggle('opacity-50', !enabled);
                        btn.classList.toggle('cursor-not-allowed', !enabled);
                    }
                    if (brightnessSlider) {
    brightnessSlider.disabled = !enabled;
    brightnessSlider.classList.toggle('opacity-50', !enabled);
    brightnessSlider.classList.toggle('cursor-not-allowed', !enabled);
}
                });
            };

            // --- Set mode based on localStorage ---
            const setMode = (isAuto) => {
                localStorage.setItem('autoControlEnabled', isAuto);

                if (isAuto) {
                    toggleBtn.textContent = 'Desligar controlo automático';
                    toggleBtn.classList.remove('bg-green-600');
                    toggleBtn.classList.add('bg-red-600');
                    statusText.textContent = 'Os sensores estão a operar de forma automática, de acordo com a programação definida no Arduino.';
                    container.classList.add('hidden');
                    updateLedButtons(false);
                } else {
                    toggleBtn.textContent = 'Ligar controlo automático';
                    toggleBtn.classList.remove('bg-red-600');
                    toggleBtn.classList.add('bg-green-600');
                    statusText.textContent = 'Os sensores estão desligados. O controlo está agora em modo manual.';
                    container.classList.remove('hidden');
                    updateLedButtons(true);
                }
            };

            // --- On load: apply saved mode ---
            const isAuto = localStorage.getItem('autoControlEnabled') === 'true';
            setMode(isAuto);

            // --- When button is clicked: toggle mode ---
            toggleBtn.addEventListener('click', () => {
                const currentState = localStorage.getItem('autoControlEnabled') === 'true';
                setMode(!currentState);
            });

            // --- Manual LED controls ---
            if (ledOnBtn) {
    ledOnBtn.addEventListener('click', async () => {
        const brightnessValue = parseInt(brightnessSlider.value, 10);
        const status = document.getElementById('led-control-status');

        try {
            // First, call /led/on to log/update the system
            const onRes = await fetch('http://192.168.1.100/led/on', {
                method: 'POST'
            });

            if (!onRes.ok) {
                status.textContent = 'Erro ao ligar LED.';
                return;
            }

            // Then, adjust brightness separately
            const brightnessRes = await fetch(`http://192.168.1.100/led/brightness?value=${brightnessValue}`, {
                method: 'POST'
            });

            if (brightnessRes.ok) {
                status.textContent = `LED ligado com brilho ${brightnessValue}.`;
                updateLedStatusBadge(true);
                brightnessValueText.textContent = brightnessValue;
            } else {
                status.textContent = 'LED ligado mas houve erro ao ajustar o brilho.';
            }

        } catch {
            status.textContent = 'Falha na comunicação com o Arduino.';
        }
    });
}

            if (ledOffBtn) {
                ledOffBtn.addEventListener('click', async () => {
                    try {
                        const res = await fetch('http://192.168.1.100/led/off', {
                            method: 'POST'
                        });
                        const status = document.getElementById('led-control-status');
                        status.textContent = res.ok ? 'LED desligado manualmente.' : 'Erro ao desligar LED.';
                        if (res.ok) updateLedStatusBadge(false);
                    } catch {
                        document.getElementById('led-control-status').textContent = 'Falha na comunicação com o Arduino.';
                    }
                });
            }
            if (brightnessSlider) {
    brightnessSlider.addEventListener('input', async () => {
        const value = parseInt(brightnessSlider.value, 10);
        brightnessValueText.textContent = value;

        try {
            const res = await fetch(`http://192.168.1.100/led/brightness?value=${value}`, {
                method: 'POST'
            });
            const status = document.getElementById('led-control-status');
            status.textContent = res.ok
                ? `Brilho ajustado para ${value}.`
                : 'Erro ao ajustar brilho.';
            updateLedStatusBadge(value > 0);
        } catch {
            document.getElementById('led-control-status').textContent = 'Falha na comunicação com o Arduino.';
        }
    });
}

            // Initial sync
            updateSensorStatuses();
        });
    </script>



</x-app-layout>