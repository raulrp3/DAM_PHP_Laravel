@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1>{{ $title }}</h1>
        <div class="alert alert-secondary mt-3 mb-5">
            @if($view == 'index')
                <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario</a>
                <a href="{{ route('users.trashed') }}" class="btn btn-danger">Papelera</a>
            @elseif($view == 'trash')
                <a href="{{ route('users') }}" class="btn btn-primary">Volver al listado de usuarios</a>
            @endif
        </div>

        @includeWhen($view == 'index', 'users._filters')

        <table class="table mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Rol</th>
                    <th>Fechas</th>
                    <th colspan="3">
                        <th></th>
                        <th>Acciones</th>
                        <th></th>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @include('users._row', ['user' => $user])
                @endforeach
            </tbody>
        </table>
        {{ $users->appends([request('search')])->render() }}
    </div>
@endsection