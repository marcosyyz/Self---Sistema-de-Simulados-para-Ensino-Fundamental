<?php

include_once('../../../config.php');
include(ROOT."model/escola.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");


$turma_cdg =  isset($_GET['t'])?  $_GET['t'] : -1;
//ja esta declarado no header
//$turma = new Turma();//


$Professor = New Admin_Usuario();
$Escola = New Escola($_SESSION['ESCOLA']);

$professores = $Professor->lista_usuarios(1,$_SESSION['ESCOLA']);
$Turma->carregar_turma($turma_cdg);

$nome =  $Turma->getNome();
$numero =  $Turma->getSerie();
$ano = $Turma->getAno();
$letra = $Turma->getLetra();
$prof_cdg = $Turma->getProfCDG();

/*$titulo =  isset($Turma->ano) ? $Turma->ano : '';
$descricao = isset($Turma->nome) ? $Turma->nome : '';
$ordem = isset($Turma->prof) ? $Turma->prof : '';
$tipo= isset($Turma->tipo) ? $Turma->tipo : '';
$nivel = isset($Turma->nivel) ? $Turma->nivel : '1';
*/
   
       
        




include ROOT."view/cadastros/turmas/vedit_turma.php";
?>