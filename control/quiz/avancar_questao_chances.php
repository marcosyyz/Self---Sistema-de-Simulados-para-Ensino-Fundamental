<?php
///********************************************** Sessions e Includes **************************************************///

include("../config.php");
include(ROOT."model/atividade.php");


$ativ = new Atividade($_SESSION['ATIVIDADE_ATUAL'],$_SESSION['ALUNO_TURMA']);

if (isset($_POST['resposta']))
  $resposta_atual = ($_POST['resposta']); 
if (isset($_POST['questao_atual']))
  $cdg_questao_anterior = $_POST['questao_atual'];


//inicializar sessoes caso nao existam
if (!isset($_SESSION['ACERTOS']))
  $_SESSION['ACERTOS'] = 0 ;
if (!isset($_SESSION['ERROS']))
  $_SESSION['ERROS'] = 0 ;
if (!isset($_SESSION['STATUS']))  
  $_SESSION['STATUS'] = 0 ;

//***********************************************************************************************************************//
  
//incrementar acertos e erros  
if ($resposta_atual == 1){
	//atualizando cdg das questoes ja feitas caso tenha acertado
	if (isset($cdg_questao_anterior)){
		//se eh o primeiro acerto				
     	if($_SESSION['ACERTOS'] == 0 ){	
		    // criar a session e gravar cdg da questao acertada
		    $_SESSION['CDG_QUESTOES_ACERTADAS'][] = $cdg_questao_anterior;
		}else{
        // se ja tem pelo menos um gravado entao incrementar o array e ja nao existir		   
			if($_SESSION['ACERTOS'] >= 1 ){
				if (!in_array($cdg_questao_anterior,$_SESSION['CDG_QUESTOES_ACERTADAS'])){
					$_SESSION['CDG_QUESTOES_ACERTADAS'][] = $cdg_questao_anterior;	
				}	
			}
		}		
	}//debug //foreach($_SESSION['CDG_QUESTOES_ACERTADAS'] as $q) echo '<br> q='.$q; 
	$_SESSION['ACERTOS'] = $_SESSION['ACERTOS'] + 1 ;
}else
	$_SESSION['ERROS'] = $_SESSION['ERROS'] + 1 ;


//*************************************************  carregar proxima questao  **************************************************//
//se existir questoes acertadas anteriormente  tirar um diff
// se nao 
//recebe toda a lista de questoes
if (isset($_SESSION['CDG_QUESTOES_ACERTADAS'])){
  $Questoes_restantes = array_diff($ativ->lista_Questoes, $_SESSION['CDG_QUESTOES_ACERTADAS']);
	//se todas as questoes ja foram feitas o diff acima ira retornar null	
	if (!isset($Questoes_restantes))
		$Questoes_restantes[0] = 0 ;
	}
else	
  $Questoes_restantes  = $ativ->lista_Questoes;
  
shuffle($Questoes_restantes);
$proxima_questao = $Questoes_restantes[0];

/*print_r($proxima_questao);
echo '<br>';
print_r($Questoes_restantes);*/

//nao repetir a questao anterior a nao ser que seja a ultima questao da atividade
if(($proxima_questao == $cdg_questao_anterior) && (count($Questoes_restantes) > 1))
  $proxima_questao = $Questoes_restantes[1];

//******************************************************************************************************************************//
//******************************************************************************************************************************//



//******************************************************************************************************************************//
//********************                 Redirecionar para continuar ou finalizar  *************************************///
//******************************************************************************************************************************//

$finalizar = ($_SESSION['ERROS'] == 100);
$ganhou = ($_SESSION['ACERTOS'] == $_SESSION['QTD_QUESTOES']); 


if ((!isset($proxima_questao))||(($proxima_questao) == 0)){
  $_SESSION['STATUS']= -1;//acabou as questoes
  $finalizar = true;
}

if($ganhou) 
 $_SESSION['STATUS']= 1;//ganhou


if($finalizar) {
  //echo  $_SESSION['STATUS'];
  header("Location: ".ROOT_URL."control/quiz/finalizar_atividade.php"); 
}
else {                                
  header("Location: ".ROOT_URL."view/quiz/vquiz.php?q=".$proxima_questao); 
	}