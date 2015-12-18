<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Ranking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

session_start();

class HomeController extends Controller
{
    public function index(){
        $disciplinas = Disciplina::all();
        $rankings = $this->rankingActual();

        return view('home',["disciplinas"=>$disciplinas,"rankings"=>$rankings,"disciplina"=>$_SESSION['disciplina']]);
    }

    public function showRanking(){
        $rankings = $this->rankingActual();

        return view('ranking',['rankings'=>$rankings]);

    }

    public function showRankingDisciplina ($id){
        $disciplina = Disciplina::find($id);
        $_SESSION['disciplina'] =$disciplina;
        $rankings = $this->ranking($disciplina->id);
        return view('ranking',['rankings'=>$rankings]);
    }

    public function ranking($disciplina_id){
        $rankings = Ranking::all()->where('disciplina_id',$disciplina_id)->sortByDesc('nota');//->groupBy('nota')->sortByDesc('nota');

        return $rankings;
    }

    public function rankingActual (){
        if(isset($_SESSION['disciplina'])){
            $disciplina = $_SESSION['disciplina'];
            $rankings = $this->ranking($disciplina->id);
        }
        else {
            $disciplina = Disciplina::all()->first();
            $_SESSION['disciplina'] =$disciplina;
            $rankings = $this->ranking($disciplina->id);
        }

        return $rankings;
    }

}
