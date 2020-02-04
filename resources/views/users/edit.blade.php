@extends('layout')

@section('content')

    @card
        @slot('header', 'Modificar usuario: #'.$user->id.'.')
        @slot('content')
            <form action="{{ route('users.edit', $user) }}" method="post">
                {{ method_field('PUT') }}

                @include('users._fields')
                <input type="submit" class="btn btn-success mt-3" value="Modificar usuario">
            </form>
        @endslot
    @endcard

    <div class="alert alert-secondary mt-5">
        <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
    </div>

@endsection