<?php
    $home="";
    $ranking="";
    $disciplina="";
    $pergunta="";
    $acerca="";

    if(isset($active)){
        switch($active){
            case "ranking":$ranking ="class='active'"; break;
            case "disciplina":$disciplina ="class='active'"; break;
            case "pergunta":$pergunta ="class='active'"; break;
            case "acerca":$acerca ="class='active'"; break;
            case "home":$home ="class='active'"; break;
            default: $home="class='active'"; break;
        }
    }

    else{
        $home ="class='active'";
    }
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}" type="text/css">
    @yield('head')
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/home">MozQuiz</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li <?=$home ?>><a href="/home">Pagina Inicial</a></li>
                <li <?=$ranking ?>><a href="/ranking">Classificação</a></li>
                <li <?=$acerca ?>><a href="/acerca">Acerca</a></li>
                <li <?=$disciplina ?>><a href="/disciplina">Admin</a></li>
            </ul>
            @if(isset($admin))
            <ul class="nav navbar-nav navbar-right">
                <li <?=$disciplina ?>><a href="/disciplina">Disciplina</a></li>
                <li <?=$pergunta ?>><a href="/pergunta">Exericio</a></li>
            </ul>
            @endif
        </div>
    </div>
</nav>
<div id="corpo">
@yield('body')

</div>

<script src="{{URL::asset('js/jquery.min.js')}}" ></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
@yield('script')
</body>
</html>