<?php
	require_once("conexao/seguranca.php");
	require_once('modelos/constantes.php');
	protegePagina();
	#Expulsa o usuario se não for operador
	if($_SESSION['nivel'] == 0){
			header("Location:aluno.php");
	}
	date_default_timezone_set('America/Recife');

	$nivel = $_POST['nivel'];
	$pdo = conectar();

	echo '<label for="nome">Turma</label>';
	echo '<select required class="form-control" id="nome" name="nome">';
	echo '<option value="-1" disabled selected>Selecione...</option>';

	$buscar=$pdo->prepare("SELECT * FROM turma_geral WHERE turma_geral.nivel = $nivel");
	$buscar->execute();
	if($buscar->rowCount() > 0){
		$linha = $buscar->fetchAll(PDO::FETCH_OBJ);
	}

	if($nivel == 1){
		foreach ($linha as $val){
			echo '<option value="'.$val->nome_turma.'">'.$val->nome_turma.'</option>';
		}
	}elseif($nivel == 2){
		foreach ($linha as $val){
			echo '<option value="'.$val->nome_turma.'">'.$val->nome_turma.'</option>';
		}
	}else{
		foreach ($linha as $val){
			echo '<option value="'.$val->nome_turma.'">'.$val->nome_turma.'</option>';
		}
	}
	echo	'</select>';
?>
