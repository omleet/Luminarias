<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-1">
            <h2 class="text-2xl font-bold text-white dark:text-white">
                About
            </h2>
            <p class="text-sm text-white dark:text-gray-400">
                Informação sobre este projeto e seus desenvolvedores
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8">
            <!-- About Card -->
            <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Informação do Projeto</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Detalhes sobre este projeto</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Project Description -->
                        <div class="p-4 bg-white dark:bg-gray-800/50 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Trabalho Laboratorial</h4>
                            <p class="text-gray-700 dark:text-gray-300">
                                Este projeto foi desenvolvido para a disciplina de ESS (Engenharia de Sistemas e Serviços)
                                do curso de Engenharia Informática.
                            </p>
                        </div>

                        <!-- Team Members -->
                        <div class="p-4 bg-white dark:bg-gray-800/50 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Equipa de desenvolvedores</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                        <span class="text-indigo-600 dark:text-indigo-400 font-medium">TL</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Telmo Lopes</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Student #2222064</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                        <span class="text-indigo-600 dark:text-indigo-400 font-medium">MC</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Maria Cordeiro</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Student #2222063</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                        <span class="text-indigo-600 dark:text-indigo-400 font-medium">NM</span>
                                    </div>
                                    <div>
                                        <br>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Nuno Martins</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Student #2201775</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Supervisor -->
                        <div class="p-4 bg-white dark:bg-gray-800/50 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Professor</h4>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Prof. António Manuel de Jesus Pereira</p>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div class="p-4 bg-white dark:bg-gray-800/50 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Detalhes do Projeto</h4>
                            <p class="text-gray-700 dark:text-gray-300">
                            Sistema de iluminação pública inteligente, que se adapta a necessidades específicas de cada município, desde pequenas localidades com orçamentos mais 
                            limitados até grandes cidades e municípios com alto investimento. 
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>