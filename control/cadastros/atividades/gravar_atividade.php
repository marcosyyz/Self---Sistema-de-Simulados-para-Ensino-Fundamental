<?php
require '../../../config.php';
require ROOT.'model/admin/admin_atividade.php';


$atividade_cdg = isset($_POST['atividade_cdg']) ? $_POST['atividade_cdg'] : -1;
$verificaacento = isset($_POST['verificaacento']) ?  1 : 0 ;   

$atividade_cdg =  $atividade_cdg == '' ? -1 : $atividade_cdg;

$atividade = new Admin_Atividade($atividade_cdg);



         
$atividade_inserida =  $atividade->gravar(        
        $_POST['nome'] ,
        $_POST['desc'],        
        $_POST['serie'], 
        $_POST['tipo'], 
        $_POST['ordem'], 
        $_POST['nivel'],
        $verificaacento,         
        $_SESSION['USUARIO_CDG'], 
        1,//$_POST['revisor_cdg'],  
        1, // $_POST['materia'],  
        isset($_POST['assunto']) ? $_POST['assunto'] : null        
        );



 if($atividade_inserida != -1) {
     $atividade_cdg =  $atividade_inserida ;
 }
 
  header("Location: ".ROOT_URL."control/cadastros/atividades/edit_atividade.php?a=".$atividade_cdg."&s=s");