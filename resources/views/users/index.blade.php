@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1>{{ $title }}</h1>
        <div class="alert alert-secondary my-3">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario <i class="fas fa-user-plus"></i></a>
        </div>
        <ul class="list-group mt-4">
            @forelse($users as $user)
                <li class="list-group-item">
                    <p>{{ $user }}</p>
                    <div class="mt-2">
                        <a href="{{ route('users.show', 5) }}" class="btn btn-info">Mostrar</a>
                        <a href="{{ route('users.edit', 5) }}" class="btn btn-dark">Modificar</a>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No hay usuarios registrados.</li>
            @endforelse
        </ul>
    </div>
@endsection