<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Gestion des Historiques de Carrière</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $editId ? 'update' : 'store' }}" class="bg-white shadow-md rounded p-6 mb-6">
        <div class="mb-4">
            <label for="user_id" class="block text-sm font-semibold mb-2">Sélectionnez un employé</label>
            <select wire:model="user_id" id="user_id" class="w-full border border-gray-300 rounded p-2">
                <option value="">Sélectionnez un employé</option>
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
                <select wire:model="department_id" id="department_id" class="w-full border border-gray-300 rounded p-2">
                    <option value="">Sélectionnez un département</option> 
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
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

    <!-- Timeline des Historiques de Carrière -->
    <div class="mt-6 space-y-6">
        @foreach ($careerHistories as $history)
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center">
                        <span class="font-semibold text-lg">{{ substr($history->user->name, 0, 1) }}</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold">{{ $history->user->name }}</h3>
                        <p class="text-sm text-gray-500">Poste : {{ $history->position }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-center">
                        <div class="bg-blue-500 text-white text-sm px-3 py-1 rounded-full">{{ $history->start_date }}</div>
                        <p class="text-sm mt-2">Date de début</p>
                    </div>
                    <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
                    <div class="text-center">
                        <div class="bg-blue-300 text-white text-sm px-3 py-1 rounded-full">{{ $history->end_date ?? 'Présent' }}</div>
                        <p class="text-sm mt-2">Date de fin</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-gray-600"><strong>Description : </strong>{{ $history->description }}</p>
                </div>

                <div class="mt-4 flex space-x-4">
                    <button wire:click="edit({{ $history->id }})" class="bg-yellow-500 text-white py-1 px-4 rounded hover:bg-yellow-600 transition">Modifier</button>
                    <button wire:click="delete({{ $history->id }})" class="bg-red-500 text-white py-1 px-4 rounded hover:bg-red-600 transition">Supprimer</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $careerHistories->links() }}
    </div>
</div>
