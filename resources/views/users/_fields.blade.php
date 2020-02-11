{{ csrf_field() }}

<div class="form-group">
    <label for="inputName">Nombre:</label>
    <input type="text" class="form-control" id="inputName" name="first_name" value="{{ old('first_name', $user->first_name) }}">
    @if($errors->has('first_name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('first_name') }}</div>
    @endif   
</div>
<div class="form-group">
    <label for="inputLastName">Primer apellido:</label>
    <input type="text" class="form-control" id="inputLastName" name="last_name" value="{{ old('last_name', $user->last_name) }}">
    @if($errors->has('last_name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('last_name') }}</div>
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
    @if($errors->has('password'))
        <div class="alert alert-danger mt-2">{{ $errors->first('password') }}</div>
    @endif 
</div>
<div class="form-group">
    <label for="inputBio">Bio:</label>
    <textarea name="bio" id="inputBio" class="form-control">{{ old('bio', $user->profile->bio) }}</textarea>
    @if($errors->has('bio'))
        <div class="alert alert-danger mt-2">{{ $errors->first('bio') }}</div>
    @endif 
</div>
<div class="form-group">
    <label for="inputTwitter">Nombre de usuario de twitter:</label>
    <input type="text" class="form-control" id="inputTwitter" name="twitter" value="{{ old('twitter', $user->profile->twitter) }}">
    @if($errors->has('twitter'))
        <div class="alert alert-danger mt-2">{{ $errors->first('twitter') }}</div>
    @endif 
</div>
<div class="form-group">
    <h5>Rol</h5>
    @foreach($roles as $role => $name)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="role_{{ $role }}" value="{{ $role }}" {{ old('role', $user->role) == $role ? 'checked' : '' }}>
            <label class="form-check-label" for="role_{{ $role }}">{{ $name }}</label>
        </div>
    @endforeach
    @if($errors->has('role'))
        <div class="alert alert-danger mt-2">{{ $errors->first('role') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="professions">Profesión:</label>
    <select name="profession" id="professions" class="form-control">
        <option value="">Selecciona una profesión.</option>
        @foreach($professions as $profession)
            <option value="{{ $profession->id }}" {{ old('profession', $user->profile->profession_id) == $profession->id ? 'selected' : '' }}>
                {{ $profession->title }}
            </option>
        @endforeach
    </select>
    @if($errors->has('profession'))
        <div class="alert alert-danger mt-2">{{ $errors->first('profession') }}</div>
    @endif
</div>
<div class="form-group mt-4">
    <h5>Habilidades</h5>
    @foreach($skills as $skill)
        <div class="form-check form-check-inline">
            <input name ="skills[{{ $skill->id }}]" class="form-check-input" type="checkbox" id="skill_{{ $skill->id }}" value="{{ $skill->id }}" {{ $errors->any() ? old("skills.{$skill->id}") : $user->skills->contains($skill) ? 'checked' : '' }}>
            <label class="form-check-label" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
        </div>
    @endforeach
</div>