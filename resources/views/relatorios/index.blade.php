<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-chart-line mr-3"></i>{{ __('Relatórios e Análises') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Estatísticas Resumidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Consumo Energético -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                            <i class="fas fa-bolt text-indigo-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Consumo Energético</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900" id="energy-consumption-value">0</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">%</div>
                            </dd>
                            <div class="text-xs text-gray-500 mt-1" id="energy-trend">
                                <i class="fas fa-sync-alt fa-spin mr-1"></i> Atualizando...
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Luminosidade -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <i class="fas fa-sun text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Luminosidade Média</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900" id="light-value">0</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">lux</div>
                            </dd>
                            <div class="text-xs text-gray-500 mt-1">
                                Variação: <span id="light-range">0-0</span> lux
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperatura -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                            <i class="fas fa-thermometer-half text-red-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Temperatura Média</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900" id="temperature-value">0</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">°C</div>
                            </dd>
                            <div class="text-xs text-gray-500 mt-1">
                                Variação: <span id="temperature-range">0-0</span>°C
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Humidade -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <i class="fas fa-tint text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Humidade Média</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900" id="humidity-value">0</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">%</div>
                            </dd>
                            <div class="text-xs text-gray-500 mt-1">
                                Variação: <span id="humidity-range">0-0</span>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos Principais -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Gráfico de Consumo -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-chart-area text-indigo-500 mr-2"></i> Consumo de Energia
                        </h3>
                    </div>
                    <div class="h-80" id="energy-chart-container">
                        <canvas></canvas>
                    </div>
                </div>

                <!-- Gráfico de Ativações -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-running text-blue-500 mr-2"></i> Ativações do Sensor de Movimento
                        </h3>
                    </div>
                    <div class="h-80" id="activations-chart-container">
                        <canvas></canvas>
                    </div>
                </div>
            </div>

            <!-- Tabela de Eventos -->
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-md transition duration-200 mb-8">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-list-ol text-green-500 mr-2"></i> Histórico de Eventos
                    </h3>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" id="event-search" placeholder="Pesquisar..." class="pl-8 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button id="refresh-events" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            <i class="fas fa-sync-alt mr-1"></i> Atualizar
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data/Hora</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalhes</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="event-history-container">
                            <!-- Os eventos serão carregados aqui via JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50 pagination-container">
                    <div class="flex-1 flex justify-between items-center">
                        <span id="event-count" class="text-sm text-gray-700"></span>
                        <div class="flex space-x-2">
                            <button id="prev-page" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50">Anterior</button>
                            <button id="next-page" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50">Próxima</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exportar Dados -->
            <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-file-export text-purple-500 mr-2"></i> Exportar Dados
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Exportar para Excel -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition duration-200">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                                <i class="fas fa-file-excel text-purple-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">Excel</h4>
                                <p class="text-sm text-gray-500">Dados formatados para Excel</p>
                            </div>
                        </div>
                        <a href="{{ route('export.history.excel') }}" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Exportar para Excel
                        </a>
                    </div>

                    <!-- Exportar para CSV -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition duration-200">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <i class="fas fa-file-csv text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">CSV</h4>
                                <p class="text-sm text-gray-500">Dados brutos em formato CSV</p>
                            </div>
                        </div>
                        <a href="{{ route('export.history.csv') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Exportar para CSV
                        </a>
                    </div>

                    <!-- Exportar para PDF -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition duration-200">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <i class="fas fa-file-pdf text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">PDF</h4>
                                <p class="text-sm text-gray-500">Relatório completo em PDF</p>
                            </div>
                        </div>
                        <a href="{{ route('export.history.pdf') }}" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Gerar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        let energyHistory = [];
        let energyChart = null;

        async function initEnergyChart() {
            const historyResponse = await fetch('/energy-history');
            const historyData = await historyResponse.json();

            energyHistory = historyData.map(item => ({
                value: item.energy,
                time: item.time
            }));

            const energyCtx = document.querySelector('#energy-chart-container canvas');

            energyChart = new Chart(energyCtx, {
                type: 'line',
                data: {
                    labels: energyHistory.map(item => item.time),
                    datasets: [{
                        label: 'Consumo de Energia (%)',
                        data: energyHistory.map(item => item.value),
                        backgroundColor: 'rgba(99, 102, 241, 0.2)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        }

        async function updateEnergyChart() {
            try {
                const response = await fetch('/energy-history'); // ou outro endpoint, se quiseres
                const data = await response.json();

                energyHistory.push({
                    value: data.energy,
                    time: new Date().toLocaleTimeString()
                });

                if (energyHistory.length > 50) {
                    energyHistory.shift();
                }

                updateEnergyChartDisplay();
            } catch (error) {
                console.error('Erro ao atualizar gráfico de energia:', error);
            }
        }

        function updateEnergyChartDisplay() {
            const labels = energyHistory.map(item => item.time);
            const values = energyHistory.map(item => item.value);

            energyChart.data.labels = labels;
            energyChart.data.datasets[0].data = values;
            energyChart.update();
        }

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            initEnergyChart();
            setInterval(updateEnergyChart, 10000); // atualiza de 10 em 10 segundos
        });





        // Variável para o gráfico de motion
        let motionChart;

        // Função para inicializar o gráfico de motion
        function initMotionChart() {
            const motionCtx = document.querySelector('#activations-chart-container canvas');
            motionChart = new Chart(motionCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Ativações por Sensor',
                        data: [],
                        backgroundColor: 'rgba(16, 185, 129, 0.6)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 1,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return value === 1 ? 'Ativo' : 'Inativo';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y === 1 ? 'Movimento detectado' : 'Sem movimento';
                                }
                            }
                        },
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Função para atualizar o gráfico de motion
        async function updateMotionChart() {
            try {
                const response = await fetch('/motion-data');
                const data = await response.json();

                if (data.length > 0) {
                    const labels = data.map(item => item.time);
                    const motionData = data.map(item => item.motion);

                    motionChart.data.labels = labels;
                    motionChart.data.datasets[0].data = motionData;
                    motionChart.update();
                }
            } catch (error) {
                console.error('Erro ao atualizar gráfico de motion:', error);
            }
        }

        // Inicialização (no DOMContentLoaded)
        document.addEventListener('DOMContentLoaded', function() {
            initMotionChart();
            updateMotionChart();

            // Atualizar a cada 10 segundos
            setInterval(updateMotionChart, 10000);
        });
    </script>


    <script>
        //script para os valores médios
        let lastEnergyValue = 0;
        let lastLightValue = 0;
        let lastTemperatureValue = 0;
        let lastHumidityValue = 0;

        // Função para atualizar as estatísticas
        async function updateSensorStats() {
            try {
                const response = await fetch('/sensor-averages');
                const data = await response.json();

                // Verificar se os dados são válidos
                if (data && typeof data.energy !== 'undefined') {
                    // Atualizar os valores na interface
                    updateStatValue('energy-consumption-value', data.energy, lastEnergyValue, '%');
                    updateStatValue('light-value', data.light, lastLightValue, ' lux');
                    updateStatValue('temperature-value', data.temperature, lastTemperatureValue, '°C');
                    updateStatValue('humidity-value', data.humidity, lastHumidityValue, '%');

                    // Atualizar os últimos valores
                    lastEnergyValue = data.energy;
                    lastLightValue = data.light;
                    lastTemperatureValue = data.temperature;
                    lastHumidityValue = data.humidity;

                    // Atualizar a tendência do consumo energético
                    updateEnergyTrend(data.energy);
                } else {
                    console.error('Dados inválidos recebidos:', data);
                }
            } catch (error) {
                console.error('Erro ao buscar dados dos sensores:', error);
            }
        }

        // Função para atualizar um valor individual com animação
        function updateStatValue(elementId, newValue, oldValue, unit) {
            const element = document.getElementById(elementId);
            if (!element) return;

            // Formatar o valor
            const formattedValue = typeof newValue === 'number' ? newValue.toFixed(1) : newValue;

            // Adicionar classe de animação
            element.classList.add('text-yellow-500');
            element.classList.add('font-bold');

            // Atualizar o valor
            element.textContent = formattedValue;

            // Remover a animação após um curto período
            setTimeout(() => {
                element.classList.remove('text-yellow-500');
                element.classList.remove('font-bold');
            }, 500);
        }

        // Função para atualizar a tendência do consumo energético
        function updateEnergyTrend(currentValue) {
            const trendElement = document.getElementById('energy-trend');
            if (!trendElement) return;

            if (lastEnergyValue === 0) {
                trendElement.innerHTML = '<i class="fas fa-info-circle mr-1"></i> Dados iniciais';
                trendElement.className = 'text-xs text-gray-500 mt-1';
                return;
            }

            const difference = currentValue - lastEnergyValue;
            const percentage = Math.abs((difference / lastEnergyValue) * 100).toFixed(1);

            if (difference > 0) {
                trendElement.innerHTML = `<i class="fas fa-arrow-up mr-1"></i> ${percentage}% maior que anterior`;
                trendElement.className = 'text-xs text-red-600 mt-1';
            } else if (difference < 0) {
                trendElement.innerHTML = `<i class="fas fa-arrow-down mr-1"></i> ${percentage}% menor que anterior`;
                trendElement.className = 'text-xs text-green-600 mt-1';
            } else {
                trendElement.innerHTML = '<i class="fas fa-equals mr-1"></i> Sem alteração';
                trendElement.className = 'text-xs text-gray-500 mt-1';
            }
        }

        // Atualizar os dados imediatamente e a cada 10 segundos
        updateSensorStats();
        setInterval(updateSensorStats, 10000);

        // Adicione esta função para buscar os intervalos de valores
        async function updateValueRanges() {
            try {
                const response = await fetch('/history');
                const data = await response.json();

                if (data.length > 0) {
                    const lights = data.map(item => item.light);
                    const temperatures = data.map(item => item.temperature);
                    const humidities = data.map(item => item.humidity);

                    document.getElementById('light-range').textContent =
                        `${Math.min(...lights).toFixed(0)}-${Math.max(...lights).toFixed(0)}`;
                    document.getElementById('temperature-range').textContent =
                        `${Math.min(...temperatures).toFixed(1)}-${Math.max(...temperatures).toFixed(1)}`;
                    document.getElementById('humidity-range').textContent =
                        `${Math.min(...humidities).toFixed(0)}-${Math.max(...humidities).toFixed(0)}`;
                }
            } catch (error) {
                console.error('Erro ao buscar intervalos de valores:', error);
            }
        }

        // Atualizar os intervalos de valores
        updateValueRanges();
        setInterval(updateValueRanges, 10000);
    </script>



    <script>
        // script para a tabela de historico
        // Variáveis para controle da paginação
        let currentPage = 1;
        const perPage = 2;
        let totalEvents = 0;
        let searchTerm = '';

        // Função para formatar um valor ou retornar padrão para nulo
        function formatValue(value, unit = '') {
            if (value === null || value === undefined) {
                return 'Dado inválido';
            }
            return value + unit;
        }

        // Função para determinar o tipo de evento com base nos dados
        function getEventType(item) {
            if (item.led_state === 'ON') return 'LED';
            if (item.motion === '1') return 'Movimento';
            if (item.light !== null) return 'Luminosidade';
            if (item.temperature !== null) return 'Temperatura';
            if (item.humidity !== null) return 'Humidade';
            return 'Evento';
        }

        // Função para obter detalhes do evento
        function getEventDetails(item) {
            if (item.led_state === 'ON') return 'Luz ligada';
            if (item.led_state === 'OFF') return 'Luz desligada';
            if (item.motion === '1') return 'Movimento detectado';
            if (item.motion === '0') return 'Sem movimento';
            if (item.light !== null) return 'Leitura de luminosidade';
            if (item.temperature !== null) return 'Leitura de temperatura';
            if (item.humidity !== null) return 'Leitura de humidade';
            return 'Evento registado';
        }

        // Função para obter o valor do evento formatado
        function getEventValue(item) {
            if (item.led_state === 'ON' || item.led_state === 'OFF') {
                return {
                    value: item.led_state,
                    invalid: false
                };
            }
            if (item.motion === '1' || item.motion === '0') {
                return {
                    value: item.motion === '1' ? 'Sim' : 'Não',
                    invalid: false
                };
            }
            if (item.light !== null) {
                return {
                    value: formatValue(item.light, ' lx'),
                    invalid: false
                };
            }
            if (item.temperature !== null) {
                return {
                    value: formatValue(item.temperature, '°C'),
                    invalid: false
                };
            }
            if (item.humidity !== null) {
                return {
                    value: formatValue(item.humidity, '%'),
                    invalid: false
                };
            }
            return {
                value: 'Dado inválido',
                invalid: true
            };
        }

        // Função para carregar os eventos
        async function loadEvents() {
            try {
                // Mostrar loading
                const container = document.getElementById('event-history-container');
                container.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center"><i class="fas fa-spinner fa-spin mr-2"></i> Carregando eventos...</td></tr>';

                // Fazer a requisição
                const response = await fetch(`/event-history?page=${currentPage}&per_page=${perPage}&search=${searchTerm}`);
                const data = await response.json();

                // Atualizar totais
                totalEvents = data.pagination.total;
                document.getElementById('event-count').textContent = `Mostrando ${((currentPage - 1) * perPage) + 1}-${Math.min(currentPage * perPage, totalEvents)} de ${totalEvents} eventos`;

                // Atualizar botões de paginação
                document.getElementById('prev-page').disabled = currentPage === 1;
                document.getElementById('next-page').disabled = currentPage === data.pagination.last_page;

                // Renderizar eventos
                if (data.data.length === 0) {
                    container.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center">Nenhum evento encontrado</td></tr>';
                    return;
                }

                let html = '';
                data.data.forEach(event => {
                    const eventTime = new Date(event.time.replace(/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}:\d{2})/, '$3-$2-$1 $4'));
                    const formattedTime = eventTime.toLocaleString('pt-PT', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    html += `
                        <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedTime}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${event.type}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${event.details}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm ${event.invalid ? 'text-red-600 font-medium' : 'text-gray-500'}">
            ${event.value}
        </td>
    </tr>
`;
                });

                container.innerHTML = html;
            } catch (error) {
                console.error('Erro ao carregar eventos:', error);
                document.getElementById('event-history-container').innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center text-red-500">Erro ao carregar eventos</td></tr>';
            }
        }

        // Event listeners
        document.getElementById('refresh-events').addEventListener('click', () => {
            currentPage = 1;
            loadEvents();
        });

        document.getElementById('prev-page').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                loadEvents();
            }
        });

        document.getElementById('next-page').addEventListener('click', () => {
            currentPage++;
            loadEvents();
        });

        document.getElementById('event-search').addEventListener('input', (e) => {
            searchTerm = e.target.value;
            currentPage = 1;
            loadEvents();
        });

        // Carregar eventos inicialmente
        document.addEventListener('DOMContentLoaded', loadEvents);
    </script>

</x-app-layout>