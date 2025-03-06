<div class="p-6 max-w-lg mx-auto bg-white rounded-lg shadow-lg">
    <h3 class="text-2xl font-semibold mb-4">Faire une demande de congé</h3>

    @if(session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('message') }}</div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger bg-red-100 text-red-800 p-4 rounded mb-4">{{ session('error') }}</div>
    @endif

    <p class="text-lg mb-4"><strong>Nom de l'employé:</strong> {{ $employee_name }}</p> 

    <div class="form-group mb-4">
        <label class="block text-sm font-medium text-gray-700">Date de début</label>
        <input type="date" wire:model="start_date" class="form-control mt-1 p-2 border border-gray-300 rounded w-full">
        @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="form-group mb-4">
        <label class="block text-sm font-medium text-gray-700">Date de fin</label>
        <input type="date" wire:model="end_date" class="form-control mt-1 p-2 border border-gray-300 rounded w-full">
        @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="form-group mb-4">
        <button wire:click="calculateDaysRequested" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">Calculer les jours</button>
        <button wire:click="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Soumettre la demande</button>
    </div>

    @if($days_requested)
        <p class="text-lg mt-4"><strong>Jours demandés :</strong> {{ $days_requested }} jours</p>
    @endif
</div>
