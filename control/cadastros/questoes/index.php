<?php 

include('../../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'view/admin/vheader_admin.php');
include_once(ROOT.'model/admin/questao.php');


$pesquisa = isset($_POST['pesquisa'])?  $_POST['pesquisa'] : -1;
$descritor =  isset($_GET['d'])?  $_GET['d'] : -1;
$questao = new Questao();
        


$questoes =  $questao->lista_questoes($pesquisa,$descritor);



$action_pesquisa = ROOT_URL.'control/cadastros/questoes/index.php';

 include ROOT.'view/cadastros/questoes/vquestoes.php';
