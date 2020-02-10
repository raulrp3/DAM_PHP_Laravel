@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1>{{ $title }}.</h1>
        <ul class="list-group mt-4 mb-4">
            @forelse($skills as $skill)
                <li class="list-group-item">
                    <p>{{ $skill->name }}</p>
                </li>
            @empty
                <li class="list-group-item">No hay habilidades registradas.</li>
            @endforelse
        </ul>
    </div>
@endsection