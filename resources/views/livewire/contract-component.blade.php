<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Gestion des Contrats</h2>

    <!-- Barre de recherche -->
    <input type="text" wire:model="searchTerm" placeholder="Rechercher un contrat..." class="w-full p-2 border rounded mb-4">

    <!-- Bouton Ajouter -->
    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">+ Ajouter Contrat</button>

    <!-- Table des contrats -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Employé</th>
                <th class="border p-2">Description</th>
                <th class="border p-2">Date Début</th>
                <th class="border p-2">Date Fin</th>
                <th class="border p-2">Salaire</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contracts as $contract)
                <tr class="border">
                    <td class="border p-2">{{ $contract->user->name }}</td>
                    <td class="border p-2">{{ $contract->description }}</td>
                    <td class="border p-2">{{ $contract->start_date }}</td>
                    <td class="border p-2">{{ $contract->end_date }}</td>
                    <td class="border p-2">{{ $contract->salary }}</td>
                    <td class="border p-2">{{ ucfirst($contract->status) }}</td>
                    <td class="border p-2">
                        <button wire:click="edit({{ $contract->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded">Modifier</button>
                        <button wire:click="openDeleteModal({{ $contract->id }})" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $contracts->links() }}
    </div>

    <!-- Modal d'ajout/modification -->
    @if($isOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold">{{ $contract_id ? 'Modifier le Contrat' : 'Ajouter un Contrat' }}</h2>
            <form wire:submit.prevent="store">
                <div class="mb-4">
                    <label class="block">Employé :</label>
                    <select wire:model="user_id" class="w-full p-2 border rounded">
                        <option value="">Sélectionner un employé</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block">Type de contrat :</label>
                    <select wire:model="contract_type_id" class="w-full p-2 border rounded">
                        <option value="">Sélectionner un type</option>
                        @foreach($contractTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block">Description :</label>
                    <textarea wire:model="description" class="w-full p-2 border rounded" placeholder="Entrez la description du contrat"></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block">Date de début :</label>
                    <input type="date" wire:model="start_date" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block">Date de fin :</label>
                    <input type="date" wire:model="end_date" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block">Salaire :</label>
                    <input type="number" step="0.01" wire:model="salary" class="w-full p-2 border rounded" placeholder="Entrez le salaire">
                </div>
                <div class="mb-4">
                    <label class="block">Statut :</label>
                    <select wire:model="status" class="w-full p-2 border rounded">
                        <option value="Active">Active</option>
                        <option value="Terminé">Terminé</option>
                        <option value="En attente">En attente</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</button>
                    <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded">{{ $contract_id ? 'Modifier' : 'Ajouter' }}</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal de suppression -->
    @if($isDeleteModalOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Confirmation</h2>
            <p>Êtes-vous sûr de vouloir supprimer ce contrat ?</p>
            <div class="flex justify-end mt-4">
                <button type="button" wire:click="closeDeleteModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</button>
                <button type="button" wire:click="delete({{ $contract_id }})" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
            </div>
        </div>
    </div>
    @endif
</div>
