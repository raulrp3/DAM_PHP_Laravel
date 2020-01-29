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
            <div class="form-group">
                <label for="inputBio">Bio:</label>
                <textarea name="bio" id="inputBio" class="form-control">{{ old('bio') }}</textarea>
                @if($errors->has('bio'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('bio') }}</div>
                @endif 
            </div>
            <div class="form-group">
                <label for="inputTwitter">Nombre de usuario de twitter:</label>
                <input type="text" class="form-control" id="inputTwitter" name="twitter" value="{{ old('twitter') }}">
                @if($errors->has('twitter'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('twitter') }}</div>
                @endif 
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
                @if($errors->has('type'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('type') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="professions">Profesión:</label>
                <select name="profession" id="professions" class="form-control">
                    <option value="">Selecciona una profesión.</option>
                    @foreach($professions as $profession)
                        <option value="{{ $profession->id }}" {{ old('profession') == $profession->id ? 'selected' : '' }}>
                            {{ $profession->title }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('profession'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('profession') }}</div>
                @endif
            </div>
            <input type="submit" class="btn btn-success mt-3" value="Crear usuario">
        </form>
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al listado de usuarios</a>
        </div>
    </div>

@endsection