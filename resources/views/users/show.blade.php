@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1 class="mb-3">Usuario #{{ $user->id }}.</h1>
        <p>Nombre: {{ $user->name }}.</p>
        <p>Correo electrónico: {{ $user->email }}.</p>
        @if($user->profession != null)
            <p>Profesión: {{ $user->profession->title }}.</p>
        @endif
        @if($user->is_admin == 1)
            <p>Tipo de usuario: Administrador.</p>
        @else
            <p>Tipo de usuario: Usuario.</p>
        @endif
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
        </div>
    </div>

@endsection