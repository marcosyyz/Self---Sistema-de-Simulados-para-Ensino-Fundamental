<?php

include_once('../../../config.php');
include(ROOT."model/admin/admin_aluno.php");
include(ROOT."model/admin/materia.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");



$turma_filtro =  isset($_GET['t']) ?  $_GET['t'] : -1;
$palavra_chave = isset($_GET['p']) ?  $_GET['p'] : '';









require ROOT.'view/cadastros/alunos/vlista_alunos.php';