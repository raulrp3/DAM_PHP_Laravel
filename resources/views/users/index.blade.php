@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1>{{ $title }}</h1>
        <div class="alert alert-secondary my-3">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario <i class="fas fa-user-plus"></i></a>
        </div>
        <ul class="list-group mt-4 mb-4">
            @forelse($users as $user)
                <li class="list-group-item">
                    <p>{{ $user->name }}, ({{ $user->email }})</p>
                    <div class="mt-2">
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info">Ver detalles</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-dark">Modificar</a>
                        <form action="{{ route('users.destroy', $user) }}" method="post" class="mt-2">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No hay usuarios registrados.</li>
            @endforelse
        </ul>
    </div>
@endsection