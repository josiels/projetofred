<?php
	date_default_timezone_set("America/Recife");
	include 'conexao/seguranca.php';
	protegePagina();
	if($_SESSION['nivel'] == 0){
			header("Location:logout.php");
	}
try {
	  if(isset($_GET['idmatricula'])){
			$matricula = $_GET['idmatricula'];

			$matricula = $matricula/532550035;
			$erro = false;
			$pdo = conectar();
			if($matricula){
				$sql = "DELETE FROM matricula WHERE id_matricula = '$matricula'";
				$remove = $pdo->prepare($sql);
				if($remove->execute()){
						//adiciona uma vaga
					$update = $pdo->prepare("UPDATE evento SET `vagas_evento` = `vagas_evento`+1 WHERE `id_evento` = $evento");
					$update->execute();
				}
				$sql = "DELETE FROM usuario WHERE id_usuario = '$matricula'";
				$removeAluno = $pdo->prepare($sql);
				$removeAluno->execute();


			}
			if(!$erro){
	        header("Location: buscaraluno.php");
	    }
		}
} catch(PDOException $e) {
	echo 'Error: ' . $e->getMessage();
}
?>
