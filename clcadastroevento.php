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
                <div class="row corpo">
                    <div class="col-md-4">
                    <figure>
                        <img src="img/logo_rncrono.png" alt="Logo RN CRONO">
                        <figcaption></figcaption>
                    </figure>
                    </div>
                    <div class="col-md-5">
                        <h1 class="titulo-local-h1">Cadastro de Evento</h1>
                    </div>
                    <div class="offset-md-3"></div>
                </div>
                <!-- Corpo Principal da página-->
                <div class="row">
                    <div class="form-group col-md-12">
                        <hr />
                        <!-- CONTEÚDO DO CORPO DA PÁGINA-->
                        <form name="cdtEvento" id="cdtEvento" action="#" method="POST">
                        <p>Organizador</p>
                        <div class="form-group col-md-4">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control" id="nome" autocomplete="off" placeholder="Nome completo..." required>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="text" name="" class="form-control" id="" autocomplete="off" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="contato">Contato</label>
                                <input type="text" name="" class="form-control" id="" autocomplete="off" placeholder="" required>
                        </div>
                        <p>Evento</p>
                        <div class="form-group col-md-4">
                                <label for="data">Data</label>
                                <input type="date" name="data" class="form-control" id="data" required>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="">Cidade</label>
                                <input type="text" name="" class="form-control" id="" autocomplete="off" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="">Modalidade</label>
                                <select name="" class="form-control" id="">
                                    <option value="">Pedestre</option>
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                                <label for="">Descrição</label>
                                <textarea name="" class="form-control" id=""></textarea>
                        </div>
                        <p>Acessórios</p>
                        <div class="form-group col-md-4">
                                <label for="">Quantidade de atletas</label>
                                <input type="number" min="0" name="" class="form-control" id=""/>
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
</body>

</html>
