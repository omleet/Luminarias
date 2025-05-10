<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-sliders-h mr-3"></i>{{ __('Controles de Iluminação') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid de Controles -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Controle de LED Principal -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> LED Principal
                    </h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="mr-3 text-sm font-medium text-gray-700">Estado:</span>
                            <span id="main-led-status" class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Desligado</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="main-led-toggle" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Intensidade</label>
                        <input type="range" min="0" max="100" value="0" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" id="main-led-intensity">
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>0%</span>
                            <span id="main-led-intensity-value">0%</span>
                            <span>100%</span>
                        </div>
                    </div>
                    <button id="apply-led-settings" class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                        Aplicar Configurações
                    </button>
                </div>

                <!-- Configurações de Sensores -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-cog text-indigo-500 mr-2"></i> Configurações de Sensores
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Sensor de Movimento -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sensor de Movimento</label>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Sensibilidade</span>
                                <input type="range" min="1" max="10" value="5" class="w-32 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" id="motion-sensitivity">
                                <span class="text-sm font-medium text-gray-700 w-8 text-center" id="motion-sensitivity-value">5</span>
                            </div>
                        </div>
                        
                        <!-- Limiares de Luminosidade -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Limiar de Luminosidade</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex-1">
                                    <label class="block text-xs text-gray-500 mb-1">Mínimo (lx)</label>
                                    <input type="number" value="50" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs text-gray-500 mb-1">Máximo (lx)</label>
                                    <input type="number" value="500" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Temporizador Automático -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Temporizador Automático</label>
                            <div class="flex items-center space-x-2">
                                <input type="time" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="18:00">
                                <span class="text-gray-500">às</span>
                                <input type="time" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="06:00">
                            </div>
                        </div>
                    </div>
                    
                    <button class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                        Salvar Configurações
                    </button>
                </div>
            </div>

            <!-- Grupos de Luminárias -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-layer-group text-green-500 mr-2"></i> Grupos de Luminárias
                </h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grupo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intensidade</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-lightbulb text-indigo-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Exemplo 1</div>
                                            <div class="text-sm text-gray-500">3 luminárias</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Ligado</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">75%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-lightbulb text-indigo-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Exemplo 2</div>
                                            <div class="text-sm text-gray-500">5 luminárias</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Desligado</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 0%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">0%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-lightbulb text-indigo-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Exemplo 3</div>
                                            <div class="text-sm text-gray-500">4 luminárias</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Ligado</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 30%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">30%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex justify-end">
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-plus mr-2"></i> Adicionar Grupo
                    </button>
                </div>
            </div>

            <!-- Programação Automática -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-clock text-purple-500 mr-2"></i> Programação Automática
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-3 text-sm font-medium text-gray-700">Ativar modo noturno automático</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="time" class="px-2 py-1 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="18:30">
                            <span class="text-sm text-gray-500">às</span>
                            <input type="time" class="px-2 py-1 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="06:00">
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="ml-3 text-sm font-medium text-gray-700">Ligar quando movimento detectado</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">Duração:</span>
                            <input type="number" min="1" max="60" value="5" class="w-16 px-2 py-1 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-sm text-gray-500">minutos</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                            <span class="ml-3 text-sm font-medium text-gray-700">Ajustar intensidade pela luminosidade</span>
                        </div>
                    </div>
                </div>
                
                <button class="mt-6 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                    Salvar Programação
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Controle do LED Principal
        const ledToggle = document.getElementById('main-led-toggle');
        const ledIntensity = document.getElementById('main-led-intensity');
        const ledIntensityValue = document.getElementById('main-led-intensity-value');
        const ledStatus = document.getElementById('main-led-status');
        
        ledToggle.addEventListener('change', function() {
            if(this.checked) {
                ledStatus.textContent = 'Ligado';
                ledStatus.classList.remove('bg-gray-100', 'text-gray-800');
                ledStatus.classList.add('bg-green-100', 'text-green-800');
                ledIntensity.disabled = false;
            } else {
                ledStatus.textContent = 'Desligado';
                ledStatus.classList.remove('bg-green-100', 'text-green-800');
                ledStatus.classList.add('bg-gray-100', 'text-gray-800');
                ledIntensity.disabled = true;
            }
        });
        
        ledIntensity.addEventListener('input', function() {
            ledIntensityValue.textContent = this.value + '%';
        });
        
        // Configuração de sensibilidade do sensor de movimento
        const motionSensitivity = document.getElementById('motion-sensitivity');
        const motionSensitivityValue = document.getElementById('motion-sensitivity-value');
        
        motionSensitivity.addEventListener('input', function() {
            motionSensitivityValue.textContent = this.value;
        });
        
        // Enviar configurações para o ESP
        document.getElementById('apply-led-settings').addEventListener('click', function() {
            // Aqui você implementaria a chamada para a API que controla o ESP
            const isLedOn = ledToggle.checked;
            const intensity = ledIntensity.value;
            
            console.log('Configurações enviadas:', { isLedOn, intensity });
            // Exemplo: fetch('/api/led-control', { method: 'POST', body: JSON.stringify({ isLedOn, intensity }) });
            
            alert('Configurações aplicadas com sucesso!');
        });
    </script>
    @endpush
</x-app-layout>