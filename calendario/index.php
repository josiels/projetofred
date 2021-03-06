<?php
    require_once("../conexao/seguranca.php");
    require_once("calendario.php");
    
    $info = array(
        'tabela' => 'evento',
        'data' => 'data',
        'titulo' => 'nome',
        'id' => 'id'
    );
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <meta charset=UTF-8>
        <title>Calendário de eventos</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
    <div class="calendario">
     <?php 
         $eventos = montaEventos($info);
         montaCalendario($eventos);
     ?>
     <div class="legends">
         <span class="legenda"><span class="blue"></span> Eventos</span>
         <span class="legenda"><span class="red"></span> Hoje</span>
     </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    </body>
</html>