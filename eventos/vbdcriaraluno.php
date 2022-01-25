<?php
require_once("conexao/seguranca.php");
protegePagina();
date_default_timezone_set('America/Recife');
try {
    if($_SESSION['nivel'] == 1){
    		if(isset($_POST['matricula'])){
    			  $matricula = $_POST['matricula'];
            $nome  = $_POST['nome'];
            $turma = $_POST['turma'];
            $nivel = $_POST['nivel'];
            $senha = $_POST['senha'];

            $pdo = conectar();
    				$sql = "INSERT INTO usuario VALUES (null,'$nome','$matricula','$senha','$nivel','$turma')";
    				$insert = $pdo->prepare($sql);
    				if($insert->execute()){
              #echo "SIM";
    				}else{
              #echo "NÃO";
            }
    		}
    }
    $erro = false; //Variável para indicar se há erro na extensão
    if (!$erro) {
        header("Location: cadastraraluno.php");
    }
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
