@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1>Nuevo usuario</h1>
        <div class="alert alert-secondary mt-5">
            <a href="{{ route('users') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </div>

@endsection