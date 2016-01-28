<?php

include_once('../../../config.php');
include(ROOT."model/escola.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");


$usuario_cdg =  isset($_GET['u'])?  $_GET['u'] : -1;
//ja esta declarado no header
//$usuario = new Turma();//

$Usuario = New Admin_Usuario();
$Usuario->setCDG($usuario_cdg);
$Escola = New Escola($_SESSION['ESCOLA']);


$Usuario->carregar_dados($usuario_cdg);

$nome =  $Usuario->getNome();
$login =  $Usuario->getLogin();
$senha = $Usuario->getSenha();
$cargo = $Usuario->getCargo();
$dtcriacao = $Usuario->getDtCriacao();
$tipo = $Usuario->getTipo();


       
        




include ROOT."view/cadastros/usuarios/vedit_usuario.php";
?>