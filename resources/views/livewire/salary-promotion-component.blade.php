<div>
    <h3 class="text-lg font-bold mb-3">Ajouter une Promotion / Augmentation</h3>

    @if (session()->has('success'))
        <div class="p-2 bg-green-500 text-white rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="savePromotion" class="space-y-4 bg-white p-4 rounded shadow">
        <div>
            <label for="new_salary" class="block font-medium">Nouveau Salaire</label>
            <input type="number" wire:model="new_salary" class="w-full border rounded p-2">
            @error('new_salary') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="new_job_title" class="block font-medium">Nouveau Poste</label>
            <input type="text" wire:model="new_job_title" class="w-full border rounded p-2">
            @error('new_job_title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="comment" class="block font-medium">Commentaire</label>
            <textarea wire:model="comment" class="w-full border rounded p-2"></textarea>
        </div>

        <div>
            <label for="date_of_change" class="block font-medium">Date de Changement</label>
            <input type="date" wire:model="date_of_change" class="w-full border rounded p-2">
            @error('date_of_change') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>

    <h3 class="text-lg font-bold mt-6 mb-3">Historique des Promotions</h3>

    <table class="w-full border-collapse border border-gray-200 mt-3">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Date</th>
                <th class="border p-2">Nouveau Salaire</th>
                <th class="border p-2">Nouveau Poste</th>
                <th class="border p-2">Commentaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($promotions as $promotion)
                <tr>
                    <td class="border p-2">{{ $promotion->date_of_change->format('d-m-Y') }}</td>
                    <td class="border p-2">{{ number_format($promotion->new_salary, 2) }} €</td>
                    <td class="border p-2">{{ $promotion->new_job_title }}</td>
                    <td class="border p-2">{{ $promotion->comment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
