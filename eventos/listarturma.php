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
<div class="panel-heading"><strong>Consulta de aluno</strong></div>
<div class="panel-body texto-formulario-cadastro col-md-12">
  <div class="form-group col-md-12">
    <?php
      if(isset($_GET['codturma'])){
        $id_turma = $_GET['codturma'];
        $pdo = conectar();
        $sql = $pdo->prepare('SELECT id_usuario,nome_usuario,login_usuario FROM usuario WHERE fk_id_turma = "'.$id_turma.'" ORDER BY nome_usuario ASC');
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);

        $sql_turma = $pdo->prepare('SELECT * FROM turma INNER JOIN turno ON turma.turno_turma = turno.id ORDER BY nivel,nome_turma ASC');
        $sql_turma->execute();
        $resultado_turma = $sql_turma->fetchAll(PDO::FETCH_OBJ);

        echo "<table class='table table-striped table-hover table-condensed'>";
        echo "<thead><tr>";
        echo "<th>&nbsp;</th>";
        echo "<th>Matrícula</th>";
        echo "<th>Nome</th>";
        echo "<th>Atualizar</th>";
        echo "</tr></thead>";
        echo "<tbody>";

        $cont=0;
        foreach ($resultado as $var){
          $cont++;
          echo "<tr>";
          echo "<td class='align-vertical'>".$cont."</td>";
          echo "<td class='align-vertical'><a href='#'>".$var->login_usuario."</a></td>";
          echo "<td class='align-vertical'><a href='#'>".utf8_encode($var->nome_usuario)."</a></td>";
          echo "<td class='align-vertical'>";
          echo "<select class='form-control'>";
          foreach ($resultado_turma as $var_turma){
            echo "<option><a href='1'>".utf8_encode($var_turma->nome_turma)." - ".utf8_encode($var_turma->nome)."</a></option>";
          }
          echo "</select>";
          echo "</td></tr>";
        }
        echo "</tbody></table>";
      }else{
        echo "Redirect...";
      }
    ?>
  </div>
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
