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
	#$turno = 1;
	$pdo = conectar();
	$buscar=$pdo->prepare("SELECT * FROM horario WHERE turno = $turno");
	$buscar->execute();
	$qtdlinha=$buscar->rowCount();
	if($qtdlinha <= 0){
		echo  'Nenhum hor&aacute;rio cadastrado para este turno. Selecione outro!';
	}else{
			echo '<legend style="text-align:center;">Horário</legend>';
			$linha = $buscar->fetchAll(PDO::FETCH_OBJ);
			foreach ($linha as $value) {
					echo '<div class="form-group has-success col-sm-3">
<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="horario['.$value->id_horario.']" value="'.$value->id_horario.'">
					<span class="custom-control-description">'.$value->horario.'</span></label>
					</div>';
			}
	}
?>
