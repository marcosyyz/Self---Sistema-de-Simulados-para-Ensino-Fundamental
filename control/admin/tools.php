<?php
include_once('../../config.php');
include(ROOT."model/admin/turma.php");


$turma_cdg =  isset($_GET['t'])?  $_GET['t'] : -1;
$valor_bloqueio =  isset($_GET['b'])?  $_GET['b'] : -1;


if($valor_bloqueio != -1){   
    $Turma = New Turma();
    $Turma->bloquear_turmas($turma_cdg,$valor_bloqueio,$_SESSION['ESCOLA']);

    header('Location: '.ROOT_URL.'control/admin/bloqueio.php');
    
}


