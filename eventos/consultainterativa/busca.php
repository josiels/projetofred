<?php
// Incluir aquivo de conexao
include("conn.php");

// Recebe o valor enviado
$valor = $_GET['valor'];

$pdo = conectar();

if(!(empty($valor)) && is_numeric($valor)){
      $sql = $pdo->prepare("SELECT * FROM noticias WHERE matricula LIKE '%".$valor."%'");

      if(is_nan($valor)){
      	$sql = $pdo->prepare("SELECT * FROM noticias WHERE titulo LIKE '%".$valor."%'");
      }
      // Pega os dados e armazena em uma variavel
      $sql->execute();
      while ($noticias = $sql->fetch(PDO::FETCH_OBJ)) {
      	echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$noticias->id."')\">" . $noticias->titulo . "</a><br />";
      }
      // Acentuacao
      header("Content-Type: text/html; charset=ISO-8859-1",true);
}
if(!(empty($valor)) && is_string($valor)){
      $sql = $pdo->prepare("SELECT * FROM noticias WHERE titulo LIKE '%".$valor."%'");
      // Pega os dados e armazena em uma variavel
      $sql->execute();
      while ($noticias = $sql->fetch(PDO::FETCH_OBJ)) {
      	echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$noticias->id."')\">" . $noticias->titulo . "</a><br />";
      }
      // Acentuacao
      header("Content-Type: text/html; charset=ISO-8859-1",true);
}

?>
