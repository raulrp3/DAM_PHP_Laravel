<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Profession;
use App\Models\Skill;

class UserFieldsComposer{
    public function compose(View $view){
        $professions = Profession::orderBy('title', 'ASC')->get();
        $skills = Skill::orderBy('name', 'ASC')->get();
        $roles = ['admin' => 'Administrador.', 'user' => 'Usuario.'];

        $view->with([
            'professions' => $professions,
            'skills' => $skills,
            'roles' => $roles
        ]);
    }
}
