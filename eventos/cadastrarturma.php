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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script type="text/javascript">
      $(document).ready(function(){
      $("select[name=nivel]").change(function(){
        $.post("consultalistadeturma.php",{nivel:$(this).val()},function(valor){$("#listaTurma").html(valor);})
      })
      })
    </script>

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
<div class="panel-heading"><strong>Cadastro de turmas</strong></div>
<div class="panel-body texto-formulario-cadastro col-md-9">
<form name="criarevento" action="vbdcriarturma.php" method="post">
  <div class="form-group col-md-4">
      <label for="turno">Turno</label>
      <select required class="form-control" id="turno" name="turno">
          <option value="-1" disabled selected>Selecione...</option>
  				<option value="1">Manhã</option>
          <option value="2">Tarde</option>
          <option value="3">Noite</option>
      </select>
  </div>
  <div class="form-group col-md-4">
      <label for="nivel">Nível</label>
      <select required class="form-control" id="nivel" name="nivel">
          <option value="-1" disabled selected>Selecione...</option>
  				<option value="1">Fundamental I</option>
          <option value="2">Fundamental II</option>
          <option value="3">Médio</option>
      </select>
  </div>
  <div id="listaTurma" class="form-group col-md-4">
    <!-- aqui irá aparecer o resultado das turmas -->
  </div>

  <div class="form-group col-md-12">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <hr />
  </div>
</form>
</div>
</div>
<div class="panel-body texto-formulario-cadastro col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"><strong>Turmas</strong></div>
    <br />
    <div >
      <?php
        $pdo = conectar();
        $sql = $pdo->prepare('SELECT * FROM turma INNER JOIN turno ON turma.turno_turma = turno.id');
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $quantidade = $sql->rowCount();
        foreach ($resultado as $var){
          if($var->nivel == 1){
            $fundamental1[] = "<a class='list-group-item' href='listarturma.php?codturma=".$var->id_turma."'>".$var->nome_turma." - ".$var->nome."</a>";
          }else if($var->nivel == 2){
            $fundamental2[] = "<a class='list-group-item' href='listarturma.php?codturma=".$var->id_turma."'>".$var->nome_turma." - ".$var->nome."</a>";
          }else if($var->nivel == 3){
            $medio[] = "<a class='list-group-item' href='listarturma.php?codturma=".$var->id_turma."'>".$var->nome_turma." - ".$var->nome."</a>";
          }
        }
      ?>
      <div class="container">
            <div class="row">
              <div class="panel-body col-md-3">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><span class="glyphicon glyphicon-file">
                        </span>Fundamental 1</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                      <div class="list-group">
                        <?php
                          foreach ($fundamental1 as $value) {
                            echo $value;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><span class="glyphicon glyphicon-file">
                        </span>Fundamental 2</a>
                      </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                      <div class="list-group">
                        <?php
                          foreach ($fundamental2 as $value) {
                            echo $value;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><span class="glyphicon glyphicon-file">
                        </span>Médio</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <div class="list-group">
                        <?php
                          foreach ($medio as $value) {
                            echo $value;
                          }
                        ?>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

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
