<div class="p-6 bg-white shadow rounded">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Gestion des Permissions</h2>
        <button wire:click="create" class="px-4 py-2 bg-blue-500 text-white rounded">Ajouter une permission</button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-200 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Nom</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr class="border">
                    <td class="border p-2">{{ $permission->name }}</td>
                    <td class="border p-2 flex space-x-2">
                        <button wire:click="edit({{ $permission->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Modifier</button>
                        <button wire:click="confirmDelete({{ $permission->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $permissions->links() }}

    @if ($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg w-1/3">
                <h2 class="text-xl font-semibold mb-4">{{ $permissionId ? 'Modifier' : 'Ajouter' }} une permission</h2>
                
                <label class="block mb-2">Nom de la permission :</label>
                <input type="text" wire:model="name" class="w-full p-2 border rounded mb-4">

                <div class="flex justify-end space-x-2">
                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Annuler</button>
                    @if ($permissionId)
                        <button wire:click="update" class="px-4 py-2 bg-blue-500 text-white rounded">Mettre à jour</button>
                    @else
                        <button wire:click="store" class="px-4 py-2 bg-green-500 text-white rounded">Ajouter</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if ($isDeleteModalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Confirmer la suppression</h2>
                <p>Voulez-vous vraiment supprimer cette permission ?</p>
                <div class="flex justify-end space-x-2 mt-4">
                    <button wire:click="$set('isDeleteModalOpen', false)" class="px-4 py-2 bg-gray-500 text-white rounded">Annuler</button>
                    <button wire:click="delete" class="px-4 py-2 bg-red-500 text-white rounded">Supprimer</button>
                </div>
            </div>
        </div>
    @endif
</div>
