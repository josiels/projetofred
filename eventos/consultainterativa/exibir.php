<?php
// Incluir aquivo de conexao
include("conn.php");

// Recebe a id enviada no metodo GET
$id = $_GET['id'];
$pdo = conectar();

// Seleciona a noticia que tem essa ID
$sql = $pdo->prepare("SELECT * FROM noticias WHERE id = '".$id."'");

// Pega os dados e armazena em uma variavel
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $value) {
  $noticia = $value->conteudo;
}

// Exibe o conteudo da notica
echo $noticia;

// Acentuacao
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>
