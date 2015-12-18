<?php $admin = true;
    $active = "disciplina";
?>

@extends('layouts.admin')
@section('title')
    Disciplinas
@stop
@section('body')
    <div class="container">
        <h2>Registe as disciplinas aqui</h2>

        <div id="confirmacao" class="">
        </div>

        <div>
            <div class="form-group">
                <input type="text" class="form-control" name="nomeDisciplina" id="nomeDisciplina"
                       placeholder="escreva o nome da disciplina. Ex: Matemática" required="true">
                <br>
                <button type="button" class="btn btn-success" id="guardar">Guardar</button>
            </div>
        </div>

        <div>

            <div>
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>identificador</th>
                            <th>Disciplina</th>
                            <th>Acções</th>
                        </tr>
                        </thead>
                        <tbody id="tabelaCorpo">
                        @foreach($disciplinas as $discplina)
                            <tr>
                                <td>{{$discplina->id}}</td>
                                <td>{{$discplina->nome}}</td>
                                <td><a id="editar{{$discplina->id}}" href="#">Editar</a> |
                                    <a id="remover{{$discplina->id}}" href="#">Remover</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script>

        function guardarDados() {
            var nomeDisciplina, url, dados;
            url = '/disciplina/save';
            nomeDisciplina = $("#nomeDisciplina").val();
            dados = {nome: nomeDisciplina};
            $.post(url, dados, function (data, status) {
                visualizaDado(data, status)
            });
        }

        function visualizaDado(data, status) {
            var nome, id, linha, corpo, disciplina, txtHtml;
            disciplina = JSON.parse(data);
            nome = disciplina.nome;
            id = disciplina.id;
            linha = "<tr>" +
            "<td>" + id + "</td>" +
            "<td>" + nome + "</td>" +
            "<td>" + "<a id='editar" + disciplina.id + "' href='#' >Editar</a> | " +
            "<a id='remover" + disciplina.id + "' href='#'>Remover</a>" + "</td>" +
            "</tr>";

            txtHtml = $('#tabelaCorpo').html();
            txtHtml = txtHtml + "  " + linha;
            $('#tabelaCorpo').html(txtHtml);

        }

        //Quando a pagina já foi carregada.
        $(document).ready(function () {
            $("#guardar").click(function () {
                guardarDados();
            });
        });
    </script>
@stop