<?php

include_once('../../../config.php');
include(ROOT."model/admin/admin_aluno.php");
include(ROOT."model/admin/materia.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");



$palavra_chave =  isset($_POST['pesquisa'])?  $_POST['pesquisa'] : "";

$t =  isset($_GET['t']) ?  $_GET['t'] : -1;


$texto_pesquisado = $palavra_chave;

$aluno = new Admin_Aluno();    

$alunos = $aluno->lista_alunos($_SESSION['ESCOLA'],$t,$palavra_chave );

$action_pesquisa = ROOT_URL.'control/cadastros/alunos/lista_alunos.php';


require ROOT.'view/cadastros/alunos/vlista_alunos.php';
?>