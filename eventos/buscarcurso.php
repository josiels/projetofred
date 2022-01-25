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
<!-- Include the above in your HEAD tag ---------->


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
<div class="panel-heading"><strong>Consultar Curso</strong></div>
<div class="panel-body texto-formulario-cadastro col-md-9">
  <div class="form-group col-md-12" align="right">
    <a href="cadastraratividade.php" class="btn btn-info">Novo Curso</a>
  </div>
  <div class="form-group col-md-12">

    <div class="row">
        <div class="col-sm-12">
            <div class="">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                    <form class="form-inline" action="buscarcurso.php" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label for="idcurso">Cursos</label>
                            <select id="idcurso" name="idcurso" class="form-control">
                                <option value="">...</option>
                                <?php
                                    $sqlcurso = $pdo->prepare("SELECT * FROM evento INNER JOIN turno INNER JOIN horario ON evento.turno = turno.id AND evento.hora_evento = horario.id_horario ORDER BY `titulo_evento` ASC");
                                    $sqlcurso->execute();
                                    $qtd = $sqlcurso->rowCount();
                                    if($qtd > 0){
                                        $result = $sqlcurso->fetchAll(PDO::FETCH_OBJ);
                                        foreach($result as $listar){
                                            echo '<option value="'.$listar->id_evento.'">'.$listar->titulo_evento.' - '.$listar->horario.' ('.$listar->nome.')</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar Curso</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                <?php
                                    if(isset($_POST['idcurso'])){
                                        $idcurso = $_POST['idcurso'];
                                    }else{
                                        $idcurso = 0;
                                    }
                                    //detalhar evento
                                    $sqlevento = $pdo->prepare("SELECT * FROM evento WHERE `id_evento` = $idcurso");
                                    $sqlevento->execute();
                                    $linhaevento = $sqlevento->fetchAll(PDO::FETCH_OBJ);
                                    foreach($linhaevento as $listar){
                                        echo '<b>Curso: </b><a href="#">'.$listar->titulo_evento.'</a>';
                                        echo '</div><div class="col-sm-3"><b>Vagas disponíveis: </b><a href="#">'.$listar->vagas_evento.'</a></div>';
                                        echo '<div class="col-sm-3"><a href="listapdf.php?idcurso='.$listar->id_evento.'" target="blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</a>';
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Matrícula</th>
                                <th>Nome</th>
                                <th>Turma</th>
                                <th>Turno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                                $cont = 0;
                                if($_SESSION['nivel'] == 1){
                                  #$sql = $pdo->prepare("SELECT * FROM usuario INNER JOIN matricula INNER JOIN turma WHERE usuario.id_usuario = matricula.fk_id_usuario AND matricula.fk_id_evento = $idcurso AND usuario.fk_id_turma = turma.id_turma ORDER BY turma.id_turma,usuario.nome_usuario ASC");
                                  $sql = $pdo->prepare("SELECT * FROM usuario INNER JOIN matricula INNER JOIN turma INNER JOIN turno ON usuario.id_usuario = matricula.fk_id_usuario AND matricula.fk_id_evento = $idcurso AND usuario.fk_id_turma = turma.id_turma AND turma.turno_turma = turno.id ORDER BY turma.id_turma,usuario.nome_usuario ASC ");
                                    $sql->execute();
                                    $qtdlinha = $sql->rowCount();
                                    if($qtdlinha > 0){
                                        $linha = $sql->fetchAll(PDO::FETCH_OBJ);
                                        foreach($linha as $listar){
                                            $cont++;
                                            $matricula = $listar->login_usuario;
                                            $nome = $listar->nome_usuario;
                                            $turma = $listar->nome_turma;
                                            $turno = $listar->nome;
                                            echo '<tr>';
                                            echo '<td scope="row">'.$cont.'</td>';
                                            echo '<td class="subtitulo">'.$matricula.'</td>';
                                            echo '<td>'.$nome.'</td>';
                                            echo '<td>'.$turma.'</td>';
                                            echo '<td>'.$turno.'</td>';
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
    </div>


  </div>
</div>

<?php
  $pdo = conectar();
  $sql = $pdo->prepare('SELECT * FROM turma INNER JOIN turno ON turma.turno_turma = turno.id');
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
  $quantidade = $sql->rowCount();
  foreach ($resultado as $var){
    if($var->nivel == 1){
      $fundamental1[] = "<a class='list-group-item' href='listarturma.php?codturma=".$var->id_turma."'>".utf8_encode($var->nome_turma)." - ".utf8_encode($var->nome)."</a>";
    }else if($var->nivel == 2){
      $fundamental2[] = "<a class='list-group-item' href='listarturma.php?codturma=".$var->id_turma."'>".utf8_encode($var->nome_turma)." - ".utf8_encode($var->nome)."</a>";
    }else if($var->nivel == 3){
      $medio[] = "<a class='list-group-item' href='listarturma.php?codturma=".$var->id_turma."'>".utf8_encode($var->nome_turma)." - ".utf8_encode($var->nome)."</a>";
    }
  }
?>

<div class="panel-body texto-formulario-cadastro col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"><strong>Turmas</strong></div>
    <br />
    <div >

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
