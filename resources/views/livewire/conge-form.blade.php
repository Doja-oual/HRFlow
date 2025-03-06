<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    @if (Auth::check())
        <h3 class="text-xl font-semibold mb-4">Demande de conge pour {{ Auth::user()->name }}</h3>
        <p class="text-gray-700">Solde annuel : <span class="font-medium">{{ $annualBalance }}</span> jours</p>
        <p class="text-gray-700 mb-4">Solde récupération : <span class="font-medium">{{ $recoveryBalance }}</span> jours</p>

        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Type de conge</label>
                <select wire:model="type" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Congé annuel">Congé annuel</option>
                    <option value="Récupération">Récupération</option>
                </select>
                @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date de début</label>
                <input type="date" wire:model="start_date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date de fin</label>
                <input type="date" wire:model="end_date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jours demandés</label>
                <input type="number" wire:model="" readonly class="w-full border-gray-300 rounded-md bg-gray-100 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Raison (optionnelle)</label>
                <textarea wire:model="reason" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                @error('reason') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-medium py-2 rounded-md hover:bg-indigo-700 transition">
                Soumettre
            </button>
        </form>

        @if (session()->has('success'))
            <div class="mt-4 p-2 bg-green-100 text-green-700 border border-green-400 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mt-4 p-2 bg-red-100 text-red-700 border border-red-400 rounded-md">
                {{ session('error') }}
            </div>
        @endif
    @else
        <p class="text-center text-red-500 font-medium">Veuillez vous connecter pour faire une demande.</p>
    @endif
</div>
