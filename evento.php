<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    require_once("calendario/calendario.php");
    
    protegePagina();
    
    $evento = (isset($_GET['ev'])) ? $_GET['ev'] : header("Location:pagenotfound");   
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RN CRONO</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Utilizado para carregar os ícones-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- JS CSS customizado por Josiel Souza -->
    <script type="text/javascript" src="js/expandirRetrairTxt.js"></script>
    <link href="css/estilojss.css" rel="stylesheet">
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
                    <div class="col-md-4">
                    <figure>
                        <img src="img/logo_rncrono.png" alt="Logo RN CRONO">
                        <figcaption></figcaption>
                    </figure>
                    </div>
                    <div class="col-md-5">
                        <h1 class="titulo-local-h1">Painel administraivo</h1>
                    </div>
                    <div class="col-md-3">
                        <p style="color:#415A55;text-align:right;"><br /><b><?=$_SESSION['nome']?> - <a href="logout.php">Sair</a></b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr />
                        <a href="#menu-toggle" class="btn btn-warning" id="menu-toggle">Menu</a>
                        
                    </div>
                </div>
                <!-- Corpo Principal da página-->
                <div class="row corpo">
                    <div class="col-md-9 evento">
                        <hr />
                        <h5 class="titulo-calendario"><strong>Evento</strong></h5>
                        <table class="table tabelaPrincipal table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th class="col=md-3">Nome</th>
                                <th class="col=md-5">Descrição</th>
                                <th class="col=md-3">Local</th>
                                <th class="col=md-1">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $pdo = conectar();
                                $sql=$pdo->prepare("SELECT * FROM evento WHERE evento.id LIKE ".$evento);
                                $sql->execute();
                                $qtd_linha = $sql->rowCount();
                                
                                if ($qtd_linha >=1){
                                    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
                                    
                                    foreach($resultado as $saida){
                                        $id = $saida->id;
                                        $nome = $saida->nome;
                                        $data = date('d/m/Y', strtotime($saida->data));
                                        $local = $saida->local;
                                        $descricao = strip_tags($saida->descricao);
                                    
                                        echo '<tr>
                                                <td>'.$nome.'</td>
                                                <td>'.$descricao.'</td>
                                                <td>'.$local.'</td>
                                                <td>'.$data.'</td>
                                            </tr>';
                                    }
                                }else{
                                    header("Location:pagenotfound");
                                }
                            ?>
                        </tbody>
                        </table>
                        <div class="row corpo">
                        <div class="col-md-12 evento">
                            <hr />
                            <h5 class="titulo-calendario"><strong>Orçamento</strong></h5>
                            <p>Texto ...</p>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <hr />
                        <h5 class="titulo-calendario"><strong>Data</strong></h5>
                        <div class="calendario">
                            <?=montaCalendario()?>
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

    <!-- Calendário de eventos-->
    <script type="text/javascript" src="calendario/js/jquery.js"></script>
    <script type="text/javascript" src="calendario/js/functions.js"></script>
</body>

</html>

