<?php
require_once("conexao/seguranca.php");
protegePagina();
#Expulsa o usuario se não for operador
if($_SESSION['nivel'] == 0){
    header("Location:aluno.php");
}
date_default_timezone_set('America/Recife');
// Recebe a id enviada no metodo GET
$id = $_GET['id'];
$pdo = conectar();
// Seleciona a noticia que tem essa ID
$sql = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = '".$id."'");
// Pega os dados e armazena em uma variavel
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $value) {
  $nome = $value->nome_usuario;
}
echo $nome;
?>
