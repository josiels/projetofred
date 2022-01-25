<?php
require_once("conexao/seguranca.php");
protegePagina();
date_default_timezone_set('America/Recife');
if($_SESSION['nivel'] == 1){
		if(isset($_POST['evento'])){
			foreach($_POST['horario'] as $horario){
		    $mensagem    = $_SESSION['nivel'];
        $evento      = $_POST['evento'];
        $data        = $_POST['data'];
				$palestrante = $_POST['palestrante'];
        $tema        = $_POST['tema'];
        $turno       = $_POST['turno'];
				$vagas       = $_POST['vagas'];

        $pdo = conectar();
				$sql = "INSERT INTO evento VALUES (null,'$tema','$evento','$palestrante','$vagas','$horario', '$data', '$turno')";
				$insert = $pdo->prepare($sql);

				//$insert->execute();
				if($insert->execute()){
					$mensagem = '<span style="font-size:20pt;color: #00ff00;" class="glyphicon glyphicon-ok" aria-hidden="true">&nbsp;</span>Cadastro realizado com sucesso.';
					$sql = $pdo->prepare("SELECT `id_evento` FROM evento WHERE `evento`.`titulo_evento` = '$tema'");
					$sql->execute();
					$result = $sql->fetchAll(PDO::FETCH_OBJ);
					foreach ($result as $litar) {
						$id_evento = $litar->id_evento;
					}
					foreach ($_POST['turma'] as $turma) {
						$sql2 = "INSERT INTO curso_turma VALUES(null, '$id_evento', '$turma')";
						$insert = $pdo->prepare($sql2);
						$insert->execute();
					}


				}else{
					$mensagem = '<span style="font-size:20pt;color: #ff0000;" class="glyphicon glyphicon-remove" aria-hidden="true">&nbsp;</span>Erro ao cadastrar. Tente novamente.';
				}
			}
		}
	}else{
		header("Location: cadastraratividade.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Sistema Gênesis Feedback</title>
	<link rel="shortcut icon" href="http://oi66.tinypic.com/2zq8l7k.jpg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--MODAL-->
    <style type="text/css">
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
    <script type="text/javascript">
        $(window).load(function(){
            $('#myModal').modal('show');
        });
	</script>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
			  	<div class="modal show" id="myModal" role="dialog">
			    	<div class="modal-dialog">
				      	<!-- Modal content-->
				      	<div class="modal-content">
				        	<div class="modal-header">
				          		<h4 class="modal-title">Cadastro de Atividades</h4>
				        	</div>
				        	<div class="modal-body">
				          		<p style="text-align: center;"><?=$mensagem?></p>
				        	</div>
				      	</div>
			    	</div>
			  	</div>
			</div>
		</div>
	</div>

	<script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript">
	    window.setTimeout("location.href='cadastraratividade.php';", 2000);
    </script>
</body>
</html>
