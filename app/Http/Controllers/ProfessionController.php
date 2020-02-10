<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends Controller
{
    public function index(){
        $professions = Profession::withCount('profiles')->orderBy('title', 'ASC')->get();

        return view('professions/index', [
            'professions' => $professions,
            'title' => 'Listado de profesiones'
        ]);
    }

    public function destroy(Profession $profession){
        abort_if($profession->profiles()->exists(), 400, '¡No puedes eliminar esta profesión, está asociada a un perfil de usuario!');

        $profession->delete();

        return redirect()->route('professions');
    }
}
