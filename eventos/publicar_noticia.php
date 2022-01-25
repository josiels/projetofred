<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    protegePagina();
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
    <script>
        $(function () {
        $('#fileUpload').change(function() {
             $('.nomeArquivo').html('<b>Arquivo Selecionado:</b>' + $(this).val());
        });
        });
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
                <h1><?=nome_empresa_editado?></h1>
                <hr />
                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Abrir Menu</a>

                <br /><br />
                <!-- Corpo Principal da página-->
                <div class="page-content">
                  <div class="row">

                <div class="col-sm-12 card card-body">
                  <div class="">
                    <form action="salvar_noticia.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="titulo" class="col-sm-2 col-form-label col-form-label-lg">Título</label>
                            <div class="col-sm-10">
                                <input type="text" id="titulo" name="tituloNoticia" class="form-control form-control-lg" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subtitulo" class="col-sm-2 col-form-label col-form-label-lg">Subtítulo</label>
                            <div class="col-sm-10">
                                <input type="text" id="subtitulo" name="subtituloNoticia" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fileUpload" class="col-sm-2 col-form-label col-form-label-lg">Imagem</label>
                            <div class="col-sm-10">
                                <input type="file" id="fileUpload" name="imagemNoticia">
                            </div>
                        </div>
                      <div class="form-group">
                        <textarea id="txtEditor" name="txtEditor"></textarea>
                        <textarea id="textoNoticiaConteudo" name="textoNoticiaConteudo" hidden="" required="required"></textarea><br/>
                      </div>

                      <div class="form-group row">
                        <input type="reset" class="btn btn-default" value="Limpar">
                        &nbsp;
                        <input type="submit" class="btn btn-success" value="Publicar">
                        &nbsp;
                        <!--Botão removido temporariamente 11/12/2017-->
                        <!--<input type="submit" form="formulario" class="btn btn-primary" value="Visualizar">-->
                      </div>
                    </form>
                    <form action="visualizar_noticias.php" id="formulario" method="POST">
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
    <script language="javascript" type="text/javascript">
      $(document).ready( function() {
        $("#txtEditor").Editor();

        $("input:submit").click(function(){
          $('#textoNoticiaConteudo').text($('#txtEditor').Editor("getText"));
        });});
      </script>
</body>

</html>
