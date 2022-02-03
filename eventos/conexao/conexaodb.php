<?php
	function conect(){
		$bdnome = "";
		$usuario = "root";
		$password = "";
		$endereco = "localhost";
		try{
			$pdo = new PDO("mysql:host=$endereco;dbname=$bdnome;","$usuario","$password");
		}
		catch(PDOException $e){
			//var_dump($e);
			echo $e->getMessage();
		}
		return $pdo;
	}
?>
