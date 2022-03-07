<?php

    //Título do cabeçalho das Páginas
    define('titulo_pagina','G&ecirc;nesis Eventos - '.date('Y'));

    //Nome da empresa comum
    define('nome_empresa','G&ecirc;nesis col&eacute;gio e curso');

    //Nome da empresa editado
    //define('nome_empresa_editado','<strong>G&ecirc;nesis</strong> <small class="texto-small">col&eacute;gio e curso</small>');
    //define('nome_empresa_editado','<strong>G&ecirc;nesis</strong> <small class="titulo-local-h2">col&eacute;gio e curso</small>');
    define('nome_empresa_editado','<strong>Gênesis</strong> <small class="titulo-local-h2">Colégio e Curso</small>');

    //Nome do evento
    define('nome_evento','Projeto Ci&ecirc;ncias');

    //Tema do projeto
    define('tema_projeto','Eventos estudantis '.date('Y'));

    //Subtema do projeto
    define('subtema_projeto','educa&ccedil;&atilde;o com qualidade.');

    //Menu
    $menu = '<ul class="sidebar-nav">
        <li class="sidebar-brand">
        <p>
        <figure>
          <img style="display:block !important;margin-left:auto !important;margin-right:auto !important;" src="img/logo_rncrono_mini.png" alt="RN CRONO">
        </figure></li>
        </p>
        <li><br /></li>
        <li></li>
        <li><a href="index">Início</a></li>
        <li><a href="clcadevento">Cadastrar Evento</a></li>
        <li><a href="buscarcliente">Buscar Clientes</a></li>
        <li><a href="clientes">Clientes</a></li>
        <li><hr class="linha-comum" /></li>
        <li><a href="contratos">Contratos</a></li>
        <li><hr class="linha-comum" /></li>
        <li><a href="logout.php">Sair</a></li>
        </ul>';

    //Descrição do Painel Administrativo
    define('texto_descricao','<br /><br />
    <div class="list-group">
    <a href="" class="list-group-item list-group-item-action">
      <h5 class="list-group-item-heading"><strong>Criar evento</strong></h5>
      <hr class="linha-comum-clara" />
      <p class="list-group-item-text">&#8227; Para criar novos eventos é obrigatório o preenchimento do formulário com os seguintes dados: <strong>Título do evento,Quantidade de cursos por aluno Data do Evento, Data de início e término das inscrições</strong>.</p>
    </a>
    <a href="" class="list-group-item list-group-item-action">
      <h5 class="list-group-item-heading"><strong>Cadastrar Atividade</strong></h5>
      <hr class="linha-comum-clara" />
      <p class="list-group-item-text">&#8227; Para cadastrar novas atividades primeiro selecione o evento referente aos cursos e depois preencha o formulário com os seguintes dados:<strong> Tema do curso, Data docurso, Nome do Palestrante (opcional), Quantidade de vagas disponíveis, Turno, Horário e Turmas habilitadas a assistir o curso</strong>.</p>
    </a>
</div>');





?>
