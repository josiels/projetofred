<?php
	date_default_timezone_set("America/Recife");
	include 'conexao/seguranca.php';
	protegePagina();
	if($_SESSION['nivel'] != 0){
			header("Location:index.php");
	}
try {
	    $mensagem = $_SESSION['nivel'];
		if(isset($_GET['idevento'])){
			$evento = $_GET['idevento'];
			$aluno = $_GET['idaluno'];

			$evento = $evento/532550035;
			$aluno = $aluno/532550035;
			$erro = false;
			$pdo = conectar();
			if($evento){
				$sql = "INSERT INTO matricula VALUES (null,'$aluno','$evento')";
				$insert = $pdo->prepare($sql);
				if($insert->execute()){
					//subtrair um valor na vaga
					$update = $pdo->prepare("UPDATE evento SET `vagas_evento` = `vagas_evento`-1 WHERE `id_evento` = $evento");
					$update->execute();
				}
			}
			#$mensagem = '<span style="font-size:20pt;color: #00ff00;" class="glyphicon glyphicon-ok" aria-hidden="true">&nbsp;</span>Cadastro realizado com sucesso.';
			#}else{
			#	$mensagem = '<span style="font-size:20pt;color: #ff0000;" class="glyphicon glyphicon-remove" aria-hidden="true">&nbsp;</span>Erro ao cadastrar. Tente novamente.';
			#}
			if(!$erro){
	        header("Location: aluno.php");
	    }
		}
} catch(PDOException $e) {
	echo 'Error: ' . $e->getMessage();
}
?>
<!--
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

				      	<div class="modal-content">
				        	<div class="modal-header">
				          		<h4 class="modal-title">Cadastro de eventos</h4>
				        	</div>
				        	<div class="modal-body">
				          		<p style="text-align: center;"><=#$mensagem></p>
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
	    window.setTimeout("location.href='aluno.php';", 0);
    </script>
</body>
</html>
-->
