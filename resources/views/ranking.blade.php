<?php $active = "ranking"; ?>
@extends('layouts.main')
<?php $disciplinaEscolhida = $_SESSION['disciplina'];
$disciplinas = \App\Disciplina::all();
?>
@section('title')
    FemoengQuiz : Classificação
@stop

@section('body')
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container">
            <div class="well">
                <h3 class="text-center text-info">Classificação Actual: {{$disciplinaEscolhida->nome}} </h3>
                <select class="form-control" id="disciplinas" onchange="seleciona()" >
                    @foreach($disciplinas as $disciplina)
                        @if($disciplina->id == $disciplinaEscolhida->id)
                            <option selected="true" value="{{$disciplina->id}}">{{$disciplina->nome}}</option>
                        @else
                            <option value="{{$disciplina->id}}">{{$disciplina->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="jumbotron">

                <ol>
                    @foreach($rankings as $ranking)
                        <li><strong>{{$ranking->nome_user}}</strong>: {{$ranking->nota}} valores</li>
                    @endforeach
                </ol>
                    @if(count($rankings)<1)
                        <h4 class="text-center">Sem classificação para esta disciplina até o momento</h4>
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
<script>
    function seleciona(){
      var id,lista;
        id = $("#disciplinas").val();
        window.location.assign('/ranking/'+id);
    }
</script>
@stop

