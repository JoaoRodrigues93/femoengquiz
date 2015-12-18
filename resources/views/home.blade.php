<?php $active = "home"; ?>

<?php

function imgPath($nome)
{
    $nome = str_split($nome);
    $token = $nome[0];
    $path = '';
    switch ($token) {
        case  'á' | 'à' | 'â' | 'ã':
            $path = 'a';
            break;
        case  'ó' | 'ò' | 'ô' | 'õ':
            $path = 'o';
            break;
        case  'é' | 'è' | 'ê':
            $path = 'e';
            break;
        case  'í' | 'ì' | 'î':
            $path = 'i';
            break;
        case  'ú' | 'ù' | 'û':
            $path = 'u';
            break;
        default: {
            $path = $token;
        }
            break;
    }

    return $path;
}
?>

@extends("layouts.main")
@section('title')
    MozQuiz - Pagina Inicial
@stop
@section('body')
    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="well">
                <div class="row">
                    <h2 class="text-center text-danger">Escolha uma disciplina ou área para jogar: </h2>
                    @foreach($disciplinas as $disciplinaActual)
                        <div class="col-md-4 col-lg-4 col-sm-4">
                            <a href="exercicio/{{$disciplinaActual->id}}">
                                <?php $path = imgPath($disciplinaActual->nome);

                                if(!file_exists("img/$path.png"))
                                    $path ='what';
                                ?>
                                <div>
                                    <img class="img-responsive" src="{{URL::asset('img/'.$path.'.png')}}">
                                    <h3 class="text-center">{{$disciplinaActual->nome}}</h3>
                                </div>
                            </a></div>
                    @endforeach

                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="well">
                <h4>Classificação Actual:{{$disciplina->nome}} </h4>
                <ol>
                    @foreach($rankings as $ranking)
                        <li>{{$ranking->nome_user}}</li>
                    @endforeach
                </ol>
            </div>

            <p>Para mais opções de classificação <a href="/ranking">Clique aqui.</a></p>
        </div>
    </div>
@stop

@section('script')

@stop
