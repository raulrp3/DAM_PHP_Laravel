<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index(){
        $skills = Skill::orderBy('name', 'ASC')->get();

        return view('skills/index', [
            'skills' => $skills,
            'title' => 'Listado de habilidades'
        ]);
    }
}
