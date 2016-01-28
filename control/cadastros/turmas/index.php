<?php

include_once('../../../config.php');
include_once(ROOT."model/escola.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");


$turma_cdg =  isset($_GET['t'])?  $_GET['t'] : -1;
//ja esta declarado no header
//$turma = new Turma();//


$Escola = New Escola($_SESSION['ESCOLA']);
$turmas = $Turma->lista_turmas($_SESSION['ESCOLA']);

//$action_pesquisa = ROOT_URL.'control/cadastros/alunos/pesquisar.php';

include ROOT."view/cadastros/turmas/vlista_turmas.php";
?>