@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1 class="mb-3">Usuario #{{ $user->id }}.</h1>
        <form action="{{ route('users.edit', $user) }}" method="post">
            {{ method_field('PUT') }}

            @include('users._fields')
            <input type="submit" class="btn btn-success mt-3" value="Modificar usuario">
        </form>
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
        </div>
    </div>

@endsection