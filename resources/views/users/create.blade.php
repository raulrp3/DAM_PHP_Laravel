@extends('layout')

@section('content')

    @card
        @slot('header', 'Nuevo usuario.')
        @slot('content')
            <form action="{{ route('users.create') }}" method="post" class="my-5">
                @include('users._fields')
                <div class="form-group mt-4">
                    <input type="submit" class="btn btn-success mt-3" value="Crear usuario">
                </div>
            </form>
        @endslot
    @endcard
        
    <div class="alert alert-secondary mt-5">
        <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
    </div>

@endsection