<?php $active = "home"; ?>

@extends("layouts.main")
@section("title")
    FemoengQuiz: Exercício Indisponível
@stop

@section("body")
    <div class="container">
        <div class="well">
          <h1 class="text-info">Exercício não disponível</h1>
          <p>Infelizmente o exercício desta disciplina não está disponível.</p>
          <p><a href="/home">Clique aqui</a> para voltar e escolher uma outra disciplina</p>
        </div>
    </div>
@stop

@section("script")

@stop