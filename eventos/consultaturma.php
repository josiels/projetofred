<?php
	require_once("conexao/seguranca.php");
	require_once('modelos/constantes.php');
	protegePagina();
	#Expulsa o usuario se não for operador
	if($_SESSION['nivel'] == 0){
			header("Location:aluno.php");
	}
	date_default_timezone_set('America/Recife');

	$turno = $_POST['turno'];
	$pdo = conectar();
	$buscar=$pdo->prepare("SELECT * FROM turma INNER JOIN turno WHERE turma.turno_turma = $turno AND turno.id = turno_turma ORDER BY nivel,nome_turma");
	$buscar->execute();
	$qtdlinha=$buscar->rowCount();
	if($qtdlinha <= 0){
		echo  'Nenhuma turma cadastrada para este turno. Selecione outro!';
	}else{
			echo '<legend style="text-align:center;">Turmas Autorizadas</legend>';
			$linha = $buscar->fetchAll(PDO::FETCH_OBJ);

			$escreveNivel = true;
			$mudaNivel = 0;

			foreach ($linha as $value) {
					$nivel = $value->nivel;# 1
					#$escreveNivel = true;
					if($nivel != $mudaNivel){
						$escreveNivel = true;
					}

					#exibir nível
					if($escreveNivel == true){
						if($nivel == 1){
							echo '<p align="center" style="color:#a3c2c2; !imortant; font-weight:bolder;">Fundamental 1</p>';
						}if($nivel == 2){
							echo '. <br /><br /><br /><p align="center" style="color:#a3c2c2; !imortant; font-weight:bolder;">Fundamental 2</p>';
						}if($nivel == 3){
							echo '<p align="center" style="color:#a3c2c2; !imortant; font-weight:bolder;">Médio</p>';
						}
					}
					$mudaNivel = $nivel;
					$escreveNivel = false;

					echo '<div class="form-group has-success col-sm-3">';
					echo '<label class="custom-control custom-checkbox">';
					echo '<input type="checkbox" id="'.$value->id_turma.'" class="custom-control-input" name="turma['.$value->id_turma.']" value="'.$value->id_turma.'">';
					echo '<span class="custom-control-description" for="'.$value->id_turma.'"> '.$value->nome_turma.' -<span style="font-weight:normal;"> '.$value->nome.'</span></span></div>';
			}
	}
?>
