@extends('layout')

@section('content')

    <div class="container mt-5">
        <form action="{{ route('users.create') }}" method="post" class="my-5">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="inputName">Nombre:</label>
                <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
                @endif   
            </div>
            <div class="form-group">
                <label for="inputEmail">Correo elctrónico:</label>
                <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                @endif 
            </div>
            <div class="form-group">
                <label for="inputPass">Contraseña:</label>
                <input type="password" class="form-control" id="inputPass" name="password">
                @if($errors->has('password'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('password') }}</div>
                @endif 
            </div>
            <input type="submit" class="btn btn-success mt-3" value="Crear usuario">
        </form>
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
        </div>
    </div>

@endsection