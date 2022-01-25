<?php
require_once("conexao/seguranca.php");
protegePagina();
date_default_timezone_set('America/Recife');
try {
    $PDO = conectar();
    $titulo = $_POST["titulo"];
    $dataInicio = $_POST["dataInicio"];
    $inicioInscricao = $_POST['inicioInscricao'];
    $fimInscricao = $_POST['fimInscricao'];
    $qtdCurso = $_POST['qtdCurso'];
    $situacao = 0;
    $erro = false;
    if($titulo) {
        $stmt = $PDO->prepare("INSERT INTO `atividade` VALUES(:tit, :ini, :insc, :fim, :qtd, :sit)");
        $stmt->execute(array(
          ':tit'  => $titulo,
          ':ini'  => $dataInicio,
          ':insc' => $inicioInscricao,
          ':fim'  => $fimInscricao,
          ':qtd'  => $qtdcurso,
          ':sit'  => $situacao
        ));
    }
    if (!$erro) {
        header("Location: index.php");
    }
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }