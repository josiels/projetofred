<?php
	date_default_timezone_set("America/Recife");
	include 'conexao/seguranca.php';
	protegePagina();
	if($_SESSION['nivel'] != 0){
			header("Location:index.php");
	}
try {
	  if(isset($_GET['idevento'])){
			$evento = $_GET['idevento'];
			$matricula = $_GET['idmatricula'];

			$evento = $evento/532550035;
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
			}
			if(!$erro){
	        header("Location: aluno.php");
	    }
		}
} catch(PDOException $e) {
	echo 'Error: ' . $e->getMessage();
}
?>
