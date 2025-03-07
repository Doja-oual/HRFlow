<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message de bienvenue -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">{{ __("Bienvenue, ") }} {{ Auth::user()->name }}!</h3>
                </div>
            </div>
            @hasrole('admin')

            <!-- Cartes statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Carte - Total des employés -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total des employés</div>
                                <div class="text-2xl font-semibold">{{ $totalEmployees ?? 124 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Carte - Nouveaux employés -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Nouveaux ce mois</div>
                                <div class="text-2xl font-semibold">{{ $newEmployees ?? 8 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Carte - Départements -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Départements</div>
                                <div class="text-2xl font-semibold">{{ $departments ?? 7 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Carte - Postes vacants -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Postes vacants</div>
                                <div class="text-2xl font-semibold">{{ $openPositions ?? 12 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Graphiques et analyses -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Distribution des employés par département -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Employés par département</h3>
                        <div class="space-y-4">
                            <!-- IT -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">IT</span>
                                    <span class="text-sm font-medium">28%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 28%"></div>
                                </div>
                            </div>
                            
                            <!-- RH -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">RH</span>
                                    <span class="text-sm font-medium">12%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 12%"></div>
                                </div>
                            </div>
                            
                            <!-- Marketing -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Marketing</span>
                                    <span class="text-sm font-medium">18%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 18%"></div>
                                </div>
                            </div>
                            
                            <!-- Finance -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Finance</span>
                                    <span class="text-sm font-medium">15%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 15%"></div>
                                </div>
                            </div>
                            
                            <!-- Production -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Production</span>
                                    <span class="text-sm font-medium">27%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 27%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Activités récentes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Activités récentes</h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                        J
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Jean Dupont a rejoint l'équipe Marketing</p>
                                    <p class="text-sm text-gray-500">Aujourd'hui à 10:30</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                        S
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Sophie Martin a été promue Responsable IT</p>
                                    <p class="text-sm text-gray-500">Hier à 15:45</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold">
                                        P
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Pierre Legrand a soumis un nouveau rapport</p>
                                    <p class="text-sm text-gray-500">02/03/25 à 09:15</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center text-white font-bold">
                                        M
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Marie Petit a terminé sa formation</p>
                                    <p class="text-sm text-gray-500">28/02/25 à 14:20</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Résumé des ressources humaines -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Résumé des ressources humaines</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2">Taux de rotation</h4>
                            <p class="text-3xl font-bold text-blue-600">5.2%</p>
                            <p class="text-sm text-gray-500 mt-1">-0.8% par rapport au mois dernier</p>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2">Taux d'absentéisme</h4>
                            <p class="text-3xl font-bold text-blue-600">3.7%</p>
                            <p class="text-sm text-gray-500 mt-1">+0.2% par rapport au mois dernier</p>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-700 mb-2">Satisfaction employés</h4>
                            <p class="text-3xl font-bold text-blue-600">4.2/5</p>
                            <p class="text-sm text-gray-500 mt-1">+0.3 par rapport au trimestre précédent</p>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Budget formation utilisé</h4>
                        <div class="w-full bg-gray-200 rounded-full h-4 mt-3">
                            <div class="bg-blue-600 h-4 rounded-full" style="width: 68%"></div>
                        </div>
                        <div class="flex justify-between mt-1">
                            <span class="text-sm text-gray-500">68% utilisé</span>
                            <span class="text-sm text-gray-500">32% restant</span>
                        </div>
                    </div>
                </div>
            </div>
            @endhasrole
            
        </div>
    </div>
</x-app-layout>