<?php $active = "home"; ?>
@extends('layouts.main')
@section('title')
    Femoeng : Quiz
@stop
@section('body')
    <div class="container">
        <p></p>

        <div id="dadosPergunta" class="well">
            <h2 class="text-center">Exercicio: Matemática</h2>

            <div id="perguntas">
                <div>
                    <div class="progress">
                        <div id="progresso" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0"
                             aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Completo</span>
                        </div>
                    </div>
                </div>
                <div id="opcoes">
                    <h3 class="text-primary" id="pergunta"></h3>

                    <div id="respostas" class="container">

                        <div id="opcao1">
                            <input type="radio" onclick="selected('opcao1',1)" name="resposta" id="op1">
                            <label for="op1" id="resposta1"></label>
                        </div>

                        <div id="opcao2">
                            <input type="radio" onclick="selected('opcao2',2)" name="resposta" id="op2">
                            <label for="op2" id="resposta2"></label>
                        </div>
                        <div id="opcao3">
                            <input type="radio" onclick="selected('opcao3',3)" name="resposta" id="op3">
                            <label for="op3" id="resposta3"></label>
                        </div>

                        <div id="opcao4">
                            <input type="radio" onclick="selected('opcao4',4)" name="resposta" id="op4">
                            <label for="op4" id="resposta4"></label>
                        </div>

                        <div id="opcao5">
                            <input type="radio" onclick="selected('opcao5',5)" name="resposta" id="op5">
                            <label for="op5" id="resposta5"></label>
                        </div>
                    </div>
                </div>
                <br/>
            </div>
        </div>
        <div id="envio" class="well envio">
            <div class="row">
                <div id="envioConfirmacao" class="col-md-8 col-lg-8 col-sm-8">
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <div class="right">
                        <button id="verificar" class="btn btn-success btn-lg">Verificar</button>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div id="progressoModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Registo de Progresso</h4>
                </div>
                <div class="modal-body">
                    <div id="modalInfo">

                    </div>
                    <div class="form-group">
                    <label for="nome">Teu nome:</label>
                    <input class="form-control" type="text" id="nome" name="nome" placeholder="digite teu nome aqui">
                    </div>
                    <button id="guardaProgresso" class="btn btn-success">Guardar</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script>
        var perguntas;
        var nrPerguntas;
        var perguntaActual;
        var verifica = true;
        var continua = false;
        var relatorio = false;
        var respostaEscolhida;
        var nrRespostasCertas = 0;
        var nrRespostasErradas = 0;
        var nota;
        var progresso=false;

        function selected(opcao, id) {
            var opcaoActual, opcaoEscolhida;
            //deseleciona
            deseleciona();

            opcaoEscolhida = document.getElementById(opcao);
            opcaoEscolhida.setAttribute('class', 'bg-success');
            respostaEscolhida = $('#resposta' + id).text();
            verificar = document.getElementById('verificar');
            verificar.disabled=false;
        }

        function deseleciona() {
            for (i = 0; i < 5; i++) {
                opcaoActual = document.getElementById("opcao" + (i + 1));
                opcaoActual.setAttribute('class', '');
            }
        }

        function nenhumaOpcaoEscolhida() {
            deseleciona();
            for (i = 0; i < 5; i++) {
                opcaoActual = document.getElementById("op" + (i + 1));
                opcaoActual.checked = false;
            }
        }

        function preenchePerguntaActual() {
            var pergunta, questao, resposta1, resposta2, resposta3, resposta4, resposta5,verificar;
            pergunta = perguntas[perguntaActual];
            $('#pergunta').text(pergunta.questao);
            $('#resposta1').text(pergunta.opcao1);
            $('#resposta2').text(pergunta.opcao2);
            $('#resposta3').text(pergunta.opcao3);
            $('#resposta4').text(pergunta.opcao4);
            $('#resposta5').text(pergunta.opcao5);
            verificar = document.getElementById('verificar');
            verificar.disabled=true;
        }

        function mostraRelatorio() {
            var content,envio, botaoVerificar, envioConfirmacao;
            envio = document.getElementById('envio');
            botaoVerificar = document.getElementById('verificar');
            envioConfirmacao = document.getElementById('envioConfirmacao');
            envio.setAttribute('class', 'well envio');
            envioConfirmacao.innerHTML = "";
            nota = (nrRespostasCertas)/(nrRespostasCertas+nrRespostasErradas)*20;
            content = "<div>" +
            "<p>Nota: "+nota+"</p>" +
            "<p class='text-success'>Respostas certas:"+nrRespostasCertas+" </p>" +
            "<p class='text-danger'>Respostas erradas:"+nrRespostasErradas+" </p>" +
            "<p><strong>Deseja registar os teus dados? Clica no botão abaixo:</strong></p>" +
            "<button data-toggle='modal' data-target='#progressoModal'" +
            " class='btn btn-primary'>Guardar Progresso</button>" +
            "<div>";
            $("#opcoes").html(content);
            relatorio = true;
        }

        function voltaPaginaInicial() {

        }

        function mostraBarraProgresso (){
            var progressBar,progresso;
            progresso = (perguntaActual/nrPerguntas)*100;
            progressBar = document.getElementById('progresso');
            progressBar.setAttribute('aria-value-now',""+progresso);
            progressBar.style.width =""+progresso+"%";
        }

        function verificaDados() {
            if (verifica == true) {
                habilitaRespostas('true');
                verificaPergunta();
            }
            else if (continua == true) {
                prossegueParaProxima();
            }
        }

        function verificaPergunta() {
            var pergunta, id;
            pergunta = perguntas[perguntaActual];
            id = pergunta.id;
            data = {id: id, respostaEscolhida: respostaEscolhida};
            url = "/exercicio/valida";
            $.get(url, data, function (data, status) {
                visualizaReposta(data, status)
            });
        }

        function visualizaReposta(data, status) {
            var dadosResposta, valida, respostaCorrecta, envio, botaoVerificar, envioConfirmacao;
            dadosResposta = JSON.parse(data);
            valida = dadosResposta[0];
            respostaCorrecta = dadosResposta[1];
            envio = document.getElementById('envio');
            botaoVerificar = document.getElementById('verificar');
            envioConfirmacao = document.getElementById('envioConfirmacao');

            botaoVerificar.innerHTML = "Continuar";
            if (valida == true) {
                envio.setAttribute('class', 'well envio-success');
                envioConfirmacao.innerHTML = "<p><strong>Parabens!</strong> acertaste a resposta</p>";
                nrRespostasCertas++;
            }
            else {
                envio.setAttribute('class', 'well alert envio-error');
                envioConfirmacao.innerHTML = "<p><strong>Que pena!</strong>A resposta escolhida está errada." +
                " A resposta correcta é: " + respostaCorrecta + "</p>";
                nrRespostasErradas++;
            }

            verifica = false;
            continua = true;

            perguntaActual++;

            mostraBarraProgresso();
        }

        function prossegueParaProxima() {
            var envio, botaoVerificar, envioConfirmacao;
            if ((perguntaActual) < nrPerguntas) {
                envio = document.getElementById('envio');
                botaoVerificar = document.getElementById('verificar');
                envioConfirmacao = document.getElementById('envioConfirmacao');
                botaoVerificar.innerHTML = "Verificar";
                envio.setAttribute('class', 'well envio');
                envioConfirmacao.innerHTML = "";
                verifica = true;
                continua = false;
                preenchePerguntaActual();
                nenhumaOpcaoEscolhida();
                habilitaRespostas(false);
            }

            else if (relatorio == false)
                mostraRelatorio();
            else {
                paginaInicial();
            }
        }

        function guardaProgresso (){
            var nome,url,data;
            nome = $('#nome').val();
            url = "/exercicio/progresso";
            data = {nrRespostasCertas:nrRespostasCertas,nrRespostasErradas:nrRespostasErradas,nota:nota,nome:nome};

            $.post(url,data,function(data,status){
                var dados,nome,valido,info;
                dados = JSON.parse(data);
                nome = dados[0];
                valido = dados[1];
                if(valido) {
                    info = document.getElementById('modalInfo');
                    info.innerHTML = "<p><strong>Parabens!</strong> o seu progresso foi guardado. <a href='/ranking'>Clique aqui</a> para ver a classificação</p>";
                    info.setAttribute('class', 'alert alert-success');
                }

                else{
                    info = document.getElementById('modalInfo');
                    info.innerHTML = "<p><strong>Erro!</strong>Não foi possivel guardar o progresso tente numa outra altura.</p>" +
                    "<p>Erro:"+dados[2]+"</p>";
                    info.setAttribute('class', 'alert alert-danger');
                }

                progresso = true;

                $("#guardaProgresso").text('continuar');

            });
        }

        function habilitaRespostas (bool){
            var op1,op2,op3,op4,op5;
            op1 = document.getElementById('op1');
            op2 = document.getElementById('op2');
            op3 = document.getElementById('op3');
            op4 = document.getElementById('op4');
            op5 = document.getElementById('op5');

            op1.disabled =bool;
            op2.disabled =bool;
            op3.disabled =bool;
            op4.disabled =bool;
            op5.disabled =bool;


        }

        function paginaInicial(){
            window.location.assign("/home");
        }

        $(document).ready(function () {
            perguntaActual = 0;
            perguntas = JSON.parse('<?php echo json_encode($perguntas); ?>');
            nrPerguntas = "{{$nrPerguntas}}";
            preenchePerguntaActual();

            $('#verificar').click(function () {
                verificaDados();
            });

            $("#guardaProgresso").click(function(){
                if(progresso==true)
                    paginaInicial();
                else
                guardaProgresso();

            });
        });

    </script>
@stop