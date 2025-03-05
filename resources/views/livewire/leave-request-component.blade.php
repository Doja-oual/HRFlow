<div>
    <h3>Demande de Conge</h3>

    @if(session()->has('message'))
        <div class="alert alert-info">{{ session('message') }}</div>
    @endif

    <p><strong>Nom de l'employé:</strong> {{ $employee->name }}</p>
    <p><strong>Congés demandés:</strong> {{ $leaveRequest->calculateDaysRequested() }} jours</p>
    <p><strong>Statut:</strong> {{ $leaveRequest->status }}</p>

    <div class="form-group">
        <label for="start_date">Date de debut:</label>
        <input type="date" wire:model="start_date" class="form-control" />
    </div>

    <div class="form-group">
        <label for="end_date">Date de fin:</label>
        <input type="date" wire:model="end_date" class="form-control" />
    </div>

    <button wire:click="calculateLeaveDays" class="btn btn-primary">Calculer les jours demandés</button>
    <button wire:click="calculateLeaveBalance" class="btn btn-secondary">Voir le solde de congés</button>
</div>
