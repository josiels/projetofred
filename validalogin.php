<?php
	require_once("conexao/seguranca.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$usuario = (isset($_POST['login'])) ? $_POST['login'] : '';
		$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
		if (validaUsuario($usuario, MD5($senha)) == true) {
			header("Location: index");
		}else{
			expulsaVisitante();
		}
	}
?>
<!-- Teste do Git-->