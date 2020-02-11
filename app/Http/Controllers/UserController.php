<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profession;
use App\Models\UserProfile;
use App\Models\Skill;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(){

        $users = User::with('team', 'skills', 'profile')->search()->orderBy('created_at', 'DESC')->paginate();

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

    public function update(UpdateUserRequest $request, User $user){
        $request->updateUser($user);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroy($id){
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();
        $user->forceDelete();

        return redirect()->route('users.trashed');
    }

    public function trash(User $user){
        $user->delete();
        $user->profile()->delete();

        return redirect()->route('users');
    }

    public function trashed(){
        $users = User::onlyTrashed()->paginate();

        return view('users/index', [
            'users' => $users,
            'title' => 'Listado de usuario en papelera'
        ]);
    }

    public function restore($id){
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();
        $user->restore();

        return redirect()->route('users.trashed');
    }
}
 