<?php $active = "acerca"; ?>

@extends('layouts.main')
@section('title')
    FemoengQuiz : Acerca
@stop
@section('body')
    <div id="acerca" class="container">
    <div class="jumbotron">
        <h1 class="text-center text-primary">FemoengQuiz</h1>
        <p>Foi desenvolvido por: <a target="_blank" href="http://facebook.com/rodrigueslcn">João Rodrigues</a></p>
        <p><strong>Contacto:</strong></p>
        <p>Telefone:<strong> +258825845720</strong></p>
        <p>Email:<strong><a href="mailto:rodrigueslcn@hotmail.com">rodrigueslcn@hotmail.com</a></strong></p>
        <p></p>

        <p class="small"></p><strong>Créditos:</strong> algumas imagens usadas nessa aplicação são propriedade do Grupo
        <a href="http://facebook.com/marrarmoz"><strong>marrar</strong></a></p>
        <p class="text-center">&copy; {{date("Y")}} </p>
    </div>
   </div>
@stop

@section('script')

@stop