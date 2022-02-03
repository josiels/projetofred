<?php
$_SG['conectaServidor'] = true;
$_SG['abreSessao'] = true;
$_SG['caseSensitive'] = false;
$_SG['validaSempre'] = true;
$_SG['servidor'] = 'localhost';
$_SG['usuario'] = 'root';
$_SG['senha'] = '';
$_SG['banco'] = 'rncronoc_sistema';
$_SG['paginaLogin'] = 'login';
$_SG['tabela'] = 'user_admin';

session_start();

function conectar(){
  global $_SG;
  $bdnome = $_SG['banco'];
  $user = $_SG['usuario'];
  $password = $_SG['senha'];
  $endereco = $_SG['servidor'];
  try{
    $pdo = new PDO("mysql:host=$endereco;dbname=$bdnome;","$user","$password");
  }catch(PDOException $e){
    echo $e->getMessage();
  }
  return $pdo;
}

function validaUsuario($usuario, $senha) {
  global $_SG;
  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
  $nusuario = addslashes($usuario);
  $nsenha = addslashes($senha);
  $pdo = conectar();
  $sql=$pdo->prepare("SELECT * FROM ".$_SG['tabela']." WHERE ".$cS." `login_user` = '".$nusuario."' AND ".$cS." `pass_user` = '".$nsenha."' LIMIT 1");
  $sql->execute();
  $qtd_linha = $sql->rowCount();
  
  if ($qtd_linha >=1){
    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
    foreach($resultado as $saida){
      $_SESSION['id'] = $saida->id_user;
      $_SESSION['nome'] = $saida->nome_user;
      $_SESSION['login'] = $saida->login_user;
      $_SESSION['senha'] = $saida->pass_user;
    }
  }
  return true;
}

function protegePagina() {
  global $_SG;
  if (!isset($_SESSION['nome']) OR !isset($_SESSION['login'])){
    expulsaVisitante();
  }else if (!isset($_SESSION['nome']) OR !isset($_SESSION['login'])){
    if($_SG['validaSempre'] == true) {
      if(!validaUsuario($_SESSION['login'], $_SESSION['senha'])){
        expulsaVisitante();
      }
    }
  }
}

function expulsaVisitante(){
  global $_SG;
  unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['login'], $_SESSION['senha']);
  header("Location: ".$_SG['paginaLogin']);
}
