<?php $admin=true;?>
<?php $active = "pergunta"; ?>
@extends('layouts.admin')
@section('title')
Perguntas
@stop
@section('body')
<div class="container">
    <h2>Registe as perguntas para a disciplina pretendida</h2>
    <div id="confirmacao"></div>
    <div>
        <div class="form-group">
            <label for="lista">Lista de Disciplinas:</label>
            <select class="form-control" id="lista">
                <option>Escolhe uma disciplina</option>
                @foreach($disciplinas as $disciplina)
                <option value="{{$disciplina->id}}">{{$disciplina->nome}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <div role="form" >
            <div class="form-group">
            <label for="pergunta">Escreva a pergunta:</label>
            <input type="text" class="form-control" name="pergunta" id="pergunta" placeholder="escreva a pergunta aqui">
            </div>
            <div class="form-group">
                <label for="opcaoCorrecta">Escreva a opção correcta:</label>
                <input type="text" class="form-control" name="opcaoCorrecta" id="opcaoCorrecta" placeholder="escreva a opcão correcta">
            </div>
            <div class="form-group">
                <label for="opcao1">Escreva as opções erradas abaixo:</label>
                <input type="text" class="form-control" name=opcao1" id="opcao1" placeholder="escreva a primeira opção errada">
                <input type="text" class="form-control" name=opcao2" id="opcao2" placeholder="escreva a segunda opção errada">
                <input type="text" class="form-control" name=opcao3" id="opcao3" placeholder="escreva a terceira opção errada">
                <input type="text" class="form-control" name=opcao4" id="opcao4" placeholder="escreva a quarta opção errada">
            </div>
            <button class="btn btn-success" id="guardar" type="button">Guardar</button>
        </div>
    </div>
    <div>
     <h3>Perguntas existentes:</h3>
        <table  class="table table-hover">
            <thead>
            <tr>
                <th>Identificador</th>
                <th>Questão</th>
                <th>Opcão Correcta</th>
                <th>Primeira Opção Errada</th>
                <th>Segunda Opção Errada</th>
                <th>Terceira Opção Errada</th>
                <th>Quarta Opção Errada</th>
                <th>Acções</th>
            </tr>
            </thead>
            <tbody id="tabelaCorpo">
                @foreach($perguntas as $pergunta)
                    <tr>
                    <td>{{$pergunta->id}}</td>
                    <td>{{$pergunta->questao}}</td>
                    <td>{{$pergunta->opcao_correcta}}</td>
                    <td>{{$pergunta->opcao1}}</td>
                    <td>{{$pergunta->opcao2}}</td>
                    <td>{{$pergunta->opcao3}}</td>
                    <td>{{$pergunta->opcao4}}</td>
                    <td><a id="editar{{$pergunta->id}}" href='#'>Editar</a> | <a id="remover{{$pergunta->id}}" href='#'>Remover</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
@section('script')
<script>

    function guardarDados() {
        var pergunta,opcao1,opcao2,opcao3,opcao4,opcaoCorrecta,dados,disciplina_id,url;
        pergunta = $("#pergunta").val();
        opcaoCorrecta = $('#opcaoCorrecta').val();
        opcao1 = $('#opcao1').val();
        opcao2 = $('#opcao2').val();
        opcao3 = $('#opcao3').val();
        opcao4 = $('#opcao4').val();
        disciplina_id = $('#lista').val();

        dados = {
            pergunta:pergunta,
            opcaoCorrecta:opcaoCorrecta,
            opcao1:opcao1,
            opcao2:opcao2,
            opcao3:opcao3,
            opcao4:opcao4,
            disciplina_id:disciplina_id
        };

       url = '/pergunta/save';

        $.post(url,dados,function(data,status){visualizaDado(data,status)});
    }

    function visualizaDado(data,status){
        var pergunta,corpo,linha;
        pergunta = JSON.parse(data);
        linha = "<tr>" +
        "<td>"+pergunta.id+"</td>" +
        "<td>"+pergunta.questao+"</td>" +
        "<td>"+pergunta.opcao_correcta+"</td>" +
        "<td>"+pergunta.opcao1+"</td>" +
        "<td>"+pergunta.opcao2+"</td>" +
        "<td>"+pergunta.opcao3+"</td>" +
        "<td>"+pergunta.opcao4+"</td>" +
        "<td><a id='editar"+pergunta.id+"' href='#'>Editar</a> | <a id='remover"+pergunta.id+"' href='#'>Remover</a></td>" +
        "</tr>";

        corpo = $('#tabelaCorpo').html();
        corpo = corpo+" "+linha;
        $('#tabelaCorpo').html(corpo);
    }

    $(document).ready( function() {
                $('#guardar').click(function(){
                    guardarDados();
                });
            });
</script>
@stop

