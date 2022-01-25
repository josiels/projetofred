<?php
require_once("conexao/seguranca.php");
protegePagina();
date_default_timezone_set('America/Recife');

// Recebe o valor enviado
$valor = $_GET['valor'];

$pdo = conectar();
if(!(empty($valor)) && is_string($valor)){
      $sql = $pdo->prepare("SELECT * FROM evento INNER JOIN horario ON evento.titulo_evento LIKE '%".$valor."%' AND evento.hora_evento = horario.id_horario ");
      $sql->execute();
      $quantidade = $sql->rowCount();
      if($quantidade>0){
        echo "<span class='badge badge-jos'>Total: ".$quantidade."</span>";
        echo "<hr />";
        echo "<div class='row'>";
        echo "<div class='col-md-6'>Atividade</div>";
        echo "<div class='col-md-3'>Vagas</div>";
        echo "<div class='col-md-3'>Horario</div>";
        echo "<hr /><br /></div>";
        while ($val = $sql->fetch(PDO::FETCH_OBJ)) {
          echo "<div class='row'>";
          echo "<a href=listaratividade.php?codigoatividade=".$val->id_evento.">";
          echo "<div class='col-md-6'>".utf8_encode($val->titulo_evento)."</div>";
        	echo "<div class='col-md-3'>".$val->vagas_evento. "</div>";
          echo "<div class='col-md-3'>".utf8_encode($val->horario). "</div></a>";
          echo "<hr /></div>";
        }
      }else{
        echo "<p>... nenhum resultado encontrado!</p>";
      }
}
?>
