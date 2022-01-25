<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta interativa sem refresh com AJAX</title>
<script type="text/javascript" src="funcs.js"></script>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Consulta interativa sem refresh com AJAX</h1>
<br />
<strong>Buscar Noticia:</strong><br />
<input type="text" id="busca" onkeyup="buscarNoticias(this.value)" autocomplete="off" />
<div id="resultado"></div>
<br /><br />
<div id="conteudo"></div>
</body>
</html>
