@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1 class="mb-3">Usuario #{{ $user->id }}.</h1>
        <p>Nombre: {{ $user->name }}.</p>
        <p>Correo electrónico: {{ $user->email }}.</p>
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
        </div>
    </div>

@endsection