<?php
namespace App;

class GestorPergunta
{
    public function perguntas()
    {
        $disciplina = $_SESSION['disciplina'];
        $perguntas = $disciplina->perguntas()->getResults();

        foreach($perguntas as $pergunta){
            $pergunta = $this->opcaoAleatorio($pergunta);
        }

        $perguntas = $perguntas->shuffle();
        return $perguntas;
    }

    public function perguntaPergunta($id)
    {

    }




    public function opcaoAleatorio($pergunta)
    {
        $i = rand(1, 5);

        $opcao1 = $pergunta->opcao1;
        $opcao2 = $pergunta->opcao2;
        $opcao3 = $pergunta->opcao3;
        $opcao4 = $pergunta->opcao4;
        $opcao5 = $pergunta->opcao5;

        switch ($i) {
            case 1:
                $pergunta->opcao1 = $opcao1;
                $pergunta->opcao2 = $opcao2;
                $pergunta->opcao3 = $opcao3;
                $pergunta->opcao4 = $opcao4;
                $pergunta->opcao5 = $opcao5;
                break;
            case 2:
                $pergunta->opcao1 = $opcao2;
                $pergunta->opcao2 = $opcao3;
                $pergunta->opcao3 = $opcao4;
                $pergunta->opcao4 = $opcao5;
                $pergunta->opcao5 = $opcao1;
                break;
            case 3:
                $pergunta->opcao1 = $opcao3;
                $pergunta->opcao2 = $opcao4;
                $pergunta->opcao3 = $opcao5;
                $pergunta->opcao4 = $opcao2;
                $pergunta->opcao5 = $opcao1;
                break;
            case 4:
                $pergunta->opcao1 = $opcao4;
                $pergunta->opcao2 = $opcao5;
                $pergunta->opcao3 = $opcao1;
                $pergunta->opcao4 = $opcao2;
                $pergunta->opcao5 = $opcao3;
                break;
            case 5:
                $pergunta->opcao1 = $opcao5;
                $pergunta->opcao2 = $opcao1;
                $pergunta->opcao3 = $opcao2;
                $pergunta->opcao4 = $opcao3;
                $pergunta->opcao5 = $opcao4;
                break;
        }
        return $pergunta;
    }
}