<tr>
    <td>{{ $user->id }}</td>
    <td>
        <div>
            <p><strong>{{ $user->name }}.</strong></p>
            <p>Profesión: {{ $user->profile->profession->title }}</p>
            <p>Empresa: {{ $user->team->name }}</p>
        </div>
    </td>
    <td>
        <div>
            <p>{{ $user->email }}</p>
            <p>Habilidades: {{ $user->skills->implode('name', ',') ?: 'Sin habilidades' }}.</p>
        </div>
    </td>
    <td>{{ $user->role }}</td>
    <td>
        <div>
            <p>Creado: {{ $user->created_at }}.</p>
        </div>
    </td>
    <td colspan="3">
        <div>
            @if($user->trashed())
                <div class="mt-2">
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="post" class="mt-2">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('users.restore', $user) }}" method="post" class="mt-2">
                            {{ csrf_field() }}

                            <button type="submit" class="btn btn-info"><i class="fas fa-trash-restore"></i></button>
                        </form>
                    </td>
                </div>
            @else
                <div class="mt-2">
                    <td><a href="{{ route('users.show', $user) }}" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
                    <td><a href="{{ route('users.edit', $user) }}" class="btn btn-dark"><i class="fas fa-pen"></i></a></td>
                    <td>
                        <form action="{{ route('users.trash', $user) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <button type="submit" class="btn btn-danger"><i class="fas fa-user-times"></i></button>
                        </form>
                     </td>
                </div>
            @endif
        </div>
    </td>
</tr>