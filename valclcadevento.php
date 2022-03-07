<?php
require_once("conexao/seguranca.php");
date_default_timezone_set('America/Recife');

try {
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $request = md5( implode( $_POST ) );
      if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request ){
        echo 'refresh';
      }
      else{
        $_SESSION['last_request']  = $request;
                echo 'é post';
                $nome  = $_POST['nome'];

                $pdo = conectar();
                $sql = "INSERT INTO evento_temp VALUES (null,'$nome')";
                $insert = $pdo->prepare($sql);
                if($insert->execute()){
                  #echo "SIM";
                }else{
                  #echo "NÃO";
                }
      }






    		if(isset($_POST['email'])){
    			  $nome  = $_POST['nome'];

            $pdo = conectar();
    				$sql = "INSERT INTO evento_temp VALUES (null,'$nome')";
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
        #header("Location: confirmaevento");
    }
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
