<?php
date_default_timezone_set("America/Recife");
include 'conexao/seguranca.php';
protegePagina();
    $pdo = conectar();
    if($_SESSION['id'] > 3){
        header("Location:alunoinscrito.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="utf-8">
        <title>Sistema Gênesis Feedback</title>
	<link rel="shortcut icon" href="http://oi66.tinypic.com/2zq8l7k.jpg" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/calendar.css">
        <link rel="stylesheet" href="css/estilojss.css">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/es-ES.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/moment.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
        <script src="js/bootstrap-datetimepicker.es.js"></script>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
        <script src="js/bootstrap-datetimepicker.es.js"></script>

        <style type="text/css">
            .header{
               height:50px;
               background-color: #2c3742;
            }

            .header .logo h1{
               font-size:30px;
               margin:0px;
               padding:10px 0px;
            }

            .header .logo h1 a{
               color:#fff;
               font-family: 'Open Sans Condensed', sans-serif;
            }

            .header .logo h1 a:hover{
               color:#fff;
               text-decoration:none;
               border:0px;
            }
            .titulo{
                color: #3d3d29;
                font-weight: normal;
            }
            .subtitulo{
                color: #669999;
                font-weight: bolder;
            }
            .titulo-local-h1{
                color: #666666;
                font-size: 3em;
                font-weight: bolder;
                text-align: center;
            }
            .titulo-local-h2{
                color: #669999;
                font-size: 30pt;
                font-family:'script';
                text-align: center;
                font-weight:normal;
            }

        </style>
    </head>

<body style="background: white;">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                            <!-- Logo -->
                    <div class="logo">
                        <a href="index.php"><img src="img/logogenesis.png"></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="logo">
                        <p style="color:#FFF;text-align:right;"><br />Bem vindo(a) <b><?=utf8_decode($_SESSION['nome'])?></b></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="logo">
                        <p style="color: #FFF;"><br /><a href="logout.php">Sair</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php if($_SESSION['nivel'] == 1){echo'
        <div class="row">
            <div class="col-md-12">
                <div class="menu-horizontal">
                    <a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início</a>
                    &nbsp;&nbsp;&nbsp;|
                    <a href="cadastrarevento.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Cadastrar Evento</a>
                    &nbsp;&nbsp;&nbsp;|
                    <a href="listaalunos.php"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Listar Alunos</a>
                    &nbsp;&nbsp;&nbsp;|
                    <a href="listaalunosnulo.php"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Não matriculados</a>
                    <hr />
                </div>
            </div>
        </div>';}?>
        <div class="row">
            <div class="col-sm-12">
                <h1 class="titulo-local-h1">Projeto Ci&ecirc;ncias
                <strong class="titulo-local-h2">educar para prevenir</strong></h1><br />
                <?php
                if($_SESSION['nivel'] == 0){
                    echo '<p><a href="alunoinscrito.php"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Meus Cursos <span class="badge badge-pill badge-danger">'.$qtdcurso.'</span></a></p>';
                }
                if($_SESSION['login'] == 11){
                    echo '<p><a href="log.php"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>  Log de acesso</span></a></p>';
                }
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                        <form class="form-inline" action="listaalunos.php" method="POST" autocomplete="off">
                            <div class="form-group">
                                <label for="idcurso">Cursos</label>
                                <select id="idcurso" name="idcurso" class="form-control">
                                    <option value="">...</option>
                                    <?php
                                        $sqlcurso = $pdo->prepare("SELECT * FROM evento ORDER BY `titulo_evento` ASC");
                                        $sqlcurso->execute();
                                        $qtd = $sqlcurso->rowCount();
                                        if($qtd > 0){
                                            $result = $sqlcurso->fetchAll(PDO::FETCH_OBJ);
                                            foreach($result as $listar){
                                                $turno = $listar->hora_evento;
                                                if($turno < 3){
                                                    $turno = 'manhã';
                                                }else{
                                                    $turno = 'tarde';
                                                }
                                                echo '<option value="'.$listar->id_evento.'">'.$listar->titulo_evento.' ('.$turno.')</option>';    
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
                <div class="panel panel-default">
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
                                            echo '<b>Curso: </b><span class="subtitulo">'.$listar->titulo_evento.'</span>';
                                            echo '</div><div class="col-sm-3"><b>Vagas disponíveis: </b><span class="subtitulo">'.$listar->vagas_evento.'</span></div>';
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
$sql = $pdo->prepare("SELECT * FROM usuario INNER JOIN matricula INNER JOIN turma WHERE usuario.id_usuario = matricula.fk_id_usuario AND matricula.fk_id_evento = $idcurso AND usuario.fk_id_turma = turma.id_turma ORDER BY turma.id_turma,usuario.nome_usuario ASC");
                                        $sql->execute();
                                        $qtdlinha = $sql->rowCount();
                                        if($qtdlinha > 0){
                                            $linha = $sql->fetchAll(PDO::FETCH_OBJ);
                                            foreach($linha as $listar){
                                                $cont++;
                                                $matricula = $listar->login_usuario;
                                                $nome = $listar->nome_usuario;
                                                $turma = $listar->nome_turma;
                                                $turno = $listar->turno_turma;
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
    <script src="js/bootstrap-confirmation.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>