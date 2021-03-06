<?php
    require_once("conexao/seguranca.php");
    require_once('modelos/constantes.php');
    require_once("calendario/calendario.php");
    
    protegePagina();

    $total_reg = 5;
    if(isset($_GET['pagina'])){
        $pc = $_GET['pagina'];
    }else{
        $pc = "1";
    }
    $inicio = $pc - 1;
    $inicio = $inicio * $total_reg;

    //ordenação de exibição da tabela
    $coluna = (isset($_GET['col'])) ? $_GET['col'] : 'id';
    $ordem = (isset($_GET['ordem'])) ? $_GET['ordem'] : 'DESC';

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

    <!-- Utilizado para carregar os ícones-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- JS CSS customizado por Josiel Souza -->
    <script type="text/javascript" src="js/expandirRetrairTxt.js"></script>
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
                        <table class="table tabelaPrincipal table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-1">ID</th>
                                    <th class="col-md-3">Nome</th>
                                    <th class="col-md-5">Descrição</th>
                                    <th class="col-md-2 ">Local</th>
                                    <th class="col-md-1">
                                    <?php
                                        if($ordem == 'ASC'){
                                            $ordem = 'DESC';
                                        }else{
                                            $ordem = 'ASC';
                                        }
                                        echo '<a href="index?col=data&ordem='.$ordem.'">Data</a>';
                                        echo '</th><th class="col=md-1">';
                                        echo '<a href="index?col=permite_inscricao&ordem='.$ordem.'">Orçamento</a>';
                                    ?>
                                    </th>
                                </tr>
                            </thead>    
                            <tbody>
                            <?php
                                $pdo = conectar();
                                $sqlTotal=$pdo->prepare("SELECT * FROM evento");
                                $sqlTotal->execute();
                                $sql=$pdo->prepare("SELECT * FROM evento ORDER BY evento.`".$coluna."` ".$ordem." LIMIT ".$inicio.",".$total_reg);
                                $sql->execute();
                                $qtd_linhaTotal = $sqlTotal->rowCount();
                                $qtd_linha = $sql->rowCount();
                                $tr = $qtd_linhaTotal;
                                $tp = $tr / $total_reg;

                                if ($qtd_linha >=1){
                                    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
                                    
                                    foreach($resultado as $saida){
                                        $id = $saida->id;
                                        $nome = $saida->nome;
                                        $data = date('d/m/Y', strtotime($saida->data));
                                        $local = $saida->local;
                                        $inscricao = $saida->permite_inscricao;
                                        
                                        $descricao = strip_tags($saida->descricao);
                                        
                                        echo '<tr><td>'.$id.'</td><td><a href="evento?ev='.$id.'">'.$nome.'</a></td>';
                                        
                                        echo '<td><a class="" data-toggle="collapse" href="#'.$id.'collapse" role="button" aria-expanded="false" aria-controls="'.$id.'collapse">
                                            Ver descrição...</a><div class="collapse" id="'.$id.'collapse">
                                            <div class="card card-body">'.$descricao.'</div>
                                            </div></td>';

                                        echo '<td>'.$local.'</td><td>'.$data.'</td>';
                                        if($inscricao == 1){
                                            echo '<td><a href="evento?ev='.$id.'">Pendente</a></td></tr>';
                                        }else{
                                            echo '<td>Concluído</td></tr>';
                                        }
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <hr />
                        <h5 class="titulo-calendario"><strong>Data</strong></h5>
                        <div class="calendario">
                            <?=montaCalendario()?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 paginador">
                        <hr />
                        <?php
                            $anterior = $pc -1;
                            $proximo = $pc +1;

                            if ($pc>1) {
                                echo '<a href="?pagina='.$anterior.'&col='.$coluna.'&ordem='.$ordem.'"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Anterior</a> ';
                            }
                            echo " | ";
                            if ($pc<$tp) {
                                echo '<a href="?pagina='.$proximo.'&col='.$coluna.'&ordem='.$ordem.'">Próxima <span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a>';
                            }
                        ?>
                        <br /><br /><br /><br /><br />
                    </div>
                </div>
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
