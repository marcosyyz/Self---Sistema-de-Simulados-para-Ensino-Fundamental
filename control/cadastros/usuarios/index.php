<?php

include_once('../../../config.php');
include_once(ROOT."model/escola.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");


$usuario_cdg =  isset($_GET['t'])?  $_GET['t'] : -1;
//ja esta declarado no header
//$usuario = new Usuario();//

$Usuario = New Admin_Usuario();
$Escola = New Escola($_SESSION['ESCOLA']);
$usuarios = $Usuario->lista_usuarios(2,$_SESSION['ESCOLA']);

//$action_pesquisa = ROOT_URL.'control/cadastros/alunos/pesquisar.php';

include ROOT."view/cadastros/usuarios/vusuarios.php";
?>