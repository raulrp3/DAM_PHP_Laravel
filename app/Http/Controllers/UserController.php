<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profession;
use App\Models\UserProfile;
use App\Models\Skill;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    public function index(){

        $users = User::all();

        return view('users/index', [
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]);
    }

    public function show(User $user){
        return view('users/show', [
            'user' => $user
        ]);
    }

    public function create(){
        $user = new User;

        return view('users/create', [
            'user' => $user
        ]);
    }

    public function edit(User $user){
        return view('users/edit', [
            'user' => $user,
        ]);
    }

    public function store(CreateUserRequest $request){
        $request->createUser();

        return redirect()->route('users');
    }

    public function update(User $user){
        $data = request()->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'min:6'],
            'role' => '',
            'profession' => '',
            'bio' => '',
            'twitter' => '',
            'skills' => '',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo  nombre debe tener más de 2 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.unique' => 'El campo correo electrónico ya pertenece a otro usuario.',
            'email.email' => 'El campo correo electrónico no es válido.',
            'password.min' => 'El campo contraseña debe tener más de 6 caracteres.'
        ]);

        if($data['password'] != null){
            $data['password'] = bcrypt($data['password']);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'],
            ]);
        }else{
            unset($data['password']);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
            ]);
        }

        $user->profile()->update([
            'bio' => $data['bio'],
            'twitter' => $data['twitter'],
            'profession_id' => $data['profession']
        ]);

        $user->skills()->sync($data['skills'] ?? []);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroy(User $user){
        $user->delete();

        return redirect()->route('users');
    }
}
 