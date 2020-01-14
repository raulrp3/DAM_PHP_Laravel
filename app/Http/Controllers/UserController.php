<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = [
            'Raúl',
            'Francisco',
            'Juan'
        ];

        return view('users', [
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]);
    }

    public function show($id){
        return "Usuario: {$id}";
    }

    public function create(){
        return 'Nuevo usuario';
    }

    public function edit($id){
        return "Editando al usuario: {$id}";
    }
}
 