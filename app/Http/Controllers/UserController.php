<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){

        $users = User::all();

        return view('users/index', [
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]);
    }

    public function show($id){
        return view('users/show', [
            'id' => $id
        ]);
    }

    public function create(){
        return view('users/create');
    }

    public function edit($id){
        return view('users/edit', [
            'id' => $id
        ]);
    }
}
 