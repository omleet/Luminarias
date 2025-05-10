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
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Grupo</label>
                        <select id="light-group" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="all">Todos os grupos</option>
                            <option value="main-room">Sala Principal</option>
                            <option value="hallway">Corredor</option>
                            <option value="garden">Jardim</option>
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Local</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalhes</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Exemplo de dados - estes seriam substituídos por dados reais do backend -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/06/2023 08:32</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-walking text-indigo-500 mr-2"></i>
                                        <span class="text-sm font-medium text-gray-900">Movimento</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sala Principal</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Luzes ligadas</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/06/2023 08:15</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-sun text-yellow-500 mr-2"></i>
                                        <span class="text-sm font-medium text-gray-900">Luminosidade</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jardim</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Leitura</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">420 lx</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/06/2023 07:58</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-thermometer-half text-red-500 mr-2"></i>
                                        <span class="text-sm font-medium text-gray-900">Temperatura</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Corredor</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Leitura</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">21.5°C</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/06/2023 06:30</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-bolt text-green-500 mr-2"></i>
                                        <span class="text-sm font-medium text-gray-900">Energia</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sistema</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Desligamento automático</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">14/06/2023 23:45</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-tint text-blue-500 mr-2"></i>
                                        <span class="text-sm font-medium text-gray-900">Humidade</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jardim</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Leitura noturna</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">72%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                    <div class="text-sm text-gray-500">
                        Mostrando <span class="font-medium">1</span> a <span class="font-medium">5</span> de <span class="font-medium">124</span> eventos
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            1
                        </button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            2
                        </button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            3
                        </button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
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
                                <p class="text-sm text-gray-500">Dados formatados para planilhas</p>
                            </div>
                        </div>
                        <button class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Exportar para Excel
                        </button>
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
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Exportar para CSV
                        </button>
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
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Gerar PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Mostrar/ocultar seleção de datas personalizadas
        document.getElementById('report-period').addEventListener('change', function() {
            const customDateRange = document.getElementById('custom-date-range');
            if(this.value === 'custom') {
                customDateRange.classList.remove('hidden');
                customDateRange.classList.add('grid');
            } else {
                customDateRange.classList.add('hidden');
                customDateRange.classList.remove('grid');
            }
        });

        // Aplicar filtros
        document.getElementById('apply-filters').addEventListener('click', function() {
            const period = document.getElementById('report-period').value;
            const sensorType = document.getElementById('sensor-type').value;
            const lightGroup = document.getElementById('light-group').value;
            
            // Aqui você implementaria a chamada para a API para filtrar os dados
            console.log('Filtrando por:', { period, sensorType, lightGroup });
            
            // Simulação de carregamento
            const charts = ['energy-consumption-chart', 'sensor-activations-chart'];
            charts.forEach(chartId => {
                const chartElement = document.getElementById(chartId);
                chartElement.innerHTML = `
                    <div class="h-full flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin text-4xl text-indigo-500 mb-2"></i>
                            <p class="text-gray-700">Aplicando filtros...</p>
                        </div>
                    </div>
                `;
            });
            
            // Simular carregamento dos dados após 1.5s
            setTimeout(() => {
                charts.forEach(chartId => {
                    const chartElement = document.getElementById(chartId);
                    chartElement.innerHTML = `
                        <div class="h-full flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-check-circle text-4xl text-green-500 mb-2"></i>
                                <p class="text-gray-700">Dados atualizados</p>
                                <p class="text-xs text-gray-500 mt-2">Use uma biblioteca como Chart.js para renderizar os gráficos</p>
                            </div>
                        </div>
                    `;
                });
            }, 1500);
        });

        // Resetar filtros
        document.getElementById('reset-filters').addEventListener('click', function() {
            document.getElementById('report-period').value = '7d';
            document.getElementById('sensor-type').value = 'all';
            document.getElementById('light-group').value = 'all';
            document.getElementById('custom-date-range').classList.add('hidden');
        });

        // Simular exportação de dados
        document.querySelectorAll('[class*="fa-download"]').forEach(icon => {
            icon.closest('button').addEventListener('click', function() {
                const format = this.innerText.includes('Excel') ? 'Excel' : 
                              this.innerText.includes('CSV') ? 'CSV' : 'PDF';
                
                // Simular download
                this.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i> Preparando ${format}...`;
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = `<i class="fas fa-check mr-2"></i> ${format} pronto`;
                    setTimeout(() => {
                        this.innerHTML = `<i class="fas fa-download mr-2"></i> ${this.innerText.replace(' pronto', '')}`;
                        this.disabled = false;
                    }, 2000);
                }, 1500);
            });
        });
    </script>
    @endpush
</x-app-layout>