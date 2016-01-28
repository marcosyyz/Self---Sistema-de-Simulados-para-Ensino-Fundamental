<?php

include_once('../../config.php');
include(ROOT."model/admin/admin_aluno.php");
include(ROOT."model/admin/materia.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");

  


$aluno = new Admin_Aluno();    

$turmas = $Turma->lista_turmas($_SESSION['ESCOLA']);

$action_pesquisa = ROOT_URL.'control/cadastros/alunos/lista_alunos.php';



include ROOT."view/admin/vbloqueio.php";
?>