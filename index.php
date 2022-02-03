<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    require_once("calendario/calendario.php");
    
    protegePagina();
    
    $info = array(
        'tabela' => 'evento',
        'data' => 'data',
        'titulo' => 'nome',
        'id' => 'id'
    );

    $total_reg = 5;
    if(isset($_GET['pagina'])){
        $pc = $_GET['pagina'];
    }else{
        $pc = "1";
    }
    echo $inicio = $pc - 1;
    echo $inicio = $inicio * $total_reg;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RN CRONO</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- CSS customizado por Josiel Souza -->
    <link href="css/estilojss.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?=$menu?>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    <figure>
                        <img src="img/logo_rncrono.png" alt="Logo RN CRONO">
                        <figcaption></figcaption>
                    </figure>
                    </div>
                    <div class="col-md-5">
                        <h1 class="titulo-local-h1">Painel administraivo</h1>
                    </div>
                    <div class="col-md-3">
                        <p style="color:#415A55;text-align:right;"><br /><b><?=$_SESSION['nome']?> - <a href="logout.php">Sair</a></b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr />
                        <a href="#menu-toggle" class="btn btn-warning" id="menu-toggle">Menu</a>
                        
                    </div>
                </div>
                <!-- Corpo Principal da página-->
                <div class="row corpo">
                    
                    <div class="col-md-9 evento">
                    <hr />
                    <h5 class="titulo-calendario"><strong>Eventos</strong></h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="col=md-1">ID</th>
                                    <th class="col=md-3">Nome</th>
                                    <th class="col=md-5">Descrição</th>
                                    <th class="col=md-1 ">Data</th>
                                    <th class="col=md-1">Local</th>
                                    <th class="col=md-1">Inscrição</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $pdo = conectar();
                                $sqlTotal=$pdo->prepare("SELECT * FROM evento");
                                $sql=$pdo->prepare("SELECT * FROM evento LIMIT ".$inicio.",".$total_reg);
                                $sql->execute();
                                $qtd_linhaTotal = $sqlTotal->rowCount();
                                $qtd_linha = $sql->rowCount();
                                $tr = $qtd_linhaTotal;
                                $tp = $tr / $total_reg;

                                if ($qtd_linha >=1){
                                    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
                                    foreach($resultado as $saida){
                                        echo"
                                        <tr>
                                        <td>".$saida->id."</td>
                                        <td>".$saida->nome."</td>
                                        <td>".$saida->descricao."</td>
                                        <td>".$saida->data."</td>
                                        <td>".$saida->local."</td>
                                        <td>".$saida->permite_inscricao."</td>
                                        </tr>";
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <hr />
                        <h5 class="titulo-calendario"><strong>Datas</strong></h5>
                        <div class="calendario">
                            <?php 
                                $eventos = montaEventos($info);
                                montaCalendario($eventos);
                            ?>
                            <div class="legends">
                                <span class="legenda"><span class="red"></span> Eventos</span>
                                <span class="legenda"><span class="blue"></span> Hoje</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    echo $anterior = $pc -1;
                    $proximo = $pc +1;
                    if ($pc>1) {
                        echo " <a href='?pagina=$anterior'><- Anterior</a> ";
                    }
                    echo "|";
                    if ($pc<$tp) {
                        echo " <a href='?pagina=$proximo'>Próxima -></a>";
                    }
                ?>
                <!-- Corpo Principal da página-->
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    <!-- Calendário de eventos-->
    <script type="text/javascript" src="calendario/js/jquery.js"></script>
    <script type="text/javascript" src="calendario/js/functions.js"></script>
</body>

</html>
