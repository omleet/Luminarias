<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-chart-line mr-3"></i>{{ __('Relatórios e Análises') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-filter text-indigo-500 mr-2"></i> Filtros
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Período</label>
                        <select id="report-period" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="24h">Últimas 24 horas</option>
                            <option value="7d" selected>Últimos 7 dias</option>
                            <option value="30d">Últimos 30 dias</option>
                            <option value="custom">Personalizado</option>
                        </select>
                    </div>

                    <div id="custom-date-range" class="hidden col-span-2 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Data Inicial</label>
                            <input type="date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Data Final</label>
                            <input type="date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sensor</label>
                        <select id="sensor-type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="all">Todos os sensores</option>
                            <option value="light">Luminosidade</option>
                            <option value="temp">Temperatura</option>
                            <option value="humidity">Humidade</option>
                            <option value="motion">Movimento</option>
                        </select>
                    </div>



                    <div class="md:col-span-4 flex justify-end space-x-3">
                        <button id="apply-filters" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md transition duration-200">
                            Aplicar Filtros
                        </button>
                        <button id="reset-filters" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-md transition duration-200">
                            Limpar
                        </button>
                    </div>
                </div>
            </div>

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
                                <div class="text-2xl font-semibold text-gray-900">24.5</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">kWh</div>
                            </dd>
                            <div class="text-xs text-green-600 mt-1">
                                <i class="fas fa-arrow-down mr-1"></i> 12% menor que semana passada
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
                                <div class="text-2xl font-semibold text-gray-900">320</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">lux</div>
                            </dd>
                            <div class="text-xs text-gray-500 mt-1">
                                Variação: 150-500 lux
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
                                <div class="text-2xl font-semibold text-gray-900">22.4</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">°C</div>
                            </dd>
                            <div class="text-xs text-gray-500 mt-1">
                                Variação: 18.5-26.2°C
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
                                <div class="text-2xl font-semibold text-gray-900">65</div>
                                <div class="ml-2 text-sm font-medium text-gray-500">%</div>
                            </dd>
                            <div class="text-xs text-gray-500 mt-1">
                                Variação: 45-80%
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
                        <div class="flex space-x-2">
                            <button class="text-xs px-2 py-1 bg-indigo-100 text-indigo-800 rounded">Dia</button>
                            <button class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded">Semana</button>
                            <button class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded">Mês</button>
                        </div>
                    </div>
                    <div class="h-80" id="energy-consumption-chart">
                        <!-- Gráfico será renderizado aqui pelo JavaScript -->
                        <div class="h-full flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-chart-line text-4xl text-gray-300 mb-2"></i>
                                <p class="text-gray-500">Carregando dados de consumo...</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500 flex justify-between items-center">
                        <div>
                            <i class="fas fa-info-circle mr-1"></i> Dados coletados a cada 15 minutos
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            <i class="fas fa-expand mr-1"></i> Ampliar
                        </button>
                    </div>
                </div>

                <!-- Gráfico de Ativações -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition duration-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-chart-bar text-blue-500 mr-2"></i> Ativações por Sensor
                        </h3>
                        <div class="flex space-x-2">
                            <button class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">Dia</button>
                            <button class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded">Semana</button>
                            <button class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded">Mês</button>
                        </div>
                    </div>
                    <div class="h-80" id="sensor-activations-chart">
                        <!-- Gráfico será renderizado aqui pelo JavaScript -->
                        <div class="h-full flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-chart-bar text-4xl text-gray-300 mb-2"></i>
                                <p class="text-gray-500">Carregando dados de ativações...</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-500 flex justify-between items-center">
                        <div>
                            <i class="fas fa-info-circle mr-1"></i> Baseado em detecções de movimento
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            <i class="fas fa-expand mr-1"></i> Ampliar
                        </button>
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
                            <input type="text" placeholder="Pesquisar..." class="pl-8 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
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
                            <!-- Os eventos serão carregados aqui -->
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50 pagination-container">
                    <!-- A paginação será carregada aqui -->
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
                                <p class="text-sm text-gray-500">Dados formatados para planilhas</p>
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
        // Variáveis globais
        let energyChart, activationsChart;
        let currentEventPage = 1;

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            initDateInputs();
            loadReportData();
            loadEventHistory();

            // Event listeners
            document.getElementById('apply-filters').addEventListener('click', loadReportData);
            document.getElementById('reset-filters').addEventListener('click', resetFilters);
            document.getElementById('report-period').addEventListener('change', toggleCustomDateRange);

            // Event history search
            document.querySelector('#event-history-search button').addEventListener('click', function() {
                loadEventHistory(1, document.querySelector('#event-history-search input').value);
            });
        });

        // Funções principais
        async function loadReportData() {
            try {
                showChartLoading();

                const period = document.getElementById('report-period').value;
                let url = `/report-data?period=${period}`;

                if (period === 'custom') {
                    const startDate = document.querySelector('#custom-date-range input:nth-child(1)').value;
                    const endDate = document.querySelector('#custom-date-range input:nth-child(2)').value;
                    url += `&start_date=${startDate}&end_date=${endDate}`;
                }

                const response = await fetch(url);
                const data = await response.json();

                updateCharts(data);
                updateStats(data);

            } catch (error) {
                console.error('Error:', error);
                showChartError();
            }
        }

        async function loadEventHistory(page = 1, search = '') {
            try {
                showEventLoading();

                let url = `/event-history?page=${page}`;
                if (search) url += `&search=${search}`;

                const response = await fetch(url);
                const {
                    data,
                    pagination
                } = await response.json();

                updateEventTable(data);
                updatePagination(pagination);

            } catch (error) {
                console.error('Error:', error);
                document.getElementById('event-history-container').innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-4 text-red-500">
                        Erro ao carregar eventos
                    </td>
                </tr>
            `;
            }
        }

        // Funções auxiliares
        function initDateInputs() {
            const today = new Date().toISOString().split('T')[0];
            const oneWeekAgo = new Date();
            oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
            const oneWeekAgoStr = oneWeekAgo.toISOString().split('T')[0];

            const dateInputs = document.querySelectorAll('#custom-date-range input[type="date"]');
            dateInputs[0].value = oneWeekAgoStr;
            dateInputs[1].value = today;
        }

        function toggleCustomDateRange() {
            const customRange = document.getElementById('custom-date-range');
            customRange.classList.toggle('hidden', this.value !== 'custom');
            customRange.classList.toggle('grid', this.value === 'custom');
        }

        function resetFilters() {
            document.getElementById('report-period').value = '7d';
            document.getElementById('sensor-type').value = 'all';
            document.getElementById('custom-date-range').classList.add('hidden');
            loadReportData();
        }

        function updateCharts(data) {
            // Preparar dados
            const labels = data.map(item => {
                if (document.getElementById('report-period').value === '24h') {
                    return `${item.hour}:00`;
                }
                return `${item.date} ${item.hour}:00`;
            });

            const ledData = data.map(item => item.led_on_count);
            const motionData = data.map(item => item.motion_count);

            // Atualizar ou criar gráficos
            if (!energyChart) {
                energyChart = createChart('energy-consumption-chart', labels, ledData, 'Consumo de Energia', 'rgba(79, 70, 229, 0.8)');
            } else {
                updateChart(energyChart, labels, ledData);
            }

            if (!activationsChart) {
                activationsChart = createChart('sensor-activations-chart', labels, motionData, 'Ativações por Sensor', 'rgba(59, 130, 246, 0.8)', 'bar');
            } else {
                updateChart(activationsChart, labels, motionData);
            }
        }

        function createChart(canvasId, labels, data, label, color, type = 'line') {
            const ctx = document.getElementById(canvasId);
            ctx.innerHTML = '<canvas></canvas>';

            return new Chart(ctx.querySelector('canvas'), {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: color.replace('0.8', '0.2'),
                        borderColor: color,
                        borderWidth: 2,
                        fill: type === 'line'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        function updateChart(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }

        function updateStats(data) {
            if (data.length === 0) return;

            // Calcular médias
            const lightAvg = data.reduce((sum, item) => sum + item.light_avg, 0) / data.length;
            const tempAvg = data.reduce((sum, item) => sum + item.temp_avg, 0) / data.length;
            const humidityAvg = data.reduce((sum, item) => sum + item.humidity_avg, 0) / data.length;

            // Atualizar UI (simplificado)
            document.querySelectorAll('.stat-card')[1].querySelector('dd div').textContent = lightAvg.toFixed(0) + ' lx';
            document.querySelectorAll('.stat-card')[2].querySelector('dd div').textContent = tempAvg.toFixed(1) + '°C';
            document.querySelectorAll('.stat-card')[3].querySelector('dd div').textContent = humidityAvg.toFixed(0) + '%';
        }

        function updateEventTable(events) {
            const container = document.getElementById('event-history-container');
            container.innerHTML = '';

            if (events.length === 0) {
                container.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Nenhum evento encontrado
                    </td>
                </tr>
            `;
                return;
            }

            events.forEach(event => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    ${new Date(event.created_at).toLocaleString()}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <i class="fas ${getEventIcon(event)} text-${getEventColor(event)}-500 mr-2"></i>
                        <span class="text-sm font-medium text-gray-900">${getEventType(event)}</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${getEventDetails(event)}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    ${getEventValue(event)}
                </td>
            `;
                container.appendChild(row);
            });
        }

        function updatePagination(pagination) {
            const container = document.querySelector('.pagination-container');
            if (!container) return;

            container.innerHTML = `
            <div class="text-sm text-gray-500">
                Mostrando <span class="font-medium">${((pagination.current_page - 1) * pagination.per_page) + 1}</span> 
                a <span class="font-medium">${Math.min(pagination.current_page * pagination.per_page, pagination.total)}</span> 
                de <span class="font-medium">${pagination.total}</span> eventos
            </div>
            <div class="flex space-x-2">
                <button onclick="loadEventHistory(${pagination.current_page - 1})" 
                    class="px-3 py-1 border rounded-md ${pagination.current_page === 1 ? 'bg-gray-100 cursor-not-allowed' : 'bg-white hover:bg-gray-50'}">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-3 py-1 bg-indigo-600 text-white rounded-md">
                    ${pagination.current_page}
                </button>
                <button onclick="loadEventHistory(${pagination.current_page + 1})" 
                    class="px-3 py-1 border rounded-md ${pagination.current_page === pagination.last_page ? 'bg-gray-100 cursor-not-allowed' : 'bg-white hover:bg-gray-50'}">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        `;
        }

        // Funções de ajuda para eventos
        function getEventIcon(event) {
            if (event.led_state === 'ON') return 'fa-lightbulb';
            if (event.motion) return 'fa-walking';
            return 'fa-info-circle';
        }

        function getEventColor(event) {
            if (event.led_state === 'ON') return 'indigo';
            if (event.motion) return 'green';
            return 'blue';
        }

        function getEventType(event) {
            if (event.led_state === 'ON') return 'LED Ligado';
            if (event.motion) return 'Movimento';
            return 'Leitura';
        }

        function getEventDetails(event) {
            if (event.led_state === 'ON') return 'Luzes ligadas';
            if (event.motion) return 'Movimento detectado';
            return 'Leitura do sensor';
        }

        function getEventValue(event) {
            if (event.led_state === 'ON') return '-';
            if (event.motion) return '-';
            return `${event.light} lx, ${event.temperature}°C, ${event.humidity}%`;
        }

        // Funções de estado
        function showChartLoading() {
            ['energy-consumption-chart', 'sensor-activations-chart'].forEach(id => {
                const chart = document.getElementById(id);
                chart.innerHTML = `
                <div class="h-full flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin text-indigo-500 text-2xl mb-2"></i>
                        <p class="text-gray-600">Carregando dados...</p>
                    </div>
                </div>
            `;
            });
        }

        function showChartError() {
            ['energy-consumption-chart', 'sensor-activations-chart'].forEach(id => {
                const chart = document.getElementById(id);
                chart.innerHTML = `
                <div class="h-full flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl mb-2"></i>
                        <p class="text-gray-600">Erro ao carregar dados</p>
                        <button onclick="loadReportData()" class="mt-2 text-indigo-600 hover:text-indigo-800 text-sm">
                            Tentar novamente
                        </button>
                    </div>
                </div>
            `;
            });
        }

        function showEventLoading() {
            const container = document.getElementById('event-history-container');
            container.innerHTML = `
            <tr>
                <td colspan="4" class="text-center py-4">
                    <i class="fas fa-spinner fa-spin text-indigo-500 mr-2"></i>
                    Carregando...
                </td>
            </tr>
        `;
        }
    </script>

</x-app-layout>