<?php
require_once("conexao/seguranca.php");
protegePagina();
#Expulsa o usuario se não for operador
if($_SESSION['nivel'] == 0){
    header("Location:aluno.php");
}
date_default_timezone_set('America/Recife');

// Recebe o valor enviado
$valor = $_GET['valor'];

$pdo = conectar();
if(!(empty($valor)) && is_numeric($valor)){
      $sql = $pdo->prepare("SELECT * FROM usuario WHERE login_usuario LIKE '%".$valor."%'");
      $sql->execute();
      $quantidadeL = $sql->rowCount();
      if($quantidadeL>0){
        echo "<span class='badge badge-jos'>Total: ".$quantidadeL."</span>";
        echo "<hr />";
        echo "<div class='row'>";
        echo "<div class='col-md-1'>Matrícula</div>";
        echo "<div class='col-md-6'>Nome</div>";
        echo "<div class='col-md-2'>Atividade 1</div>";
        echo "<div class='col-md-3'>Atividade 2</div>";
        echo "<hr /><br /></div>";
        while ($nomeL = $sql->fetch(PDO::FETCH_OBJ)) {
            $val = $nomeL->fk_id_turma;
            $sql2 = $pdo->prepare("SELECT turma.nome_turma,turno.nome FROM turma INNER JOIN turno ON turma.id_turma = ".$val." AND turma.turno_turma = turno.id ");
            $sql2->execute();
            $sqlResultado = $sql2->fetchAll(PDO::FETCH_OBJ);
            $nomeTurma = '';
            foreach($sqlResultado as $var){
                $nomeTurma = $var->nome_turma." ".$var->nome;
            }
          echo "<div class='row'>";
          echo "<a href=editaraluno.php?codigoaluno=".$nomeL->id_usuario.">";
          echo "<div class='col-md-1'>".$nomeL->login_usuario."</div>";
        	echo "<div class='col-md-6'>".$nomeL->nome_usuario." - ".$nomeTurma."</div></a>";
          $sql_evento = $pdo->prepare('SELECT * FROM matricula INNER JOIN evento WHERE matricula.fk_id_usuario = '.$nomeL->id_usuario.' AND evento.id_evento = matricula.fk_id_evento ORDER BY id_matricula DESC LIMIT 2');
          $sql_evento->execute();
          $eventos = $sql_evento->fetchAll(PDO::FETCH_OBJ);
          foreach ($eventos as $var) {
              echo "<div class='col-md-2'>";
              $titulo_evento = $var->titulo_evento;
              $titulo_evento = substr($titulo_evento, 0, 35);
              if(strlen($titulo_evento) > 34){
                $titulo_evento = $titulo_evento."...";
              }
              echo "<a href=buscarevento.php?codigoevento=".$var->fk_id_evento.">".$titulo_evento."</a></div>";
          }
          echo "<hr /></div>";
        }
      }else{
        echo "<p>... nenhum resultado encontrado!</p>";
      }
}
elseif(!(empty($valor)) && is_string($valor)){
      $sql = $pdo->prepare("SELECT * FROM usuario WHERE nome_usuario LIKE '%".$valor."%'");
      $sql->execute();
      $quantidade = $sql->rowCount();
      if($quantidade>0){
        echo "<span class='badge badge-jos'>Total: ".$quantidade."</span>";
        echo "<hr />";
        echo "<div class='row'>";
        echo "<div class='col-md-1'>Matrícula</div>";
        echo "<div class='col-md-6'>Nome</div>";
        echo "<div class='col-md-2'>Atividade 1</div>";
        echo "<div class='col-md-3'>Atividade 2</div>";
        echo "<hr /><br /></div>";
        while ($nome = $sql->fetch(PDO::FETCH_OBJ)) {
            $val = $nome->fk_id_turma;
            $sql2 = $pdo->prepare("SELECT turma.nome_turma,turno.nome FROM turma INNER JOIN turno ON turma.id_turma = ".$val." AND turma.turno_turma = turno.id ");
            $sql2->execute();
            $sqlResultado = $sql2->fetchAll(PDO::FETCH_OBJ);
            $nomeTurma = '';
            foreach($sqlResultado as $var){
                $nomeTurma = $var->nome_turma." ".$var->nome;
            }
            
          echo "<div class='row'>";
          echo "<a href=editaraluno.php?codigoaluno=".$nome->id_usuario.">";
          echo "<div class='col-md-1'>".$nome->login_usuario."</div>";
        	echo "<div class='col-md-6'>".$nome->nome_usuario." - ".$nomeTurma."</div></a>";
          $sql_evento = $pdo->prepare('SELECT * FROM matricula INNER JOIN evento WHERE matricula.fk_id_usuario = '.$nome->id_usuario.' AND evento.id_evento = matricula.fk_id_evento ORDER BY id_matricula DESC LIMIT 2');
          $sql_evento->execute();
          $eventos = $sql_evento->fetchAll(PDO::FETCH_OBJ);
          foreach ($eventos as $var) {
              echo "<div class='col-md-2'>";
              $titulo_evento = $var->titulo_evento;
              $titulo_evento = substr($titulo_evento, 0, 35);
              if(strlen($titulo_evento) > 34){
                $titulo_evento = $titulo_evento."...";
              }
              echo "<a href=buscarevento.php?codigoevento=".$var->fk_id_evento.">".$titulo_evento."</a></div>";
          }
          echo "<hr /></div>";
        }
      }else{
        echo "<p>... nenhum resultado encontrado!</p>";
      }
}
?>
