<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    protegePagina();
    #Expulsa o usuario se não for operador
    if($_SESSION['nivel'] == 0){
        header("Location:aluno.php");
    }
    date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=titulo_pagina?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/editor.css" type="text/css" rel="stylesheet"/>

    <!-- CSS customizado por Josiel Souza -->
    <link href="css/estilojss.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo-publicacao.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?=$menu?>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h1><?=nome_empresa_editado?></h1>
                    </div>
                    <div class="col-md-4">
                        <p style="color:#415A55;text-align:right;"><br />Bem vindo(a) <b><?=utf8_decode($_SESSION['nome'])?></b></p>
                    </div>
                    <div class="col-md-2">
                        <p style="color:text-align:left;"><br /><a href="logout.php">Sair</a></p>
                    </div>
                </div>
                <hr />

                  <h1 class="titulo-local-h1">
                    <?=tema_projeto?>
                    <strong class="titulo-local-h2">
                      <?=subtema_projeto?>
                    </strong>
                  </h1>

                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Abrir Menu</a>

                <!-- Corpo Principal da página-->

                <div class="list-group">
                  <br />
<div class="panel panel-default">
<div class="panel-heading"><strong>Cria&ccedil;&atilde;o de eventos</strong></div>
<div class="panel-body texto-formulario-cadastro">
<form name="criarevento" action="vbdevento.php" method="post">
  <div class="form-group col-md-8">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" class="form-control" id="titulo" placeholder="..." required>
  </div>
  <div class="form-group col-md-4">
    <label for="qtdCurso">Quantidade de Cursos por Aluno</label>
    <input type="number" name="qtdCurso" min="1" class="form-control" id="qtdCurso" required>
  </div>
  <div class="form-group col-md-4">
    <label for="dtinicio">Data de início do evento</label>
    <input type="date" name="dataInicio" class="form-control" id="dtinicio" required>
  </div>
  <div class="form-group col-md-4">
    <label for="dtinicioinscricao">Início das inscri&ccedil;&otilde;es</label>
    <input type="date" name="inicioInscricao" class="form-control" id="dtinicioinscricao" required>
  </div>
  <div class="form-group col-md-4">
    <label for="dtfiminscricao">Encerramento das inscri&ccedil;&otilde;es</label>
    <input type="date" name="fimInscricao" class="form-control" id="dtfiminscricao" required>
  </div>
  <div class="form-group col-md-12">
    <p>* O início e o término das inscrições ocorrerão às 0h do dia definido.</p>
  </div>
  <div class="form-group col-md-12">
    <button type="reset" class="btn btn-default">Limpar</button>
    <button type="submit" class="btn btn-primary">Criar</button>
  </div>
</form>
</div>
</div>
                </div>

                <!-- Corpo Principal da página-->
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="bootstrap/js/bootstrap.min.js"></script>-->
    <script src="js/custom.js"></script>
    <script src="js/editor.js"></script>
</body>

</html>
