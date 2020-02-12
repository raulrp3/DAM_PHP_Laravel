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
        <div class="col-12 mt-3">
            @foreach($states as $value => $text)
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="state" id="state_{{ $value ?: 'all' }}" value="{{ $value }}" {{ $value === request('state', '') ? 'checked' : '' }}>
                    <label for="state_{{ $value ?: 'all' }}" class="form-check-label">{{ $text }}.</label>
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
                <div class="btn-group  ml-4">
                    <select name="role" id="role" class="form-control form-control-sm">
                        @foreach ($roles as $value => $text)
                            <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : ''}}>{{ $text }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-4"> 
                    @foreach($skills as $skill)
                        <div class="form-check form-check-inline">
                            <input name ="skills[]" class="form-check-input" type="checkbox" id="skill_{{ $skill->id }}" value="{{ $skill->id }}" {{ $checkedSkills->contains($skill->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>