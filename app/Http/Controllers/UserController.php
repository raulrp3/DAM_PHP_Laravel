<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request, UserFilter $filters){

        $users = User::query()
        ->with('team', 'skills', 'profile', 'profile.profession')
        ->filterBy($filters, $request->only(['state', 'role', 'search', 'skills']))
        ->orderBy('created_at', 'DESC')
        ->paginate();

        $users->appends($filters->valid());

        return view('users/index', [
            'users' => $users,
            'title' => 'Listado de usuarios',
            'roles' => trans('user.filters.roles'),
            'skills' => Skill::orderBy('name')->get(),
            'states' => trans('user.filters.states'),
            'checkedSkills' => collect(request('skills')),
            'view' => 'index',
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
            'user' => $user,
            'states' => trans('user.states'),
        ]);
    }

    public function edit(User $user){
        return view('users/edit', [
            'user' => $user,
            'states' => trans('user.states'),
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
            'title' => 'Listado de usuario en papelera',
            'view' => 'trash',
        ]);
    }

    public function restore($id){
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();
        $user->restore();

        return redirect()->route('users.trashed');
    }
}
 