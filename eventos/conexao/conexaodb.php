<?php
	function conect(){
		$bdnome = "genesis_colegio_e_curso";
		$usuario = "root";
		$password = "pelopes";
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
