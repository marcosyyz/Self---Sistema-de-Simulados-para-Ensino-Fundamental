<?php

include_once('../../config.php');
include(ROOT."model/admin/questao.php");

$questao_cdg =  isset($_GET['q'])?  $_GET['q'] : -1;
$questao = New Questao();

if($questao_cdg != -1){
    if($questao->duplicar_questao($questao_cdg)){
      header('Location: '.ROOT_URL.'view/admin/edit_questao.php?q='.$questao->ultima_questao_inserida().'&s=c');
    }
    
    
}


