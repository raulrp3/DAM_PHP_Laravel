<tr>
    <td>{{ $user->id }}</td>
    <td>
        <div>
            <p><strong>{{ $user->name }}.</strong></p>
            <p>{{ $user->profile->profession->title }}</p>
        </div>
    </td>
    <td>
        <div>
            <p>{{ $user->email }}</p>
            <p>{{ $user->skills->implode('name', ',') ?: 'Sin habilidades' }}.</p>
        </div>
    </td>
    <td>{{ $user->role }}</td>
    <td>
        <div>
            <p>Creado: {{ $user->created_at }}.</p>
        </div>
    </td>
    <td>
        <div>
            @if($user->trashed())
                <div class="mt-2 d-flex justify-content-around">
                    <form action="{{ route('users.destroy', $user) }}" method="post" class="mt-2">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    <form action="{{ route('users.restore', $user) }}" method="post" class="mt-2">
                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-info"><i class="fas fa-trash-restore"></i></button>
                    </form>
                </div>
            @else
                <div class="mt-2">
                    <a href="{{ route('users.show', $user) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-dark"><i class="fas fa-pen"></i></a>
                    <form action="{{ route('users.trash', $user) }}" method="post" class="mt-2">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <button type="submit" class="btn btn-danger"><i class="fas fa-user-times"></i></button>
                    </form>
                </div>
            @endif
        </div>
    </td>
</tr>