<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DisciplinaController extends Controller
{
    public function index (){
        $disciplinas = Disciplina::all();
        $disciplinasJson = json_encode($disciplinas);

        return view('admin.disciplina',["disciplinas"=>$disciplinas]);
    }

    public function save(Request $request){
        $nomeDisciplina = $request->input('nome');
        $disciplina = new Disciplina();
        $disciplina->nome=$nomeDisciplina;
        $disciplina->save();
        $response = '{"id":"'.$disciplina->id.'", "nome":"'.$disciplina->nome.'"}';

        return $response;
    }
}
