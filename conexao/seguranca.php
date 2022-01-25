<?php
$_SG['conectaServidor'] = true;
$_SG['abreSessao'] = true;
$_SG['caseSensitive'] = false;
$_SG['validaSempre'] = true;
$_SG['servidor'] = 'localhost';
$_SG['usuario'] = 'root';
$_SG['senha'] = '';
$_SG['banco'] = 'fredeventos';
$_SG['paginaLogin'] = 'login.php';
$_SG['tabela'] = 'usuarios';
function conectar(){
  $bdnome = "fredeventos";
  $user = "root";
  $password = "";
  $endereco = "localhost";
  try{
    $pdo = new PDO("mysql:host=$endereco;dbname=$bdnome;","$user","$password");
  }
    catch(PDOException $e){
    echo $e->getMessage();
  }
  return $pdo;
}
if ($_SG['conectaServidor'] == true) {
  $pdo = conectar();
}
if ($_SG['abreSessao'] == true)
  session_start();
function validaUsuario($usuario, $senha) {
  global $_SG;
  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
  $nusuario = addslashes($usuario);
  $nsenha = addslashes($senha);
  $pdo = conectar();
  $sql=$pdo->prepare("SELECT * FROM ".$_SG['tabela']." WHERE ".$cS." `login_user` = '".$nusuario."' AND ".$cS." `pass_user` = '".$nsenha."' LIMIT 1");
  $sql->execute();
  $qtd_linha = $sql->rowCount();
if ($qtd_linha <=0){
return false;
}else{
$resultado = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($resultado as $saida){
$_SESSION['id'] = $saida->id_user;
$_SESSION['nome'] = $saida->nome_user;
$_SESSION['login'] = $saida->login_user;
$_SESSION['senha'] = $saida->senha_user;
$_SESSION['nivel'] = $saida->nivel_user;
#$_SESSION['turma'] = $saida->fk_id_turma;
}
if($_SG['validaSempre'] == true){}
    date_default_timezone_set("America/Recife");
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    $user = $_SESSION['login'];
    $timestamp = date('d/m/Y H:i:s', time());
    $pdo = conectar();
    #$insertip = $pdo->prepare("INSERT INTO log VALUES(null,'$remote_addr','$user','$timestamp')");
    #$insertip->execute();
return true;
}
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
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['login'], $_SESSION['senha'], $_SESSION['nivel']);
header("Location: ".$_SG['paginaLogin']);
}
