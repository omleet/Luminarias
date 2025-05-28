<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-tachometer-alt mr-3"></i>{{ __('Dashboard de Sensores') }}
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto mb-6">
                <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-network-wired text-blue-600 mr-2"></i> Configuração de IP do ESP
                    </h3>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="flex-1">
                            <label for="esp-ip-input" class="block text-sm font-medium text-gray-600 mb-1">Endereço IP</label>
                            <input
                                type="text"
                                id="esp-ip-input"
                                class="form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Ex: 192.168.1.100">
                        </div>
                        <div>
                            <label class="block text-sm text-white select-none mb-1 invisible">Botão</label>
                            <button
                                id="save-esp-ip-btn"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-save mr-2"></i> Guardar IP
                            </button>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-3 flex items-center gap-2">
    IP atual: 
    <span id="current-esp-ip" class="font-semibold text-gray-700">192.168.1.100</span>
    <span id="ip-status-badge" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-200 text-gray-600">
        Verificando...
    </span>
</p>
                </div>
            </div>

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
                                <dd class="flex flex-col">
                                    <div class="text-2xl font-semibold text-gray-900" id="movement-status">--</div>
                                    <div class="mt-1 flex items-center text-sm font-semibold text-green-600 hidden" id="movement-active">
                                        <i class="fas fa-circle mr-1 text-xs"></i> Ligado
                                    </div>
                                    <div class="mt-1 flex items-center text-sm font-semibold text-gray-500" id="movement-inactive">
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
                                <dd class="flex flex-col">
                                    <div class="text-2xl font-semibold text-gray-900" id="led-status">--</div>
                                    <div class="flex items-center text-sm font-semibold text-green-600 hidden" id="led-on">
                                        <i class="fas fa-circle mr-1 text-xs"></i> Ligado
                                    </div>
                                    <div class="flex items-center text-sm font-semibold text-gray-500" id="led-off">
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

                <!-- Movimento Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-running text-blue-500 mr-2"></i> Variação de Movimento
                    </h3>
                    <div class="relative h-96">
                        <canvas id="movimento-chart" class="absolute inset-0 w-full h-full"></canvas>

                    </div>
                </div>

                <!-- LED Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> Variação do LED
                    </h3>
                    <div class="relative h-96">
                        <canvas id="led-chart" class="absolute inset-0 w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Temperature Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-thermometer-half text-red-500 mr-2"></i> Variação de Temperatura
                    </h3>
                    <div class="relative h-96">
                        <canvas id="temperature-chart" class="absolute inset-0 w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Light Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-sun text-yellow-500 mr-2"></i> Níveis de Luminosidade
                    </h3>
                    <div class="relative h-96">
                        <canvas id="light-chart" class="absolute inset-0 w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Humidade Chart -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-tint text-blue-400 mr-2"></i> Níveis de Humidade
                    </h3>
                    <div class="relative h-96">
                        <canvas id="humidade-chart" class="absolute inset-0 w-full h-full"></canvas>
                    </div>
                </div>
            </div>



            <!-- Recent Activity -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-history text-indigo-500 mr-2"></i> Atividade Recente
                    </h3>
                    <dt class="text-sm font-medium text-gray-500 truncate"> (Últimas 100 atividades) </dt>
                    <div class="flex space-x-2" id="pagination-controls">
                        <!-- Os controles de paginação serão inseridos aqui -->
                    </div>
                </div>
                <div class="divide-y divide-gray-200" id="recent-activity-container">
                    <!-- Os eventos serão carregados aqui via JavaScript -->
                </div>
            </div>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ipInput = document.getElementById('esp-ip-input');
            const saveBtn = document.getElementById('save-esp-ip-btn');
            const currentIp = document.getElementById('current-esp-ip');
            const ipStatusBadge = document.getElementById('ip-status-badge');

            // Load saved IP
            const savedIp = localStorage.getItem('espIp');
            if (savedIp) {
                ipInput.value = savedIp;
                currentIp.textContent = savedIp;
                window.ESP_IP = savedIp; // Set global JS variable
            }

            saveBtn.addEventListener('click', () => {
    const newIp = ipInput.value.trim();
    if (!/^(\d{1,3}\.){3}\d{1,3}$/.test(newIp)) {
        alert('Endereço IP inválido.');
        return;
    }

    localStorage.setItem('espIp', newIp);
    window.ESP_IP = newIp;
    alert('IP do ESP guardado com sucesso! A página será recarregada.');

    // Small delay for user to see alert before reload
    setTimeout(() => {
        location.reload();
    }, 300);
});
function checkEspConnection(ip) {
    fetch(`http://${ip}/ping`, { method: 'GET', mode: 'no-cors' })
        .then(() => {
            ipStatusBadge.textContent = 'Conectado';
            ipStatusBadge.classList.remove('bg-gray-200', 'text-gray-600');
            ipStatusBadge.classList.add('bg-green-100', 'text-green-700');
        })
        .catch(() => {
            ipStatusBadge.textContent = 'Desconectado';
            ipStatusBadge.classList.remove('bg-gray-200', 'text-gray-600');
            ipStatusBadge.classList.add('bg-red-100', 'text-red-700');
        });
}

// Run connectivity check if we have a saved IP
if (savedIp) {
    checkEspConnection(savedIp);
}

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Load global sensor polling script -->


    <!-- LED and Motion Display Update Helpers -->
    <script>
        // These functions update the dashboard UI display (only used in dashboard)
        function updateLedDisplay(status) {
            const ledStatusElement = document.getElementById('led-status');
            const ledOnElement = document.getElementById('led-on');
            const ledOffElement = document.getElementById('led-off');

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

        function updateMotionDisplay(active) {
            const motionStatusElement = document.getElementById('movement-status');
            const motionActiveBadge = document.getElementById('movement-active');
            const motionInactiveBadge = document.getElementById('movement-inactive');
            const motionContainer = motionStatusElement.closest('.bg-white');

            motionStatusElement.textContent = active ? 'Ligado' : 'Inativo';
            motionActiveBadge.classList.toggle('hidden', !active);
            motionInactiveBadge.classList.toggle('hidden', active);
            motionContainer.classList.toggle('ring-2', active);
            motionContainer.classList.toggle('ring-green-500', active);
        }
    </script>

    <!-- Lógica dos Gráficos -->
    <script>
        // Charts implementation
        // Configuração
        const charts = {
            movimento: null,
            led: null,
            temperature: null,
            light: null,
            humidade: null
        };

        // Função para mostrar/esconder loading state
        function showLoadingState(show) {
            const containers = document.querySelectorAll('[id$="-chart"]');
            containers.forEach(container => {
                if (show) {
                    const spinner = document.createElement('div');
                    spinner.className = 'chart-loading-spinner';
                    spinner.innerHTML = `
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            `;
                    container.parentNode.insertBefore(spinner, container);
                    container.style.opacity = '0.5';
                } else {
                    const spinner = container.parentNode.querySelector('.chart-loading-spinner');
                    if (spinner) spinner.remove();
                    container.style.opacity = '1';
                }
            });
        }

        // Função para mostrar estado de erro
        function showErrorState() {
            const containers = document.querySelectorAll('[id$="-chart"]');
            containers.forEach(container => {
                container.style.opacity = '0.5';
                container.style.border = '1px dashed #ff0000';
            });

            setTimeout(() => {
                containers.forEach(container => {
                    container.style.opacity = '1';
                    container.style.border = 'none';
                });
            }, 3000);
        }

        // Criar novo gráfico
        // Configuração melhorada dos gráficos
        function createChart(canvasId, label, labels, data, color, isLine = true) {
            const ctx = document.getElementById(canvasId);
            const chartKey = canvasId.replace('-chart', '');

            if (charts[chartKey]) {
                charts[chartKey].destroy();
            }

            // Configurações específicas por tipo de gráfico
            let yTicks = {};
            let chartType = isLine ? 'line' : 'bar';

            if (chartKey === 'movimento') {
                yTicks = {
                    ticks: {
                        min: 0,
                        max: 1,
                        stepSize: 1,
                        callback: function(value) {
                            return value === 1 ? 'Movimento' : 'Sem';
                        }
                    }
                };
                chartType = 'bar';
            } else if (chartKey === 'led') {
                yTicks = {
                    ticks: {
                        min: 0,
                        max: 1,
                        stepSize: 1,
                        callback: function(value) {
                            return value === 1 ? 'Ligado' : 'Desligado';
                        }
                    }
                };
                chartType = 'bar';
            } else {
                // Para temperatura, luz e humidade
                const numericData = data.map(d => parseFloat(d)).filter(d => !isNaN(d));
                const minValue = Math.min(...numericData);
                const maxValue = Math.max(...numericData);

                const range = maxValue - minValue;
                const step = range > 0 ? range / 9 : 1; // 10 marcas = 9 passos

                yTicks = {
                    min: Math.floor(minValue),
                    max: Math.ceil(maxValue),
                    stepSize: Math.ceil(step),
                    callback: function(value) {
                        if (chartKey === 'temperature') return value + '°C';
                        if (chartKey === 'light') return value + ' lx';
                        if (chartKey === 'humidade') return value + '%';
                        return value;
                    }
                };
            }

            return new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: color.replace('1)', '0.2)'),
                        borderColor: color,
                        borderWidth: 2,
                        pointRadius: isLine ? 3 : 0,
                        fill: isLine
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            reverse: true
                        },
                        y: yTicks
                    }
                }
            });
        }



        // Atualizar dados do gráfico
        function updateChartData(chartKey, labels, data, label, color, isLine = true) {
            const canvasId = `${chartKey}-chart`;

            if (!charts[chartKey]) {
                charts[chartKey] = createChart(canvasId, label, labels, data, color, isLine);
            } else {
                charts[chartKey].data.labels = labels;
                charts[chartKey].data.datasets[0].data = data;
                charts[chartKey].update();
            }
        }

        // Atualizar todos os gráficos
        // Atualizar todos os gráficos
        async function updateCharts() {
            try {
                showLoadingState(true);
                const response = await fetch('/history');
                let historyData = await response.json();

                // Ordenar por timestamp (ascendente para o gráfico)
                historyData.sort((a, b) => (a.timestamp || 0) - (b.timestamp || 0));

                // Extrair labels formatadas
                const labels = historyData.map(item => {

                    // Priorizar display_time se existir
                    if (item.full_datetime) {
                        return item.full_datetime; // Ex: "17/05/2025 14:32"
                    }

                    // Fallbacks se não houver
                    if (item.display_time && item.display_date) {
                        return `${item.display_date} ${item.display_time}`;
                    }

                    if (item.timestamp) {
                        const date = new Date(item.timestamp * 1000);
                        return `${date.toLocaleDateString()} ${date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}`;
                    }

                    if (item.created_at) {
                        const date = new Date(item.created_at);
                        return `${date.toLocaleDateString()} ${date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}`;
                    }

                    // Caso tudo falhe, retornar índice
                    return '';
                });



                // Verificar se todos os dados necessários existem
                const hasValidData = historyData.every(item =>
                    item.light !== undefined &&
                    item.temperature !== undefined &&
                    item.led_state !== undefined &&
                    item.motion !== undefined &&
                    item.humidity !== undefined
                );

                if (!hasValidData) {
                    console.error('Dados incompletos recebidos:', historyData);
                    showErrorState();
                    return;
                }

                // Atualizar gráficos
                updateChartData('movimento', labels,
                    historyData.map(item => item.motion === '1' || item.motion === 1 ? 1 : 0),
                    'Movimento', 'rgba(75, 192, 192, 1)', false);

                updateChartData('led', labels,
                    historyData.map(item => item.led_state ? 1 : 0),
                    'Estado do LED', 'rgba(255, 206, 86, 1)', false);


                updateChartData('temperature', labels,
                    historyData.map(item => parseFloat(item.temperature) || 0),
                    'Temperatura (°C)', 'rgba(255, 99, 132, 1)');

                updateChartData('light', labels,
                    historyData.map(item => parseInt(item.light) || 0),
                    'Luminosidade', 'rgba(255, 159, 64, 1)');

                updateChartData('humidade', labels,
                    historyData.map(item => parseFloat(item.humidity) || 0),
                    'Humidade (%)', 'rgba(54, 162, 235, 1)');

            } catch (error) {
                console.error('Error updating charts:', error);
                showErrorState();
            } finally {
                showLoadingState(false);
            }
        }

        // Inicialização
        document.addEventListener('DOMContentLoaded', () => {
            // Carregar gráficos imediatamente
            updateCharts();

            // Atualizar a cada 5 segundos
            setInterval(updateCharts, 20000);
        });
    </script>


    <!-- Lógica dos eventos recentes -->
    <script>
        let currentPage = 1;

        // Função para carregar atividade recente
        async function loadRecentActivity(page = 1) {
            try {
                currentPage = page;
                const response = await fetch(`/recent-activity?page=${page}`);
                const data = await response.json();
                const activities = data.activities;
                const pagination = data.pagination;

                // Atualiza a lista de atividades
                const container = document.getElementById('recent-activity-container');
                container.innerHTML = '';

                if (activities.length === 0) {
                    container.innerHTML = '<div class="px-6 py-4 text-gray-500">Nenhuma atividade recente</div>';
                    return;
                }

                activities.forEach(activity => {
                    const activityElement = document.createElement('div');
                    activityElement.className = 'px-6 py-4';
                    activityElement.innerHTML = `
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-${activity.icon_color}-100 rounded-full p-2">
                            <i class="fas fa-${activity.icon} text-${activity.icon_color}-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">${activity.title}</p>
                            <p class="text-sm text-gray-500">${activity.description} - ${activity.time}</p>
                        </div>
                    </div>
                `;
                    container.appendChild(activityElement);
                });

                // Atualiza os controles de paginação
                updatePaginationControls(pagination);

            } catch (error) {
                console.error('Error loading recent activity:', error);
                document.getElementById('recent-activity-container').innerHTML =
                    '<div class="px-6 py-4 text-red-500">Erro ao carregar atividades</div>';
            }

        }


        // Função para atualizar os controles de paginação
        function updatePaginationControls(pagination) {
            const controls = document.getElementById('pagination-controls');
            controls.innerHTML = '';

            // Botão Anterior
            const prevButton = document.createElement('button');
            prevButton.className = `px-3 py-1 rounded-md ${pagination.current_page === 1 ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200'}`;
            prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevButton.disabled = pagination.current_page === 1;
            prevButton.addEventListener('click', () => {
                if (pagination.current_page > 1) {
                    loadRecentActivity(pagination.current_page - 1);
                }
            });
            controls.appendChild(prevButton);

            // Indicador de página
            const pageIndicator = document.createElement('span');
            pageIndicator.className = 'px-3 py-1 text-sm text-gray-700';
            pageIndicator.textContent = `${pagination.current_page}/${pagination.last_page}`;
            controls.appendChild(pageIndicator);

            // Botão Próximo
            const nextButton = document.createElement('button');
            nextButton.className = `px-3 py-1 rounded-md ${pagination.current_page === pagination.last_page ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200'}`;
            nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextButton.disabled = pagination.current_page === pagination.last_page;
            nextButton.addEventListener('click', () => {
                if (pagination.current_page < pagination.last_page) {
                    loadRecentActivity(pagination.current_page + 1);
                }
            });
            controls.appendChild(nextButton);
        }

        // Carregar atividade recente quando a página carregar
        document.addEventListener('DOMContentLoaded', () => {
            loadRecentActivity();
        });
    </script>

</x-app-layout>