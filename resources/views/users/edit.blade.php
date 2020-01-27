@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1 class="mb-3">Usuario #{{ $user->id }}.</h1>
        <form action="{{ route('users.edit', $user) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="inputName">Nombre:</label>
                <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $user->name) }}">
                @if($errors->has('name'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
                @endif  
            </div>
            <div class="form-group">
                <label for="inputEmail">Correo elctrónico:</label>
                <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email', $user->email) }}">
                @if($errors->has('email'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="inputPass">Contraseña:</label>
                <input type="password" class="form-control" id="inputPass" name="password">
            </div>
            <div class="form-group">
                <p>¿Es un usuario administrador?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="radioNo" value="false" checked>
                    <label class="form-check-label" for="radioNo">No.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="radioYes" value="true">
                    <label class="form-check-label" for="radioYes">Sí.</label>
                </div>
            </div>
            <div class="form-group">
                <label for="professions">Profesión:</label>
                <select name="profession" id="professions" class="form-control">
                    @foreach($professions as $profession)
                        <option value="{{ $profession->id }}">{{ $profession->title }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-success mt-3" value="Modificar usuario">
        </form>
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
        </div>
    </div>

@endsection