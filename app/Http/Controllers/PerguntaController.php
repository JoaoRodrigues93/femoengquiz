<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Pergunta;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PerguntaController extends Controller
{
    public function index()
    {
        $perguntas = Pergunta::all();
        $disciplinas = Disciplina::all();
        return view('admin.pergunta', ["disciplinas" => $disciplinas,"perguntas"=>$perguntas]);
    }

    public function save(Request $request)
    {
        $questao = $request->input('pergunta');
        $opcaoCorrecta = $request->input('opcaoCorrecta');
        $opcao1 = $request->input('opcao1');
        $opcao2 = $request->input('opcao2');
        $opcao3 = $request->input('opcao3');
        $opcao4 = $request->input('opcao4');
        $opcao5 = $opcaoCorrecta;
        $disciplina_id = $request->input('disciplina_id');

        $pergunta = new Pergunta();
        $pergunta->questao = $questao;
        $pergunta->opcao_correcta = $opcaoCorrecta;
        $pergunta->opcao1 = $opcao1;
        $pergunta->opcao2 = $opcao2;
        $pergunta->opcao3 = $opcao3;
        $pergunta->opcao4 = $opcao4;
        $pergunta->opcao5 = $opcao5;
        $pergunta->disciplina_id = $disciplina_id;
        $pergunta->save();
        $perguntaJSON = json_encode($pergunta);
        return $perguntaJSON;
    }


}
