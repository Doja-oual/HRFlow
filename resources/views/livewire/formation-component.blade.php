<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Gestion des Formations</h2>

    <input type="text" wire:model="searchTerm" placeholder="Rechercher une formation..." class="w-full p-2 border rounded mb-4">

    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">+ Ajouter Formation</button>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Employé</th>
                <th class="border p-2">Titre</th>
                <th class="border p-2">Institution</th>
                <th class="border p-2">Date Début</th>
                <th class="border p-2">Date Fin</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainings as $formation)
                <tr class="border">
        
                    <td class="border p-2">{{ $formation->title }}</td>
                    <td class="border p-2">{{ $formation->institution }}</td>
                    <td class="border p-2">{{ $formation->start_date }}</td>
                    <td class="border p-2">{{ $formation->end_date }}</td>
                    <td class="border p-2">{{ ucfirst($formation->status) }}</td>
                    <td class="border p-2">
                        <button wire:click="edit({{ $formation->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded">Modifier</button>
                        <button wire:click="openDeleteModal({{ $formation->id }})" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $trainings->links() }}
    </div>

    @if($isOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold">{{ $formation_id ? 'Modifier la Formation' : 'Ajouter une Formation' }}</h2>
            <form wire:submit.prevent="store">
               
                <div class="mb-4">
                    <label class="block">Titre :</label>
                    <input type="text" wire:model="title" class="w-full p-2 border rounded" placeholder="Titre de la formation">
                </div>
                <div class="mb-4">
                    <label class="block">Institution :</label>
                    <input type="text" wire:model="institution" class="w-full p-2 border rounded" placeholder="Nom de l'institution">
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
                    <label class="block">Statut :</label>
                    <select wire:model="status" class="w-full p-2 border rounded">
                        <option value="completed">Complétée</option>
                        <option value="ongoing">En cours</option>
                        <option value="planned">Planifiée</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</button>
                    <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded">{{ $formation_id ? 'Modifier' : 'Ajouter' }}</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if($isDeleteModalOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Confirmation</h2>
            <p>Êtes-vous sûr de vouloir supprimer cette formation ?</p>
            <div class="flex justify-end mt-4">
                <button type="button" wire:click="closeDeleteModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</button>
                <button type="button" wire:click="delete({{ $formation_id }})" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
            </div>
        </div>
    </div>
    @endif
</div>
