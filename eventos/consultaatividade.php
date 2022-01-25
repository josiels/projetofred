<?php
	require_once("conexao/seguranca.php");
	require_once('modelos/constantes.php');
	protegePagina();
	if($_SESSION['nivel'] == 0){
			header("Location:aluno.php");
	}
	date_default_timezone_set('America/Recife');
	$atividade = $_POST['evento'];
	#$turno = 1;
	$pdo = conectar();
	$buscar=$pdo->prepare("SELECT evento.titulo_evento, horario.horario FROM evento INNER JOIN horario
    ON evento.fk_id_atividade = $atividade AND evento.hora_evento = horario.id_horario");
	$buscar->execute();
	$qtdlinha=$buscar->rowCount();
	if($qtdlinha <= 0){
		echo  'Nenhuma atividade cadastrada para este evento. Selecione outro!';
	}else{
			$linha = $buscar->fetchAll(PDO::FETCH_OBJ);
			foreach ($linha as $value) {
        echo "<a href='#'>".$value->titulo_evento."</a>";
        echo "<p>".$value->horario."</p><hr />";
			}
	}
?>
