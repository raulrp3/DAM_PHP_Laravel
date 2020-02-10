@extends('layout')

@section('content')

    <div class="container mt-5">
        <h1>{{ $title }}.</h1>
        <ul class="list-group mt-4 mb-4">
            @forelse($professions as $profession)
                <li class="list-group-item">
                    <p>{{ $profession->title }}</p>
                    @if($profession->profiles_count == 0)
                        <form action="{{ route('professions.destroy', $profession) }}" method="post" class="mt-2">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                        </form>
                    @endif
                </li>
            @empty
                <li class="list-group-item">No hay profesiones registradas.</li>
            @endforelse
        </ul>
    </div>
@endsection