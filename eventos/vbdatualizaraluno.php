<?php
require_once("conexao/seguranca.php");
protegePagina();
date_default_timezone_set('America/Recife');
try {
    $PDO = conectar();
    $turma   = 0;
    if(isset($_POST["idTurma"])){
      $turma   = $_POST["idTurma"];
    }
    $aluno   = $_POST["idAluno"];
    $nome    = $_POST["nome"];
    $erro = false;
    if($turma != 0){
        $stmt = $PDO->prepare('UPDATE usuario SET fk_id_turma = '.$turma.', nome_usuario = "'.$nome.'" WHERE id_usuario = '.$aluno.';');
        $stmt->execute();
      }else{
        $stmt = $PDO->prepare('UPDATE usuario SET nome_usuario = "'.$nome.'" WHERE id_usuario = '.$aluno.';');
        $stmt->execute();
      }
      if(isset($_POST["idCurso"])){
        $curso = $_POST["idCurso"];
        foreach($curso as $valor){
          $sql = $PDO->prepare("INSERT INTO `matricula` VALUES (null, '$aluno', '$valor')");
          if($sql->execute()){
            $update = $pdo->prepare("UPDATE evento SET `vagas_evento` = `vagas_evento`-1 WHERE `id_evento` = $valor");
            $update->execute();
          }
        }
     }
    if (!$erro) {
        header("Location: editaraluno.php?codigoaluno=$aluno");
    }
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
