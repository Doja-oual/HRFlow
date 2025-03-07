@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex items-center space-x-4">
        <!-- Avatar -->
        <img class="w-24 h-24 rounded-full" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}" alt="Avatar">
        
        <div>
            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="text-gray-500">{{ $user->roles->first()->name ?? 'Aucun rôle' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold">Informations personnelles</h3>
        <p><strong>Téléphone:</strong> {{ $user->phone ?? 'Non défini' }}</p>
        <p><strong>Adresse:</strong> {{ $user->address ?? 'Non définie' }}</p>
        
     
        <p><strong>Département:</strong> {{ $user->department ? $user->department->name : 'Aucun département' }}</p>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold">Évolution de carrière</h3>
        <ul class="list-disc list-inside">
            @forelse($user->careerRecords as $career)
                <li>{{ $career->position }} chez {{ $career->company }} ({{ $career->start_date }} - {{ $career->end_date ?? 'En cours' }})</li>
            @empty
                <li>Aucune expérience enregistrée.</li>
            @endforelse
        </ul>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold">Détails du contrat</h3>
        <p><strong>Type:</strong> {{ $user->contract_type ?? 'Non défini' }}</p>
        <p><strong>Date de début:</strong> {{ $user->hire_date ?? 'Non définie' }}</p>
        <p><strong>Date de fin:</strong> {{ $user->contract_end_date ?? 'Non définie' }}</p>
    </div>
</div>
@endsection
