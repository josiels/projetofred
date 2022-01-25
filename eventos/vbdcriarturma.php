<?php
require_once("conexao/seguranca.php");
protegePagina();
date_default_timezone_set('America/Recife');
try {
    if($_SESSION['nivel'] == 1){
    		if(isset($_POST['turno'])){
    			  $turno = $_POST['turno'];
            $nome  = $_POST['nome'];
            $nivel = $_POST['nivel'];

            $pdo = conectar();
    				$sql = "INSERT INTO turma VALUES (null,'$nome','$turno','$nivel')";
    				$insert = $pdo->prepare($sql);
    				if($insert->execute()){
    					$mensagem = '<span style="font-size:20pt;color: #00ff00;" class="" aria-hidden="true">&nbsp;</span>Cadastro realizado com sucesso.';
    				}
    		}
    }
    $erro = false; //Variável para indicar se há erro na extensão
    if (!$erro) {
        header("Location: cadastrarturma.php");
    }
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
