<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    protegePagina();
    #Expulsa o usuario se não for aluno
    if($_SESSION['nivel'] != 0){
        header("Location:logout.php");
    }
    date_default_timezone_set('America/Recife');
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
                   <div class="col-md-12">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title">Aviso</h3>
                        </div>
                        <div class="panel-body">
                          <?php
                            $pdo = conectar();
                            #$sql = $pdo->prepare("SELECT * FROM atividade WHERE data_inicio BETWEEN curdate() - interval 30 day AND curdate() + interval 30 day ORDER BY id DESC");
                            $sql = $pdo->prepare("SELECT * FROM atividade");
                            $sql->execute();
                            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
                            if($sql->rowCount() > 0){
                              foreach ($resultado as $listar) {
                                $evento = $listar->nome;
                                $data = $listar->inscricao_inicio;
                                $datafinal = $listar->inscricao_termino;
                              }
                              if(strtotime(date('Y-m-d')) >= strtotime($data) && strtotime(date('Y-m-d')) <= strtotime($datafinal)){
                                header("Location:aluno.php");
                                #echo "ESTÁ ENTRE";
                              }else{
                                #header("Location:logout.php");
                                #echo "DIFERENTE";
                              }
                              $timestamp = strtotime($data);
                              $data = date('d/m/Y', $timestamp);
                            }
                          ?>
                          <br />
                          <p>O evento "<strong><?=$evento?></strong>" só estará disponível apartir do dia: <span style="color:#ff751a !important;font-weight:bold;"><?=$data?></span>.</p>
                          <hr />
                          <p style="text-align:right;"><a href="logout.php" class="btn btn-success"> Voltar </a></p>
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
