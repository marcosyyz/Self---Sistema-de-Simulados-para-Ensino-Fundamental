<?php
/*
  tipo_progresso = 0  ,  apos perder as 3 chances volta para o começo do mesmo exercicio
  tipo_progresso = 1  ,  apos perder as 3 chances volta para a tela home do nivel
  tipo_progresso = 2  ,  acertando ou errando, vai pra proxima questao

*/
///********************************************** Sessions, variaveis e Includes **************************************************///

include('../../config.php');
include(ROOT."model/atividade.php");
include(ROOT."model/crono.php");

$tipo_progresso =  isset($_GET['t']) ? $_GET['t'] : 0 ;
$_SESSION['TIPO_PROGRESSO'] = $tipo_progresso;

if (isset($_GET['a'])){
  $atividade_atual = ($_GET['a']); 
}else{
  echo "Codigo da atividade nao enviado";
  exit;
}

$ativ = new Atividade($atividade_atual,$_SESSION['ALUNO_TURMA']);
//***********************************************************************************//

//Zerar sessions
$ativ->iniciar_sessoes();

//$ativ = new Atividade($atividade_atual,$_SESSION['ALUNO_TURMA']);
$lista_questoes =($ativ->lista_questoes);

if( sizeof($lista_questoes)  < 1) {
    echo 'Atividade '.$atividade_atual.' não tem questoes cadastradas ';
    die;
}
    

shuffle($lista_questoes);
$questao_inicial = $lista_questoes[0]->cdg;
$tipo_questao_inicial = $lista_questoes[0]->tipo;

Crono::setInicio(date("H:i:s"));


//******************************************************************************************************************************//
//********************                 Redirecionar para continuar ou finalizar  *************************************///
//******************************************************************************************************************************//

if($tipo_questao_inicial == TIPO_SIMULADO) {
    header("Location: ".ROOT_URL."view/quiz/vquiz.php?q=".$questao_inicial); 
}else{
    if($tipo_questao_inicial == TIPO_DIGITAR) 
        header("Location: ".ROOT_URL."view/quiz/digitar/vquiz.php?q=".$questao_inicial); 
}
//header("Location: ".ROOT_URL."/control/teste.php"); 
