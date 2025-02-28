<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">Gestion des Formations</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $editing ? 'update' : 'store' }}">
        <div class="grid grid-cols-2 gap-4">
            <input wire:model="title" type="text" placeholder="Titre de la formation" class="border p-2 rounded">
            <input wire:model="institution" type="text" placeholder="Institution" class="border p-2 rounded">
            <input wire:model="start_date" type="date" class="border p-2 rounded">
            <input wire:model="end_date" type="date" class="border p-2 rounded">
            <select wire:model="status" class="border p-2 rounded">
                <option value="planned">Planifiée</option>
                <option value="ongoing">En cours</option>
                <option value="completed">Terminée</option>
            </select>
            <input wire:model="certificate" type="file" class="border p-2 rounded">
        </div>
        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
            {{ $editing ? 'Mettre à jour' : 'Ajouter' }}
        </button>
    </form>

    <table class="mt-6 w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Titre</th>
                <th class="border p-2">Institution</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainings as $training)
                <tr>
                    <td class="border p-2">{{ $training->title }}</td>
                    <td class="border p-2">{{ $training->institution }}</td>
                    <td class="border p-2">{{ ucfirst($training->status) }}</td>
                    <td class="border p-2">
                        <button wire:click="edit({{ $training->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">✏️</button>
                        <button wire:click="delete({{ $training->id }})" class="bg-red-500 text-white px-2 py-1 rounded">🗑️</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $trainings->links() }}</div>
</div>
