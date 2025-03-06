@extends('layouts.app')

@section('content')
    <h1>Details de la demande de conge</h1>

    @livewire('leave-request-component', ['leaveRequestId' => $leaveRequest->id])
@endsection
