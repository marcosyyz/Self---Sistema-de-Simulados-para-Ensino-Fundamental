<?php

include_once('../../../config.php');
include(ROOT."model/admin/admin_atividade.php");
include(ROOT."model/admin/materia.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/admin/vheader_admin.php");

$pesquisa = isset($_POST['pesquisa'])?  $_POST['pesquisa'] : -1;
$atividade_cdg =  isset($_GET['a'])?  $_GET['a'] : -1;
$atividade = new Admin_Atividade($atividade_cdg);    

$serie =  isset($atividade->serie) ? $atividade->serie : '';
$titulo =  isset($atividade->titulo) ? $atividade->titulo : '';
$descricao = isset($atividade->descricao) ? $atividade->descricao : '';
$ordem = isset($atividade->ordem) ? $atividade->ordem : '';
$tipo= isset($atividade->tipo) ? $atividade->tipo : '';
$chk_verificaacento = isset($atividade->verifica_acentuacao) ? $atividade->verifica_acentuacao : '';


$atividades = $atividade->lista_atividades($pesquisa);

$action_pesquisa = ROOT_URL.'control/cadastros/atividades/index.php';

include ROOT."view/cadastros/atividades/vatividades.php";
?>