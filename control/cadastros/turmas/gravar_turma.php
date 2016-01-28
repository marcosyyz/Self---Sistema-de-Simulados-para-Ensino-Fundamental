<?php
require '../../../config.php';
require ROOT.'model/admin/turma.php';


$turma_cdg = isset($_POST['turma_cdg']) ? $_POST['turma_cdg'] : -1;
$letra = isset($_POST['letra']) ?  $_POST['letra'] : '' ;
$serie = isset($_POST['serie']) ?  $_POST['serie'] : '' ;
$ano = isset($_POST['ano']) ?  $_POST['ano'] : '' ;
$prof = isset($_POST['prof']) ?  $_POST['prof'] : $_SESSION['USUARIO_CDG'] ;
$redirecionar = isset($_POST['redirecionar']) ?  $_POST['redirecionar'] : 1 ;

$turma_cdg =  $turma_cdg == '' ? -1 : $turma_cdg;

$Turma = new Turma($turma_cdg);


         
$turma_inserida =  $Turma->gravar(                
        $letra,
        $serie, 
        $ano, 
        $prof,
        $_SESSION['ESCOLA'],
        $turma_cdg
        );



 if($turma_inserida != -1) {
     $turma_cdg =  $turma_inserida ;
}
 
 
 if($redirecionar == 1){
   header("Location: ".ROOT_URL."control/cadastros/turmas/edit_turma.php?t=".$turma_cdg."&s=s");
 }