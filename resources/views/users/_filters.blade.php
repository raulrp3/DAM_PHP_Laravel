<form action="{{ route('users') }}" method="get">
    <div class="row mb-3">
        <div class="col-12">
            @foreach(['' => 'Todos', 'with_team' => 'Con empresa', 'without_team' => 'Sin empresa'] as $value => $text)
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="team" id="team_{{ $value ?: 'all' }}" value="{{ $value }}" {{ $value === request('team', '') ? 'checked' : '' }}>
                    <label for="team_{{ $value ?: 'all' }}" class="form-check-label">{{ $text }}.</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-inline form-search">
                <div class="input-group">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Buscar...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary btn-sm">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>