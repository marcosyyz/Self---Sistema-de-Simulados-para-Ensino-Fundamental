<?php

///********************************************** Sessions e Includes **************************************************///

include('../../config.php');
include(ROOT."model/atividade.php");
include(ROOT."model/crono.php");
//******************************************************************************************************************//          
if (!isset($_SESSION['ATIVIDADE_ATUAL'])){
    echo " Session ATIVIDADE_ATUAL nao setada";
//    die;
}

Crono::setFim(date("H:i:s"));


// se for aluno finaliza atividade
if(isset($_SESSION['ALUNO_CDG'])){
    $ativ = new Atividade($_SESSION['ATIVIDADE_ATUAL'],$_SESSION['ALUNO_TURMA']);
    $ativ->finalizar($_SESSION['ALUNO_CDG'], 
                     $_SESSION['ACERTOS'], 
                     $_SESSION['ERROS'],
                     $_SESSION['QTD_QUESTOES'],
                     Crono::calcular_segundos_gasto());
}

// se tiver aluno2 finaliza atividade
if(isset($_SESSION['ALUNO_CDG2'])){
    $ativ2 = new Atividade($_SESSION['ATIVIDADE_ATUAL'],$_SESSION['ALUNO_TURMA2']);
    $ativ2->finalizar($_SESSION['ALUNO_CDG2'], 
                     $_SESSION['ACERTOS'], 
                     $_SESSION['ERROS'],
                     $_SESSION['QTD_QUESTOES'],
                     Crono::calcular_segundos_gasto());
}



require(ROOT."view/quiz/vpremio.php"); 





