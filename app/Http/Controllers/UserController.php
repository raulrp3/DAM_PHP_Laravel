<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        if (request()->has('empty')){
            $users = [];
        }else{
            $users = ['Raúl', 'Francisco', 'Juan'];
        }

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
 