<?php
    require_once('modelos/constantes.php');
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

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- CSS customizado por Josiel Souza -->
    <link href="css/estilojss.css" rel="stylesheet">

    <style>
      body{
background: red; /* For browsers that do not support gradients */
background: -webkit-radial-gradient(#FFF, #FFF, #C1CDC1); /* Safari */
background: -o-radial-gradient(#FFF, #FFF, #C1CDC1); /* Opera 11.6 to 12.0 */
background: -moz-radial-gradient(#FFF, #FFF, #C1CDC1); /* Firefox 3.6 to 15 */
background: radial-gradient(#FFF, #FFF, #C1CDC1); /* Standard syntax */
      }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">

        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1><?=nome_empresa_editado?></h1>
                <hr />

                <!-- Corpo Principal da página-->

                <div class="container text-center col-md-4">
                    <div class="card card-body">
                        <h4 class="card-text">Entrar</h4>
                        <hr class="linha-comum-clara" />
                        <form id="" name="" action="validalogin.php" method="POST">
                            <input class="form-control" type="text" name="login" placeholder="Login" autofocus>
                            <br />
                            <input class="form-control" type="password" name="senha" placeholder="Senha">
                            <br />
                            <div class="action" style="text-align:right !important;">
                                <input class="btn btn-primary signup" type="submit" name="logar" value="&nbsp; Logar &nbsp;" />
                            </div>
                        </form>
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
