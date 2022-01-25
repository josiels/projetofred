<?php
	require_once("conexao/seguranca.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$usuario = (isset($_POST['login'])) ? $_POST['login'] : '';
		$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
		if (validaUsuario($usuario, $senha) == true) {
			if($_SESSION['nivel'] == 1){
			header("Location: index.php");
		}else{
			header("Location: index.php");
			}
		} else {
			expulsaVisitante();
		}
	}
?>
