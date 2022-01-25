<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    protegePagina();
    if($_SESSION['nivel'] != 0){
        header("Location:logout.php");
    }
    date_default_timezone_set('America/Recife');
    echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=aluno.php'>";
    $pdo = conectar();
    $sqlQtdCurso = $pdo->prepare("SELECT * FROM atividade WHERE data_inicio BETWEEN curdate() - interval 30 day AND curdate() + interval 30 day ORDER BY id DESC");
    $sqlQtdCurso->execute();
    $resultado = $sqlQtdCurso->fetchAll(PDO::FETCH_OBJ);
    $qtdTotalCurso = 0;
    if($sqlQtdCurso->rowCount() > 0){
      foreach ($resultado as $listar) {
        $qtdTotalCurso = $listar->qtd_curso;
      }
    }
    $sqlQtdCurso = $pdo->prepare("SELECT * FROM atividade");
    $sqlQtdCurso->execute();
    $resultado = $sqlQtdCurso->fetchAll(PDO::FETCH_OBJ);
    if($sqlQtdCurso->rowCount() > 0){
      foreach ($resultado as $listar) {
        $dataI = $listar->inscricao_inicio;
        $dataF = $listar->inscricao_termino;
      }
    }
    $sql = $pdo->prepare("SELECT * FROM matricula WHERE `fk_id_usuario` = ?");
    $sql->bindParam(1,$_SESSION['id']);
    $sql->execute();
    #Armazena em $qtdcurso a quantidade de cursos que o aluno está matriculado.
    $qtdcurso = $sql->rowCount();
    if($qtdcurso == 0){
      $atividadesMatriculado = null;
    }else{
      $atividadesMatriculado = $sql->fetchAll(PDO::FETCH_OBJ);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=titulo_pagina?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/estilojss.css" rel="stylesheet">
    <!-- CSS para exibir os ICONS Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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

                <h1 class="titulo-local-h1"><?=tema_projeto?>
                 <strong class="titulo-local-h2"><?=subtema_projeto?></strong></h1>
                 <!-- Corpo Principal da página-->

                 <div class="row">
                   <div class="col-md-7">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title">Atividades Dispon&iacute;veis</h3>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                              <div class="col-md-1">&nbsp;</div>
                              <div class="col-md-8">Tema</div>
                              <div class="col-md-3">Vagas</div>
                          </div>
                          <div class="row"><div class="col-md-12"><hr /></div></div>
                          <div class="row">
                                  <?php
                                    #verifica se está no período de inscrições
                                    if(strtotime(date('Y-m-d')) >= strtotime($dataI) && strtotime(date('Y-m-d')) <= strtotime($dataF)){
                                      #header("Location:autorizaevento.php");
                                    
                                      $cont = 0;
                                      $id = $_SESSION['id'];
                                      #informações do id_usuario
                                      $sqlUsuario = $pdo->prepare("SELECT fk_id_turma FROM `usuario` WHERE `usuario`.id_usuario = $id LIMIT 1");
                                      $sqlUsuario->execute();
                                      $resUsuario = $sqlUsuario->fetchAll(PDO::FETCH_OBJ);
                                      $turmaUsuario = '';
                                      if($sqlUsuario->rowCount() > 0){
                                        foreach ($resUsuario as $valor){
                                          $turmaUsuario = $valor->fk_id_turma;
                                          #$valor->qtd_curso;
                                        }
                                      }

                                      #$sql = $pdo->prepare("SELECT * FROM `evento` INNER JOIN `curso_turma` INNER JOIN `horario`
                                      # ON `evento`.`id_evento` = `curso_turma`.`fk_id_curso` AND `curso_turma`.fk_id_turma = $turmaUsuario AND `evento`.hora_evento=`horario`.id_horario ORDER BY vagas_evento DESC");
                                      $sql = $pdo->prepare("SELECT * FROM `evento` INNER JOIN `curso_turma` INNER JOIN `horario`
                                       ON `evento`.`id_evento` = `curso_turma`.`fk_id_curso` AND `curso_turma`.fk_id_turma = $turmaUsuario AND `evento`.hora_evento=`horario`.id_horario ORDER BY vagas_evento DESC");
                                      $sql->execute();
                                      $resCurso = $sql->fetchAll(PDO::FETCH_OBJ);
                                      if ($sql->rowCount() > 0) {
                                        foreach ($resCurso as $listar) {
                                          $cont++;
                                          #Situação para checar se o aluno já esta matriculado em algum curso
                                          $jaMatriculado = false;
                                          $mesmoHorario = false;
                                          if($atividadesMatriculado != null){
                                            foreach ($atividadesMatriculado as $value) {
                                              if($listar->id_evento == $value->fk_id_evento){
                                                $jaMatriculado = true;
                                              }
                                                    #Situação para não habilitar palestras no mesmo horário
                                                    #esse vem do SQL principal
                                                    $horarioAtividade = $listar->hora_evento;
                                                    $sqlHorario = $pdo->prepare("SELECT hora_evento FROM evento WHERE id_evento = ".$value->fk_id_evento.";");
                                                    $sqlHorario->execute();
                                                    $respostaHorario = $sqlHorario->fetchAll(PDO::FETCH_OBJ);
                                                    foreach($respostaHorario as $v){
                                                        if($horarioAtividade == $v->hora_evento){
                                                            $mesmoHorario = true;
                                                        }
                                                    }
                                              
                                            }
                                          }
                                          #
                                          if($mesmoHorario){
                                                if($jaMatriculado){
                                                    echo '<div class="col-md-1">'.$cont.'</div>';
                                                    echo '<div class="col-md-8">'.$listar->titulo_evento.' - '.$listar->horario.' (Matriculado)</div>';
                                                    echo '<div class="col-md-3">'.$listar->vagas_evento.'</div>';
                                                    echo '<div class="col-md-12"><hr /></div>';
                                                }else{
                                                    echo '<div class="col-md-1">'.$cont.'</div>';
                                                    echo '<div class="col-md-8">'.$listar->titulo_evento.' - '.$listar->horario.'</div>';
                                                    echo '<div class="col-md-3">'.$listar->vagas_evento.'</div>';
                                                    echo '<div class="col-md-12"><hr /></div>';
                                                }
                                          }else{#xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            if($qtdTotalCurso > $qtdcurso){
                                              echo '<a href="validamatricularevento.php?idevento='.($listar->id_evento*(532550035)).'&idaluno='.($_SESSION["id"]*(532550035)).'">';
                                              echo '<div class="col-md-1">'.$cont.'</div>';
                                              echo '<div class="col-md-8">'.$listar->titulo_evento.' - '.$listar->horario.'</div>';
                                              echo '<div class="col-md-3">'.$listar->vagas_evento.'</div></a>';
                                            }else{
                                              echo '<div class="col-md-1">'.$cont.'</div>';
                                              echo '<div class="col-md-8">'.$listar->titulo_evento.' - '.$listar->horario.'</div>';
                                              echo '<div class="col-md-3">'.$listar->vagas_evento.'</div>';
                                            }
                                            echo '<div class="col-md-12"><hr /></div>';
                                          }
                                        }
                                      }
                                    }else{
                                      echo '<p>&nbsp;&nbsp;&nbsp;Este evento só estará disponível apartir do dia: <span style="color:#ff751a !important;font-weight:bold;">'.date('d/m/Y',strtotime($dataI)).'</span>.</p>';
                                    }


                                  ?>
                          </div>
                        </div>
                     </div>
                   </div>
                     <div class="col-md-5">
                       <div class="panel panel-info">
                          <div class="panel-heading">
                            <h3 class="panel-title">Minhas Atividades <span class='badge badge-jos'><?=$qtdcurso?></span></h3>
                          </div>
                          <div class="panel-body">
                            <table class="table table-responsive table-hover">
                                  <?php
                                    if($atividadesMatriculado != null){
                                      echo '<thead><tr><th>Matriculado em:</th><th>&nbsp;</th></tr></thead><tbody>';
                                      foreach ($atividadesMatriculado as $value) {
                                        $atividade = $value->fk_id_evento;
                                        $id_matricula = $value->id_matricula;
                                        $sql = $pdo->prepare("SELECT * FROM evento WHERE `evento`.`id_evento` = $atividade");
                                        $sql->execute();
                                        if($sql->rowCount() > 0){
                                            $linha = $sql->fetchAll(PDO::FETCH_OBJ);
                                            foreach($linha as $listar){
                                                $hora_evento = $listar->hora_evento;
                                                $sql_hora = $pdo->prepare("SELECT `horario` FROM horario WHERE `id_horario` = $hora_evento");
                                                $sql_hora->execute();
                                                $res = $sql_hora->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($res as $valor_hora) {
                                                    $horario = $valor_hora->horario;
                                                }
                                                echo "<tr><td><span style='color:#FF5F00;'>".$listar->titulo_evento." - ".$horario."</span></td>";
                                                echo "<td align='right'>";
                                                echo '<a href="removerevento.php?idmatricula='.($id_matricula*(532550035)).'&idevento='.($atividade*(532550035)).'" title="Remover">';
                                                echo "<span style='color:#F00;'><span class='glyphicon glyphicon-remove'></span></span></a>";
                                                echo "</td></tr>";
                                            }
                                        }
                                      }
                                    }
                                  ?>
                                </tbody>
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
</body>
</html>
