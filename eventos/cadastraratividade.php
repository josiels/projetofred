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



    <script type="text/javascript">
      $(document).ready(function(){
    	$("select[name=turno]").change(function(){
    		$.post("consultahorario.php",{turno:$(this).val()},function(valor){$("#horario").html(valor);})
        $.post("consultaturma.php",{turno:$(this).val()},function(valor){$("#turma").html(valor);})
    	})
	    });
      $(document).ready(function(){
      $("select[name=evento]").change(function(){
        $.post("consultaatividade.php",{evento:$(this).val()},function(valor){$("#listaAtividade").html(valor);})
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
<div class="panel-heading"><strong>Cadastro de atividades</strong></div>
<div class="panel-body texto-formulario-cadastro col-md-9">
<form name="criarevento" action="vbdatividade.php" method="post">
  <div class="form-group col-md-8">
    <label for="evento">Evento</label>
    <select id="evento" name="evento" class="form-control" required>
        <option value="-1" selected disabled>Selecione...</option>
        <?php
            $pdo = conectar();
            $buscar=$pdo->prepare("SELECT * FROM atividade WHERE data_inicio BETWEEN curdate() - interval 30 day AND curdate() + interval 30 day ORDER BY id DESC");
            $buscar->execute();
            $linha = $buscar->fetchAll(PDO::FETCH_OBJ);
            foreach($linha as $listar){
              echo "<option value='".$listar->id."'>".$listar->nome." - (".date('d/m/Y', strtotime($listar->data_inicio)).")</option>";
            }
        ?>
    </select>
  </div>
  <div class="form-group col-md-4">
    <label for="data">Data</label>
    <input type="date" name="data" class="form-control" id="data" required>
  </div>
  <div class="form-group col-md-5">
    <label for="tema">Tema</label>
    <input type="text" name="tema" class="form-control" id="tema" placeholder="..." required>
  </div>
  <div class="form-group col-md-5">
    <label for="palestrante">Palestrante / Organizador</label>
    <input type="text" name="palestrante" class="form-control" id="palestrante" placeholder="...">
  </div>
  <div class="form-group col-md-2">
    <label for="vagas">Vagas</label>
    <input type="number" name="vagas" class="form-control" id="vagas" min="0" required>
  </div>
  <div class="form-group col-md-5">
      <label for="turno">Turno</label>
      <select class="form-control" id="turno" name="turno">
          <option value="-1" disabled selected>Selecione...</option>
  				<option value="1">Manhã</option>
          <option value="2">Tarde</option>
          <option value="3">Noite</option>
      </select>
  </div>
  <div id="horario" class="form-group col-md-12">
    <!-- aqui irá aparecer o resultado dos horários selecionados -->
  </div>

  <div id="turma" class="form-group col-md-12">
    <!-- aqui irá aparecer o resultado das turmas -->
  </div>

  <div class="form-group col-md-12">
    <button type="reset" class="btn btn-default">Limpar</button>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <hr />
  </div>
</form>
</div>
<div class="panel-body texto-formulario-cadastro col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading"><strong>Atividades cadastradas</strong></div>
    <div class="panel-body">
      <div id="listaAtividade" class="form-group col-md-12">
        <!-- aqui irá aparecer o resultado dos horários selecionados -->
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
