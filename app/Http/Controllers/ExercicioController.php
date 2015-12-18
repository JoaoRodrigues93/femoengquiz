<?php

namespace App\Http\Controllers;

session_start();

use App\Disciplina;
use App\Exercicio;
use App\GestorPergunta;
use App\Pergunta;
use App\Ranking;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class ExercicioController extends Controller
{

    public function index($id)
    {
        $disciplina = Disciplina::find($id);
        $_SESSION['disciplina'] = $disciplina;
        $gestorPergunta = new GestorPergunta();
        $perguntas = $gestorPergunta->perguntas();
        if(count($perguntas)>10)
        $perguntas = $perguntas->slice(1,10);
        $nrPerguntas = count($perguntas);
        if($nrPerguntas <1 ){
            return view("exameIndisponivel");
        }
        $_SESSION['perguntas'] = $perguntas;
        return view('exercicio', ["perguntas" => $perguntas, "nrPerguntas" => $nrPerguntas]);
    }

    public function valida(Request $request)
    {
        $id = $request->input('id');
        $respostaEscolhida = $request->input('respostaEscolhida');
        $pergunta = Pergunta::find($id);
        $valida = false;
        $respostaCorrecta = $pergunta->opcao_correcta;

        if ($respostaCorrecta == $respostaEscolhida) {
            $valida = true;
        }

        $dadosResposta = [$valida, $respostaCorrecta];
        $dadosResposta = json_encode($dadosResposta);
        return $dadosResposta;
    }

    public function guardaProgresso(Request $request)
    {

        $disciplina = $_SESSION['disciplina'];
        $nome = $request->input('nome');
        $nota = $request->input('nota');
        $nrRespostasCertas = $request->input('nrRespostasCertas');
        $nrRespostasErradas = $request->input('nrRespostasErradas');

        //Caso aconteça um erro nesse código
        $valido = true;
        $erroMensagem = "";

        //formatação de data
        $dateTime = getdate();
        $dia = $dateTime['mday'];
        $mes = $dateTime['mon'];
        $ano = $dateTime['year'];

        $dia = ($dia > 9) ? $dia : "0" . $dia;
        $mes = ($mes > 9) ? $mes : "0" . $mes;

        $dataRealizacao = $ano . "-" . $mes . "-" . $dia;

        $user = User::firstOrCreate(['name' => $nome]);

        $exercicio = new Exercicio();
        $exercicio->nota = $nota;
        $exercicio->respostas_certas = $nrRespostasCertas;
        $exercicio->respostas_erradas = $nrRespostasErradas;
        $exercicio->data_realizacao = $dataRealizacao;
        $exercicio->user_id = $user->id;
        $exercicio->disciplina_id = $disciplina->id;
        $exercicio->save();
        $ranking = Ranking::all()->where('user_id', $user->id)->where('disciplina_id', $disciplina->id)->first();

        if ($ranking) {
            $ranking->nota = $nota;
            $ranking->save();
        } else {
            $ranking = new Ranking();
            $ranking->nome_user = $nome;
            $ranking->nome_disciplina = $disciplina->nome;
            $ranking->nota = $nota;
            $ranking->dia_realizacao = $dataRealizacao;
            $ranking->user_id = $user->id;
            $ranking->disciplina_id = $disciplina->id;
            $ranking->save();
        }

        $dadosResposta = [$nome, $valido, $erroMensagem];
        $dadosResposta = json_encode($dadosResposta);

        return $dadosResposta;
    }
}
