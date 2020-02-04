@extends('layout')

@section('content')

    <div class="container mt-5">
        <form action="{{ route('users.create') }}" method="post" class="my-5">
            @include('users._fields')
            <input type="submit" class="btn btn-success mt-3" value="Crear usuario">
        </form>
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
        </div>
    </div>

@endsection