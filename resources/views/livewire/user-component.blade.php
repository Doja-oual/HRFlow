<div>
   
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ajouter Utilisateur</button>

   
    <input type="text" wire:model="searchTerm" placeholder="Rechercher..." class="border p-2 rounded-md w-full mt-2">

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Rôle</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border">
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">{{ $user->role }}</td>
                        <td class="p-2">
                            <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                            <button wire:click="confirmDelete({{ $user->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }} 
    </div>

    @if ($isOpen)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-4">
                <h2 class="text-xl font-bold">{{ $userId ? 'Modifier Utilisateur' : 'Ajouter Utilisateur' }}</h2>

                <div class="overflow-y-auto max-h-[80vh] p-4"> 
                    <label class="block">Nom:</label>
                    <input type="text" wire:model="name" class="w-full border p-2 rounded">

                    <label class="block mt-2">Email:</label>
                    <input type="email" wire:model="email" class="w-full border p-2 rounded">

                    <label class="block mt-2">Mot de passe:</label>
                    <input type="password" wire:model="password" class="w-full border p-2 rounded">

                    <label class="block mt-2">Rôle:</label>
                    <input type="text" wire:model="role" class="w-full border p-2 rounded">

                    <label class="block mt-2">Téléphone:</label>
                    <input type="text" wire:model="phone" class="w-full border p-2 rounded">

                    <label class="block mt-2">Adresse:</label>
                    <input type="text" wire:model="address" class="w-full border p-2 rounded">

                    <label class="block mt-2">Date de Naissance:</label>
                    <input type="date" wire:model="date_of_birth" class="w-full border p-2 rounded">

                    <label class="block mt-2">Genre:</label>
                    <select wire:model="gender" class="w-full border p-2 rounded">
                        <option value="">Sélectionner</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>

                    <label class="block mt-2">Photo de Profil:</label>
                    <input type="file" wire:model="profile_picture" class="w-full border p-2 rounded">
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</button>
                    <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded">{{ $userId ? 'Modifier' : 'Ajouter' }}</button>
                </div>
            </div>
        </div>
    @endif

    
    @if ($isDeleteModalOpen)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold">Confirmer la suppression</h2>
                <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                <div class="flex justify-end gap-2 mt-4">
                    <button wire:click="$set('isDeleteModalOpen', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</button>
                    <button wire:click="delete" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
                </div>
            </div>
        </div>
    @endif
</div>
