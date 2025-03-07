<div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Liste des employés</h2>
            <a href="" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Ajouter un employé
            </a>
        </div>
        
        <!-- Filtres de recherche -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                <input 
                    wire:model.live.debounce.300ms="search" 
                    type="text" 
                    placeholder="Nom, email ou ID..." 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                >
            </div>
            <div>
                <label for="departmentFilter" class="block text-sm font-medium text-gray-700 mb-1">Département</label>
                <select 
                    wire:model.live="departmentFilter" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                >
                    <option value="">Tous les départements</option>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="roleFilter" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                <select 
                    wire:model.live="roleFilter" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                >
                    <option value="">Tous les rôles</option>
                    @foreach($roles as $id => $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <!-- Table des employés -->
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
    <table class="min-w-full border-collapse">
        <thead>
        <tr class="bg-gradient-to-r from-purple-900 via-purple-800 to-purple-700 text-white">
    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Nom</th>
    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">ID Employé</th>
    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Département</th>
    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Date d'embauche</th>
    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
</tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-gray-50">
            @forelse($employees as $employee)
                <tr class="hover:bg-blue-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                        <div class="h-10 w-10 flex items-center justify-center rounded-full border bg-blue-100 text-blue-600 font-bold shadow">
                            {{ substr($employee->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $employee->name }}</div>
                            <div class="text-xs text-gray-500">{{ $employee->position }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->employee_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->department->name ?? 'Non assigné' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->hire_date ? $employee->hire_date->format('d/m/Y') : 'Non défini' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button 
                                wire:click="viewCursus({{ $employee->id }})"
                                class="flex items-center px-3 py-1.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition duration-200 text-xs shadow-md"
                            >
                                📄 Cursus
                            </button>
                            <a href="" 
                               class="flex items-center px-3 py-1.5 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition duration-200 text-xs shadow-md"
                            >
                                ✏️ Modifier
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="mt-2 text-sm font-medium">Aucun employé trouvé</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

        <div class="mt-4">
            {{ $employees->links() }}
        </div>
    </div>
    
    <!-- Modal pour afficher le cursus -->
    @if($showCursusModal)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Cursus</h3>
                        <button wire:click="closeCursusModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Informations de l'employé -->
                    <div class="flex items-center mb-8">
                        <div class="flex-shrink-0 h-16 w-16">
                            @if($selectedEmployee->profile_picture)
                                <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('storage/' . $selectedEmployee->profile_picture) }}" alt="{{ $selectedEmployee->name }}">
                            @else
                                <div class="h-16 w-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-xl font-bold">
                                    {{ substr($selectedEmployee->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $selectedEmployee->name }}</h4>
                            <p class="text-sm text-gray-500">{{ '@' . Str::slug($selectedEmployee->name, '') }}</p>
                            <p class="text-sm text-green-500">Actif</p>
                        </div>
                    </div>
                    
                    <!-- Timeline du cursus -->
                    <div class="mb-6">
                        <div class="relative">
                            <div class="absolute left-4 top-0 h-full w-0.5 bg-blue-500"></div>
                            
                            <!-- Timeline items -->
                            @php
                                $timelineItems = collect();
                                
                                // Ajouter la date d'embauche
                                if ($selectedEmployee->hire_date) {
                                    $timelineItems->push([
                                        'date' => $selectedEmployee->hire_date,
                                        'type' => 'embauche',
                                        'title' => 'Embauche',
                                        'details' => $selectedEmployee->position
                                    ]);
                                }
                                
                                // Ajouter les promotions
                                foreach ($selectedEmployee->salaryPromotions as $promotion) {
                                    $timelineItems->push([
                                        'date' => $promotion->effective_date,
                                        'type' => 'promotion',
                                        'title' => 'Promotion',
                                        'details' => 'Nouveau salaire: ' . $promotion->new_salary
                                    ]);
                                }
                                
                                // Ajouter les certifications ou formations
                                foreach ($selectedEmployee->careerRecords as $record) {
                                    $timelineItems->push([
                                        'date' => $record->date,
                                        'type' => 'certification',
                                        'title' => $record->title,
                                        'details' => $record->description
                                    ]);
                                }
                                
                                // Trier par date
                                $timelineItems = $timelineItems->sortBy('date');
                            @endphp
                            
                            @foreach($timelineItems as $item)
                                <div class="relative pl-10 pb-8">
                                    <div class="flex items-center mb-2">
                                        <div class="absolute left-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                            @if($item['type'] == 'embauche')
                                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($item['type'] == 'promotion')
                                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="bg-blue-600 rounded-md text-white text-xs px-2 py-1">
                                            {{ $item['date']->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <div class="ml-2">
                                        <h5 class="text-md font-medium text-gray-900">{{ $item['title'] }}</h5>
                                        <p class="text-sm text-gray-600">{{ $item['details'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Informations du contrat -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
                        <h4 class="text-lg font-semibold mb-4 text-center">Contrat</h4>
                        <div class="text-center mb-4">
                            <span class="font-medium">Type | {{ $selectedEmployee->contract_type ?? 'CDI' }}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center border-b pb-2">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full mr-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Siège / Ville</div>
                                    <div class="font-medium">{{ $selectedEmployee->entreprise->city ?? 'Non spécifié' }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center border-b pb-2">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full mr-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Date</div>
                                    <div class="font-medium">{{ $selectedEmployee->hire_date ? $selectedEmployee->hire_date->format('d M Y') : 'Non spécifié' }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center border-b pb-2">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full mr-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Département</div>
                                    <div class="font-medium">{{ $selectedEmployee->department->name ?? 'IT' }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center border-b pb-2">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full mr-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Manager</div>
                                    <div class="font-medium">{{ $selectedEmployee->manager->name ?? 'Non assigné' }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center border-b pb-2">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full mr-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Absences</div>
                                    <div class="font-medium">{{ $selectedEmployee->leaveRequests->where('status', 'approved')->count() ?? '-' }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center border-b pb-2">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full mr-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Retards</div>
                                    <div class="font-medium">-</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center border-b pb-2">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full mr-3">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Grade</div>
                                    <div class="font-medium">{{ $selectedEmployee->position ?? 'Junior' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="text-sm text-gray-600">Remarques</div>
                            <div class="mt-2 p-3 bg-gray-50 rounded-md">
                                <p class="text-sm text-gray-700">{{ $selectedEmployee->notes ?? 'Aucune remarque' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="flex justify-end space-x-3">
                        <button 
                            wire:click="closeCursusModal" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition"
                        >
                            Fermer
                        </button>
                        <a 
                            href="{{ route('employees.edit', $selectedEmployee->id) }}" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                        >
                            Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>