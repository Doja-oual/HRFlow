<div>
    @if (Auth::check())
        <h3>Demande de congé pour {{ Auth::user()->name }}</h3>
        <p>Solde annuel : {{ $annualBalance }} jours</p>
        <p>Solde récupération : {{ $recoveryBalance }} jours</p>

        <form wire:submit.prevent="submit">
            <div>
                <label>Type de congé</label>
                <select wire:model="type">
                    <option value="Congé annuel">Congé annuel</option>
                    <option value="Récupération">Récupération</option>
                </select>
                @error('type') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Date de début</label>
                <input type="date" wire:model="start_date">
                @error('start_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Date de fin</label>
                <input type="date" wire:model="end_date">
                @error('end_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Jours demandés</label>
                <input type="number" wire:model="total_days" readonly>
            </div>

            <div>
                <label>Raison (optionnelle)</label>
                <textarea wire:model="reason"></textarea>
                @error('reason') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Soumettre</button>
        </form>

        @if (session()->has('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
    @else
        <p>Veuillez vous connecter pour faire une demande.</p>
    @endif
</div>