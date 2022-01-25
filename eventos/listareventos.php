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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <!--Busca Interativa-->
    <script type="text/javascript" src="js/funcBuscaInterativa.js"></script>

    <!--Efeito Sanfona DIV-->
    <script type="text/javascript" src="js/sanfona.js"></script>
    <link href="css/sanfona.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Include the above in your HEAD tag -->


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
                        <p style="color:#415A55;text-align:right;"><br />Bem vindo(a) <b><?=$_SESSION['nome']?></b></p>
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
<div class="panel-heading"><strong>Lista de Eventos Cadastrados</strong></div>
<div class="panel-body texto-formulario-cadastro col-md-12">
  <div class="form-group col-md-12">
    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Título</th>
                <th>Data do Evento</th>
                <th>Início das Inscrições</th>
                <th>Término das Inscrições</th>
                <th>Cursos por Aluno</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
            $sqlQtdCurso = $pdo->prepare("SELECT * FROM atividade");
            $sqlQtdCurso->execute();
            $resultado = $sqlQtdCurso->fetchAll(PDO::FETCH_OBJ);
            if($sqlQtdCurso->rowCount() > 0){
              foreach ($resultado as $listar) {
                $idAtividade = $listar->id;
                $dataI = $listar->inscricao_inicio;
                $dataF = $listar->inscricao_termino;
                #verifica se está no período de inscrições
                if(strtotime(date('Y-m-d')) >= strtotime($dataI) || strtotime(date('Y-m-d')) <= strtotime($dataF)){
                  $update = $pdo->prepare("UPDATE atividade SET `situacao` = 1 WHERE `id` = $idAtividade");
                  $update->execute();
                }
                if (strtotime(date('Y-m-d')) > strtotime($dataF) || strtotime(date('Y-m-d')) < strtotime($dataI)){
                  $update = $pdo->prepare("UPDATE atividade SET `situacao` = 0 WHERE `id` = $idAtividade");
                  $update->execute();
                }
              }
            }

                $cont = 0;
                if($_SESSION['nivel'] == 1){
                  $sql = $pdo->prepare("SELECT * FROM atividade ");
                    $sql->execute();
                    $qtdlinha = $sql->rowCount();
                    if($qtdlinha > 0){
                        $linha = $sql->fetchAll(PDO::FETCH_OBJ);
                        foreach($linha as $listar){
                            $cont++;
                            $nome = $listar->nome;
                            $data = $listar->data_inicio;
                            $inscInicio = $listar->inscricao_inicio;
                            $inscTermino = $listar->inscricao_termino;
                            $qtdCurso = $listar->qtd_curso;
                            $situacao = $listar->situacao;

                            if ($situacao == 1) {
                              echo '<tr class="table-success">';
                            }else {
                              echo '<tr>';
                            }
                            echo '<td scope="row">'.$cont.'</td>';
                            echo '<td class="subtitulo">'.$nome.'</td>';
                            echo '<td>'.date("d/m/Y", strtotime($data)).'</td>';
                            echo '<td>'.date("d/m/Y", strtotime($inscInicio)).'</td>';
                            echo '<td>'.date("d/m/Y", strtotime($inscTermino)).'</td>';
                            echo '<td>'.$qtdCurso.'</td>';
                            if ($situacao == 1) {
                              echo '<td>Ativado</td>';
                            }else{
                              echo '<td>Desativado</td>';
                            }

                            echo '</tr>';
                        }
                    }
                }
            ?>
        </tbody>
    </table>
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
