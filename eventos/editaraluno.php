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

    <!-- CSS para exibir os ICONS Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
                &nbsp;&nbsp;
                <a href="buscaraluno.php" class="btn btn-success" id="menu-toggle">Nova Busca</a>

                <!-- Corpo Principal da página-->

                <div class="list-group">
                  <br />
<div class="panel panel-default">
<div class="panel-heading"><strong>Editar aluno</strong></div>
<div class="panel-body texto-formulario-cadastro col-md-12">
  <div class="form-group col-md-12">
    <?php
      if(isset($_GET['codigoaluno'])){
        $codAluno = $_GET['codigoaluno'];
        $pdo = conectar();

        #
        $sqlQtdCurso = $pdo->prepare("SELECT * FROM atividade WHERE data_inicio BETWEEN curdate() - interval 30 day AND curdate() + interval 30 day ORDER BY id DESC");
        $sqlQtdCurso->execute();
        $resultado = $sqlQtdCurso->fetchAll(PDO::FETCH_OBJ);
        $qtdTotalCurso = 0;
        if($sqlQtdCurso->rowCount() > 0){
          foreach ($resultado as $listar) {
            $qtdTotalCurso = $listar->qtd_curso;
          }
        }

        $sqlQtdCurso = $pdo->prepare("SELECT * FROM `matricula` WHERE `fk_id_usuario` = ".$codAluno.";");
        $sqlQtdCurso->execute();
        $resultado = $sqlQtdCurso->fetchAll(PDO::FETCH_OBJ);
        $qtdCurso = 0;
        if($sqlQtdCurso->rowCount() > 0){
            $qtdCurso = $sqlQtdCurso->rowCount();
        }

        #
        #$sql = $pdo->prepare('SELECT usuario.id_usuario,usuario.login_usuario, usuario.nome_usuario,usuario.fk_id_turma, turma.nome_turma, turno.nome
        #  FROM usuario INNER JOIN turma INNER JOIN turno WHERE id_usuario = '.$codAluno.' AND usuario.fk_id_turma = turma.id_turma
        #  AND turno.id = turma.turno_turma LIMIT 1');

        #$sql = $pdo->prepare('SELECT usuario.id_usuario,usuario.login_usuario, usuario.nome_usuario,usuario.fk_id_turma, turma.nome_turma, turno.nome
        #  FROM usuario INNER JOIN turma INNER JOIN turno ON id_usuario = '.$codAluno.' LIMIT 1');
        
        $sql = $pdo->prepare('SELECT usuario.id_usuario,usuario.login_usuario, usuario.nome_usuario,usuario.fk_id_turma, turma.nome_turma, turno.nome
          FROM usuario INNER JOIN turma INNER JOIN turno ON id_usuario = '.$codAluno.' AND usuario.fk_id_turma = turma.id_turma AND turno.id = turma.turno_turma LIMIT 1');
        
        #$sql = $pdo->prepare('SELECT * FROM usuario INNER JOIN turma INNER JOIN turno ON id_usuario = '.$codAluno.' LIMIT 1');

        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $id_aluno = '';
        $login_aluno = '';
        $nome_aluno = '';
        $id_turma = '';
        $turma = '';

        foreach ($resultado as $var){
          $id_aluno = $var->id_usuario;
          $login_aluno = $var->login_usuario;
          $nome_aluno = $var->nome_usuario;
          $turma = $var->nome_turma.' - '.$var->nome;
          $id_turma = $var->fk_id_turma;
        }

        #Resultado do aluno normal

        echo "<table border='0' class='table table-striped table-hover table-condensed w-auto'>";
        echo "<thead><tr>";
        echo "<th>Nome</th>";
        echo "<th>Turma</th>";
        echo "<th colspan='".$qtdCurso."'>Atividade(s)</th>";
        echo "</tr></thead>";
        echo "<tbody>";
        echo "<tr>";
        echo "<td class='align-vertical'><span style='color:#604020 !important;'>".$nome_aluno;
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo '<a href="removeraluno.php?idmatricula='.($id_aluno*(532550035)).'" title="Remover">';
        echo "<span style='color:#F00;'><span class='glyphicon glyphicon-remove'></span></span></a>";
        echo "</span></td>";
        echo "<td class='align-vertical'><span style='color:#604020 !important;'>".$turma."</span></td>";

        $sql = $pdo->prepare("SELECT * FROM matricula WHERE fk_id_usuario = ".$id_aluno.";");
        $sql->execute();
        $resCurso = $sql->fetchAll(PDO::FETCH_OBJ);
        $matriculado = array();
        if ($sql->rowCount() > 0) {
          foreach ($resCurso as $listar) {
            $matriculado[] = $listar->fk_id_evento;
          }
        }
        $jaMatriculado = sizeof($matriculado);
        if ($jaMatriculado > 0){
          for($i=0;$i<$qtdCurso;$i++){
            $sql = $pdo->prepare("SELECT * FROM evento WHERE id_evento = ".$matriculado[$i].";");
            $sql->execute();
            $resCurso = $sql->fetchAll(PDO::FETCH_OBJ);
            if ($sql->rowCount() > 0) {
              foreach ($resCurso as $listar) {
                echo "<td class='align-vertical'><span style='color:#604020 !important;'>".($i+1).": ".$listar->titulo_evento."</span></td>";
              }
            }
          }
        }else{
          echo "<td class='align-vertical'><span style='color:#604020 !important;'>nehum curso matriculado.</span></td>";
        }

        echo "</tbody></table>";
        echo "<hr />";
        ###################################################################################################################

        #Resultado do aluno para atualização
        echo "<table class='table table-striped table-hover table-condensed'>";
        echo "<thead><tr>";
        echo "<th>Nome</th>";
        echo "<th>Nova Turma</th>";
          echo "<th colspan='".($qtdTotalCurso-$qtdCurso)."'>Atividade(s)</th>";
        echo "</tr></thead>";
        echo "<tbody>";

        echo '<form name="atualizarAluno" action="vbdatualizaraluno.php" method="post">';

          echo "<input type='hidden' name='idAluno' value='".$id_aluno."' />";
          echo "<tr>";
          echo "<td class='align-vertical'><input class='form-control' type='text' name='nome' value='".$nome_aluno."' /></td>";
          echo "<td class='align-vertical'>";
          echo "<select class='form-control' name='idTurma'>";
          echo "<option value='-1' selected disabled>Selecione...</option>";

          $sql_turma = $pdo->prepare('SELECT * FROM turma INNER JOIN turno ON turma.turno_turma = turno.id ORDER BY nivel,nome_turma');
          $sql_turma->execute();
          $resultado_turma = $sql_turma->fetchAll(PDO::FETCH_OBJ);

          foreach ($resultado_turma as $var_turma){
            $fk_id_turma = $var_turma->id_turma;
            echo "<option value='".$fk_id_turma."'>".$var_turma->nome_turma." - ".$var_turma->nome."</option>";
          }
          echo "</select></td>";
          #
          #
          $sql = $pdo->prepare("SELECT * FROM `curso_turma` INNER JOIN `evento` INNER JOIN `turno` ON fk_id_turma = ".$id_turma." AND `curso_turma`.fk_id_curso = `evento`.id_evento AND `evento`.vagas_evento > 0 AND `turno`.`id` = `evento`.turno;");
          #$sql = $pdo->prepare("SELECT * FROM `curso_turma` INNER JOIN `evento` ON fk_id_turma = ".$id_turma." AND `curso_turma`.fk_id_curso = `evento`.id_evento AND `evento`.vagas_evento > 0;");
          $sql->execute();
          $resCurso = $sql->fetchAll(PDO::FETCH_OBJ);
          if ($sql->rowCount() > 0) {
            for($i=0;$i<($qtdTotalCurso-$qtdCurso);$i++){
              echo "<td class='align-vertical'>";
              echo "<select class='form-control' name='idCurso[]'>";
              echo "<option value='-1' selected disabled>Selecione...</option>";
              foreach ($resCurso as $listar) {
                echo "<option value='".$listar->id_evento."'>".$listar->titulo_evento." (".$listar->vagas_evento.") - ".$listar->nome."</option>";
              }
              echo "</select></td>";
            }
          }
          #
          #
          echo "</tr>";

        echo "</tbody></table>";
      }else{
        echo "Redirect...";
      }
    ?>
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary" align="center">Atualizar</button>
        <hr />
      </div>
    </form>
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
