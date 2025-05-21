<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-sliders-h mr-3"></i>{{ __('Controlos de Iluminação') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Botão de Toggle e Status -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex flex-col items-center space-y-4">
                    <button id="toggle-controls"
                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-8 rounded-md transition duration-200 shadow-md"
                        onclick="toggleAutoControl()">
                        Desligar controlo automático
                    </button>
                    <div id="sensor-status-text" class="text-center text-gray-600 italic">
                        Os sensores estão a operar de forma automática, de acordo com a programação definida no Arduino.
                    </div>
                </div>
            </div>

            <!-- Grid de Controles (inicialmente escondido) -->
            <div id="controls-container" class="hidden space-y-6">
                <!-- Grid de Controles -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Controle de LED Principal -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> LED Principal
                        </h3>
                        <div class="flex-grow space-y-4">
                            <!-- Estado do LED -->
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
                            </div>

                            <!-- Configuração de Sensibilidade -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sensibilidade do Sensor</label>
                                <div class="flex items-center justify-between">
                                    <input type="range" min="1" max="10" value="5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer mr-4" id="sensitivity-range">
                                    <span class="text-sm font-medium text-gray-700 w-8 text-center" id="sensitivity-value">5</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status e Botão de Aplicar -->
                        <div class="mt-4">
                            <div id="led-control-status" class="text-sm text-gray-600 mb-3 italic"></div>
                            <button id="apply-settings" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 shadow-md">
                                Aplicar Configurações
                            </button>
                        </div>
                    </div>

                    <!-- Controle de Sensor de Movimento -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-running text-blue-500 mr-2"></i> Sensor de Movimento
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="motion-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Desligado</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="motion-sensor-toggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sensibilidade</label>
                                <div class="flex items-center justify-between">
                                    <input type="range" min="1" max="10" value="5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer mr-4" id="motion-sensitivity">
                                    <span class="text-sm font-medium text-gray-700 w-8 text-center" id="motion-sensitivity-value">5</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Controle de Sensor de Temperatura -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-temperature-high text-red-500 mr-2"></i> Sensor de Temperatura
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="temperature-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Desligado</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="temperature-sensor-toggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Limite (°C)</label>
                                <input type="number" id="temperature-threshold" value="25" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Controle de Sensor de Luminosidade -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-sun text-yellow-400 mr-2"></i> Sensor de Luminosidade
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="light-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Desligado</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="light-sensor-toggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Limite (Lux)</label>
                                <input type="number" id="light-threshold" value="300" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Controle de Sensor de Humidade -->
                    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-tint text-blue-400 mr-2"></i> Sensor de Humidade
                        </h3>
                        <div class="flex-grow space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                                    <span id="humidity-sensor-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Desligado</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="humidity-sensor-toggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Limite (%)</label>
                                <input type="number" id="humidity-threshold" value="60" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        // Função para alternar o controle automático
        function toggleAutoControl() {
            const button = document.getElementById('toggle-controls');
            const statusText = document.getElementById('sensor-status-text');
            const controlsContainer = document.getElementById('controls-container');

            if (button.textContent.trim() === 'Desligar controlo automático') {
                button.textContent = 'Ligar controlo automático';
                button.classList.remove('bg-red-600', 'hover:bg-red-700');
                button.classList.add('bg-green-600', 'hover:bg-green-700');
                statusText.textContent = 'Ao clicar os sensores podem ser controlados automáticamente.';
                controlsContainer.classList.remove('hidden');
                localStorage.setItem('autoControlEnabled', 'false');
            } else {
                button.textContent = 'Desligar controlo automático';
                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                button.classList.add('bg-red-600', 'hover:bg-red-700');
                statusText.textContent = 'Os sensores estão a operar de forma automática, de acordo com a programação definida no Arduino.';
                controlsContainer.classList.add('hidden');
                localStorage.setItem('autoControlEnabled', 'true');
            }
        }

        // Verificar o estado salvo ao carregar a página
        document.addEventListener('DOMContentLoaded', function() {
            const autoControlEnabled = localStorage.getItem('autoControlEnabled');
            const button = document.getElementById('toggle-controls');
            const statusText = document.getElementById('sensor-status-text');
            const controlsContainer = document.getElementById('controls-container');

            if (autoControlEnabled === 'false') {
                button.textContent = 'Ligar controlo automático';
                button.classList.remove('bg-red-600', 'hover:bg-red-700');
                button.classList.add('bg-green-600', 'hover:bg-green-700');
                statusText.textContent = 'Ao clicar os sensores podem ser controlados automáticamente.';
                controlsContainer.classList.remove('hidden');
            } else {
                // Estado padrão (automático ativado)
                button.textContent = 'Desligar controlo automático';
                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                button.classList.add('bg-red-600', 'hover:bg-red-700');
                statusText.textContent = 'Os sensores estão a operar de forma automática, de acordo com a programação definida no Arduino.';
                controlsContainer.classList.add('hidden');
            }
        });

        // Controle do LED Principal
        document.getElementById('main-led-toggle').addEventListener('change', function() {
            const ledStatus = document.getElementById('main-led-status');
            const ledIntensity = document.getElementById('main-led-intensity');

            if (this.checked) {
                ledStatus.textContent = 'Ligado';
                ledStatus.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                ledIntensity.disabled = false;
            } else {
                ledStatus.textContent = 'Desligado';
                ledStatus.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800';
                ledIntensity.disabled = true;
            }
        });

        // Controle do Sensor de Movimento
        document.getElementById('motion-sensor-toggle').addEventListener('change', function() {
            const status = document.getElementById('motion-sensor-status');
            const control = document.getElementById('motion-sensitivity');

            if (this.checked) {
                status.textContent = 'Ativo';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                control.disabled = false;
            } else {
                status.textContent = 'Desligado';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800';
                control.disabled = true;
            }
        });

        // Controle do Sensor de Temperatura
        document.getElementById('temperature-sensor-toggle').addEventListener('change', function() {
            const status = document.getElementById('temperature-sensor-status');
            const control = document.getElementById('temperature-threshold');

            if (this.checked) {
                status.textContent = 'Ativo';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                control.disabled = false;
            } else {
                status.textContent = 'Desligado';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800';
                control.disabled = true;
            }
        });

        // Controle do Sensor de Luminosidade
        document.getElementById('light-sensor-toggle').addEventListener('change', function() {
            const status = document.getElementById('light-sensor-status');
            const control = document.getElementById('light-threshold');

            if (this.checked) {
                status.textContent = 'Ativo';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                control.disabled = false;
            } else {
                status.textContent = 'Desligado';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800';
                control.disabled = true;
            }
        });

        // Controle do Sensor de Humidade
        document.getElementById('humidity-sensor-toggle').addEventListener('change', function() {
            const status = document.getElementById('humidity-sensor-status');
            const control = document.getElementById('humidity-threshold');

            if (this.checked) {
                status.textContent = 'Ativo';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                control.disabled = false;
            } else {
                status.textContent = 'Desligado';
                status.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800';
                control.disabled = true;
            }
        });

        document.getElementById('main-led-intensity').addEventListener('input', function() {
            document.getElementById('main-led-intensity-value').textContent = this.value + '%';
        });

        // Configuração de sensibilidade do sensor de movimento
        document.getElementById('motion-sensitivity').addEventListener('input', function() {
            document.getElementById('motion-sensitivity-value').textContent = this.value;
        });

        // Enviar configurações para o ESP
        document.getElementById('apply-led-settings').addEventListener('click', function() {
            const isLedOn = document.getElementById('main-led-toggle').checked;
            const intensity = document.getElementById('main-led-intensity').value;

            console.log('Configurações enviadas:', {
                isLedOn,
                intensity
            });
            alert('Configurações aplicadas com sucesso!');
        });
    </script>


    <script>
        // Script para o LED
        const ESP_IP = '192.168.178.140';

        // Função para controlar o LED
        async function controlLed(state) {
            const statusMessage = document.getElementById('led-control-status');
            statusMessage.textContent = `Enviando comando para ${state === 'on' ? 'LIGAR' : 'DESLIGAR'}...`;

            try {
                const response = await fetch(`http://${ESP_IP}/led/${state}`, {
                    method: 'POST'
                });

                if (!response.ok) throw new Error('Erro na requisição');

                const newState = await fetchLedState();
                updateLedDisplay(newState);

                statusMessage.textContent = `LED ${state === 'on' ? 'LIGADO' : 'DESLIGADO'} (${new Date().toLocaleTimeString()})`;
                statusMessage.className = "text-sm text-green-600 mb-3 italic";
            } catch (error) {
                console.error('Erro ao controlar o LED:', error);
                statusMessage.textContent = 'Erro ao enviar comando.';
                statusMessage.className = "text-sm text-red-600 mb-3 italic";
            }
        }

        // Função para obter o estado atual do LED
        async function fetchLedState() {
            try {
                const response = await fetch(`http://${ESP_IP}/status`);
                if (!response.ok) throw new Error('Erro na requisição');
                const data = await response.json();
                return data.led; // "ON" ou "OFF"
            } catch (error) {
                console.error('Erro ao obter estado do LED:', error);
                return 'OFF';
            }
        }

        // Atualizar display do LED
        function updateLedDisplay(status) {
            const ledStatusElement = document.getElementById('led-status');
            if (status === 'ON') {
                ledStatusElement.textContent = 'Ligado';
                ledStatusElement.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
            } else {
                ledStatusElement.textContent = 'Desligado';
                ledStatusElement.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800';
            }
        }

        // Controlo direto do LED (botões ON/OFF)
        document.getElementById('led-on-btn').addEventListener('click', () => controlLed('on'));
        document.getElementById('led-off-btn').addEventListener('click', () => controlLed('off'));

        // Slider da sensibilidade
        document.getElementById('sensitivity-range').addEventListener('input', function() {
            document.getElementById('sensitivity-value').textContent = this.value;
        });

        // Aplicar configurações (sensibilidade)
        document.getElementById('apply-settings').addEventListener('click', async function() {
            const sensitivity = document.getElementById('sensitivity-range').value;
            const statusMessage = document.getElementById('led-control-status');

            statusMessage.textContent = "Aplicando configurações...";

            try {
                // Enviar valor da sensibilidade para o ESP
                const response = await fetch(`http://${ESP_IP}/sensitivity/${sensitivity}`, {
                    method: 'POST'
                });

                if (!response.ok) throw new Error("Erro ao enviar sensibilidade");

                statusMessage.textContent = "Configurações aplicadas com sucesso!";
                statusMessage.className = "text-sm text-green-600 mb-3 italic";
            } catch (error) {
                console.error('Erro ao aplicar configurações:', error);
                statusMessage.textContent = "Erro ao aplicar configurações";
                statusMessage.className = "text-sm text-red-600 mb-3 italic";
            }
        });

        // Ao carregar a página, atualizar o estado do LED
        document.addEventListener('DOMContentLoaded', async function() {
            const ledState = await fetchLedState();
            updateLedDisplay(ledState);
        });
    </script>

</x-app-layout>