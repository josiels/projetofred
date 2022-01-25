<?php
date_default_timezone_set("America/Recife");
include '../mpdf60/mpdf.php';
include 'conexao/seguranca.php';
protegePagina();
#Expulsa o usuario se não for operador
if($_SESSION['nivel'] == 0){
    header("Location:aluno.php");
}
    $pdo = conectar();
    if($_SESSION['id'] > 3){
        header("Location:alunoinscrito.php");
    }
$cabecalho = '<h2 style="text-align:center">Gênesis Colégio e Curso</h2>';
$cabecalho = $cabecalho.'<h3 style="text-align:center">Projeto Ciências<strong style="color:#669999;font-size:18pt;text-align:center;font-weight:normal;"> Sustentabilidade</strong></h3>';

if(isset($_GET['idcurso'])){
    $idcurso = $_GET['idcurso'];
}else{
    $idcurso = 0;
}
$sqlevento = $pdo->prepare("SELECT * FROM evento WHERE `id_evento` = $idcurso");
$sqlevento->execute();
$linhaevento = $sqlevento->fetchAll(PDO::FETCH_OBJ);
foreach($linhaevento as $listar){
    $tituloCurso = '<h4><b>Curso: </b>'.$listar->titulo_evento.'</h4><br />';
}

$tabelaCabecalho = '<table width="700" border="1" cellpadding="5px" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Matrícula</th>
                                    <th>Nome</th>
                                    <th>Turma</th>
                                    <th>Turno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>';

$cont = 0;
$tabelaLinha = '';
$sql = $pdo->prepare("SELECT * FROM usuario INNER JOIN matricula INNER JOIN turma WHERE usuario.id_usuario = matricula.fk_id_usuario AND matricula.fk_id_evento = $idcurso AND usuario.fk_id_turma = turma.id_turma ORDER BY turma.id_turma,usuario.nome_usuario ASC");
$sql->execute();
$qtdlinha = $sql->rowCount();
if($qtdlinha > 0){
    $linha = $sql->fetchAll(PDO::FETCH_OBJ);
    foreach($linha as $listar){
        $cont++;
        $matricula = $listar->login_usuario;
        $nome = $listar->nome_usuario;
        $turma = $listar->nome_turma;
        $turno = $listar->turno_turma;
        //
        $tabelaLinha = $tabelaLinha.'<tr>'.
        '<td scope="row">'.$cont.'</td>'.
        '<td class="subtitulo">'.$matricula.'</td>'.
        '<td>'.$nome.'</td>'.
        '<td>'.$turma.'</td>'.
        '<td>'.$turno.'</td>'.'</tr>';
    }
}
//Inclusão de 5 linhas em branco para adição de alunos retardatários
for($i=0;$i<5;$i++){
    $cont++;
    $tabelaLinha = $tabelaLinha.'<tr><td>'.$cont.'</td><td></td><td></td><td></td><td></td></tr>';
}
$tabelaRodape = '</tbody></table>';
//
$conteudoCompleto = $cabecalho.$tituloCurso.$tabelaCabecalho.$tabelaLinha.$tabelaRodape;
$mpdf=new mPDF();
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($conteudoCompleto);
$mpdf->Output();
exit;
?>
