<?php

///********************************************** Sessions e Includes **************************************************///

include_once('../../config.php');
include(ROOT."model/atividade.php");
include(ROOT."model/crono.php");
//******************************************************************************************************************//          
if (!isset($_SESSION['ATIVIDADE_ATUAL'])){
    echo " Session ATIVIDADE_ATUAL nao setada";
    die;
}

Crono::setFim(date("H:i:s"));

// se for aluno finaliza atividade com perda
if(isset($_SESSION['ALUNO_CDG'])){
    $ativ = new Atividade($_SESSION['ATIVIDADE_ATUAL'],$_SESSION['ALUNO_TURMA']);    
    $ativ->finalizar($_SESSION['ALUNO_CDG'], 
                     $_SESSION['ACERTOS'], 
                     $_SESSION['ERROS'],
                     $_SESSION['QTD_QUESTOES'],
                     Crono::calcular_segundos_gasto(),
                     0); // 0 = perdeu
   
}


header("Location: ".ROOT_URL."view/quiz/vgameover_atividade.php"); 

