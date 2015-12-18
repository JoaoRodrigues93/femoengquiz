<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','HomeController@index');
Route::get('/home','HomeController@index');
Route::get('/disciplina','DisciplinaController@index');
Route::post('/disciplina/save', 'DisciplinaController@save');
Route::get('/pergunta', 'PerguntaController@index');
Route::post('/pergunta/save','PerguntaController@save');
Route::get('/exercicio/valida','ExercicioController@valida');
Route::post('/exercicio/progresso','ExercicioController@guardaProgresso');
Route::get('/exercicio/{id}','ExercicioController@index');
Route::get("/acerca",function(){
    return view('acerca');
});

Route::get('/ranking','HomeController@showRanking');
Route::get('/ranking/{id}','HomeController@showRankingDisciplina');