<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return 'Usuarios';
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
