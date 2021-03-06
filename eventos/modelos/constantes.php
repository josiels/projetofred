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
        <li class="sidebar-brand"><a href="index.php">Início</a></li>
        <li><hr class="linha-comum" /></li>
        <li><a href="criarevento.php">Criar Evento</a></li>
        <li><a href="listareventos.php">Listar Eventos</a></li>
        <li><a href="cadastraratividade.php">Cadastrar Atividade</a></li>
        <li><hr class="linha-comum" /></li>
        <li><a href="buscaraluno.php">Buscar Aluno</a></li>
        <li><a href="buscarcurso.php">Buscar Curso</a></li>
        <li><a href="listarnaoinscritos.php">Listar n&atilde;o inscritos</a></li>
        <li><hr class="linha-comum" /></li>
        <li><a href="cadastraraluno.php">Cadastrar Novo Aluno</a></li>
        <li><a href="cadastrarturma.php">Cadastrar Nova Turma</a></li>
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
