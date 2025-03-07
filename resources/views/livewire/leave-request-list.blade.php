<div>
    <h3 class="text-2xl font-semibold mb-4">Liste des demandes de congé</h3>

    <table class="min-w-full table-auto bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
            <tr class="bg-gray-100 text-gray-700">
                <th class="px-6 py-3 text-left">Nom de l'employé</th>
                <th class="px-6 py-3 text-left">Date de début</th>
                <th class="px-6 py-3 text-left">Date de fin</th>
                <th class="px-6 py-3 text-left">Jours demandés</th>
                <th class="px-6 py-3 text-left">Statut</th>
                @hasrole('RH|manager')
                <th class="px-6 py-3 text-left">Actions</th>
                @endhasrole
            </tr>
        </thead>
        <tbody>
            @foreach($leaveRequests as $leaveRequest)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $leaveRequest->user ? $leaveRequest->user->name : 'Utilisateur non trouvé' }}</td>
                    <td class="px-6 py-4">{{ $leaveRequest->start_date }}</td>
                    <td class="px-6 py-4">{{ $leaveRequest->end_date }}</td>
                    <td class="px-6 py-4">{{ $leaveRequest->days_requested }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 rounded-full text-white bg-{{ $leaveRequest->status == 'pending' ? 'yellow' : ($leaveRequest->status == 'approved' ? 'green' : 'red') }}-500">
                            {{ ucfirst($leaveRequest->status) }}
                        </span>
                    </td>
                    @hasrole('RH|manager')
                    <td class="px-6 py-4 space-x-2">
                        <button wire:click="updateStatus({{ $leaveRequest->id }})" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none">
                       Accepte congé
  
                    </button>
                    </td>
                    @endhasrole
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
