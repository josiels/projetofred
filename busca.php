<?php
require_once("conexao/seguranca.php");
protegePagina();
date_default_timezone_set('America/Recife');

// Recebe o valor enviado
$valor = (isset($_GET['valor'])) ? $_GET['valor'] : '';

$pdo = conectar();
if(!(empty($valor)) && is_numeric($valor)){
      $sql = $pdo->prepare("SELECT * FROM cliente WHERE cliente.cpf_cliente LIKE '%".$valor."%'");
      $sql->execute();
      $quantidadeL = $sql->rowCount();
      if($quantidadeL>0){
        echo "<br /><span class='badge badge-jos'>Total: ".$quantidadeL."</span>";
        echo "<br /><br />";
        echo "<div class='row'>";
        echo "<div class='col-md-2'>CPF</div>";
        echo "<div class='col-md-6'>Nome</div><br /></div>";
        while ($nomeL = $sql->fetch(PDO::FETCH_OBJ)) {
          echo "<div class='row'>";
          echo "<a href=cliente?codcliente=".$nomeL->id_cliente.">";
          echo "<div class='col-md-2'>".$nomeL->cpf_cliente."</div>";
        	echo "<div class='col-md-9'>".$nomeL->nome_cliente."</div></a></div>";
        }
      }else{
        echo "<p>... nenhum resultado encontrado!</p>";
      }
}
elseif(!(empty($valor)) && is_string($valor)){
      $sql = $pdo->prepare("SELECT * FROM cliente WHERE cliente.nome_cliente LIKE '%".$valor."%'");
      $sql->execute();
      $quantidadeL = $sql->rowCount();
      if($quantidadeL>0){
        echo "<br /><span class='badge badge-jos'>Total: ".$quantidadeL."</span>";
        echo "<br /><br />";
        echo "<div class='row'>";
        echo "<div class='col-md-2'>CPF</div>";
        echo "<div class='col-md-6'>Nome</div><br /></div>";
        while ($nomeL = $sql->fetch(PDO::FETCH_OBJ)) {
          echo "<div class='row'>";
          echo "<a href=cliente?codcliente=".$nomeL->id_cliente.">";
          echo "<div class='col-md-2'>".$nomeL->cpf_cliente."</div>";
        	echo "<div class='col-md-9'>".$nomeL->nome_cliente."</div></a></div>";
        }
      }else{
        echo "<p>... nenhum resultado encontrado!</p>";
      }
}
?>
