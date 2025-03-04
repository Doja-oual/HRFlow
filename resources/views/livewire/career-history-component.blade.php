<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Gestion des Historiques de Carrière</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $editId ? 'update' : 'store' }}" class="bg-white shadow-md rounded p-6 mb-6">
        <div class="mb-4">
       
            <label for="user_id" class="block text-sm font-semibold mb-2">Selectionnez un employe</label>
            <select wire:model="user_id" id="user_id" class="w-full border border-gray-300 rounded p-2">
                <option value="">Selectionnez un employe</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="position" class="block text-sm font-semibold mb-2">Poste</label>
                <input type="text" wire:model="position" id="position" class="w-full border border-gray-300 rounded p-2" placeholder="Poste">
            </div>
            <div class="mb-4">
                <label for="department" class="block text-sm font-semibold mb-2">Département</label>
                <input type="text" wire:model="department" id="department" class="w-full border border-gray-300 rounded p-2" placeholder="Département">
            </div>
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-semibold mb-2">Date de début</label>
                <input type="date" wire:model="start_date" id="start_date" class="w-full border border-gray-300 rounded p-2">
            </div>
            <div class="mb-4">
                <label for="end_date" class="block text-sm font-semibold mb-2">Date de fin</label>
                <input type="date" wire:model="end_date" id="end_date" class="w-full border border-gray-300 rounded p-2">
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold mb-2">Description</label>
            <textarea wire:model="description" id="description" class="w-full border border-gray-300 rounded p-2" placeholder="Description"></textarea>
        </div>

        <div class="flex justify-between mt-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600 transition">{{ $editId ? 'Modifier' : 'Ajouter' }}</button>
            <button type="button" wire:click="resetFields" class="bg-gray-300 py-2 px-6 rounded hover:bg-gray-400 transition">Annuler</button>
        </div>
    </form>

    <table class="min-w-full bg-white shadow-md rounded overflow-hidden">
        <thead>
            <tr class="border-b">
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Employé</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Poste</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Début</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Fin</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($careerHistories as $history)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-3 text-sm">{{ $history->user->name }}</td>
                    <td class="px-6 py-3 text-sm">{{ $history->position }}</td>
                    <td class="px-6 py-3 text-sm">{{ $history->start_date }}</td>
                    <td class="px-6 py-3 text-sm">{{ $history->end_date ?? 'Présent' }}</td>
                    <td class="px-6 py-3 text-sm flex space-x-2">
                        <button wire:click="edit({{ $history->id }})" class="bg-yellow-500 text-white py-1 px-4 rounded hover:bg-yellow-600 transition">Modifier</button>
                        <button wire:click="delete({{ $history->id }})" class="bg-red-500 text-white py-1 px-4 rounded hover:bg-red-600 transition">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $careerHistories->links() }}
    </div>
</div>
