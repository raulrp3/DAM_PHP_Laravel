@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1>{{ $title }}</h1>
        <div class="alert alert-secondary my-3">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario <i class="fas fa-user-plus"></i></a>
            <a href="{{ route('users.trashed') }}" class="btn btn-danger">Papelera <i class="fas fa-trash"></i></a>
        </div>
        <!--<ul class="list-group mt-4 mb-4">
            @forelse($users as $user)
                <li class="list-group-item">
                    <p>{{ $user->name }}, ({{ $user->email }})</p>
                    @if($user->trashed())
                        <div class="mt-2">
                            <form action="{{ route('users.destroy', $user) }}" method="post" class="mt-2">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <form action="{{ route('users.restore', $user) }}" method="post" class="mt-2">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-info">Restaurar</button>
                            </form>
                        </div>
                    @else
                        <div class="mt-2">
                            <a href="{{ route('users.show', $user) }}" class="btn btn-info"><i class="fas fa-eye"></i> Ver detalles</a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-dark"><i class="fas fa-pen"></i> Modificar</a>
                            <form action="{{ route('users.trash', $user) }}" method="post" class="mt-2">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}

                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                            </form>
                        </div>
                    @endif
                </li>
            @empty
                <li class="list-group-item">No hay usuarios registrados.</li>
            @endforelse
        </ul>-->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Rol</th>
                    <th>Fechas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @include('users._row', ['user' => $user])
                @endforeach
            </tbody>
        </table>
        {{ $users->render() }}
    </div>
@endsection