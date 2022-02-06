<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    require_once("calendario/calendario.php");
    
    protegePagina();
    
    $info = array(
        'tabela' => 'evento',
        'data' => 'data',
        'titulo' => 'nome',
        'id' => 'id'
    );

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
                    <h5 class="titulo-calendario"><strong>Clientes</strong></h5>
                    <table class="table tabelaPrincipal table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th class="col=md-4">Nome</th>
                                <th class="col=md-4">Email</th>
                                <th class="col=md-1">Contato</th>
                                <th class="col=md-1">CPF</th>
                                <th class="col=md-2">Contrato</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $pdo = conectar();
                                $sql=$pdo->prepare("SELECT * FROM cliente INNER JOIN contrato,situacao_contrato WHERE cliente.id_cliente LIKE contrato.fk_cliente AND contrato.fk_situacao_contrato LIKE situacao_contrato.id ORDER BY cliente.`nome_cliente` ASC ");
                                $sql->execute();
                                $qtd_linha = $sql->rowCount();
                                
                                if ($qtd_linha >=1){
                                    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
                                    
                                    foreach($resultado as $saida){
                                        $id = $saida->id_cliente;
                                        $nome = $saida->nome_cliente;
                                        $email = $saida->email_cliente;
                                        $contato = $saida->contato_cliente;
                                        $cpf = $saida->cpf_cliente;
                                        $contrato = $saida->nome_situacao;

                                        echo '<tr>
                                                <td>'.$nome.'</td>
                                                <td>'.$email.'</td>
                                                <td>'.$contato.'</td>
                                                <td>'.$cpf.'</td>
                                                <td>'.$contrato.' (<a href="">ver contrato</a>)</td>
                                            </tr>';
                                    }
                                }else{
                                    header("Location:pagenotfound");
                                }
                            ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="col-md-3">
                        <hr />
                        <h5 class="titulo-calendario"><strong>Data</strong></h5>
                        <div class="calendario">
                            <?php 
                                $eventos = montaEventos($info);
                                montaCalendario($eventos);
                            ?>
                            <div class="legends">
                                <span class="legenda"><span class="red"></span> Eventos</span>
                                <span class="legenda"><span class="blue"></span> Hoje</span>
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

    <!-- Calendário de eventos-->
    <script type="text/javascript" src="calendario/js/jquery.js"></script>
    <script type="text/javascript" src="calendario/js/functions.js"></script>
</body>

</html>
