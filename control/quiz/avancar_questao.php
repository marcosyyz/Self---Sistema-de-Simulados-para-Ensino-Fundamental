<?php
///********************************************** Sessions e Includes **************************************************///

include("../../config.php");
include(ROOT."model/atividade.php");

if(!isset($_SESSION['ATIVIDADE_ATUAL'])){
    ?>
<script>
    window.close();    
</script>
<?php
}
     

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

foreach ($ativ->lista_questoes as $q) {
    $todas_questoes_cdg[] = $q->cdg;    
}


////se existir questoes acertadas anteriormente  tirar um diff
// se nao 
//recebe toda a lista de questoes
if (isset($_SESSION['CDG_QUESTOES_ACERTADAS'])){
  $Questoes_restantes = array_diff($todas_questoes_cdg, $_SESSION['CDG_QUESTOES_ACERTADAS']);
	//se todas as questoes ja foram feitas o diff acima ira retornar null	
	if (!isset($Questoes_restantes))
		$Questoes_restantes[0] = 0 ;
	}
else	
  $Questoes_restantes  = $todas_questoes_cdg;


////////////////////debug
//foreach ($Questoes_restantes as $q) {
 //   echo '<br>'.$q;  
//}

//shuffle nas questoes restantes
shuffle($Questoes_restantes);




//descobrir o tipo da questao a ser selecionada
foreach($ativ->lista_questoes as $q){
    //selecionar o primeiro da fila embaralhada
    if($q->cdg == $Questoes_restantes[0]){
        $proxima_questao = $q->cdg;        
        $tipo_proxima_questao = $q->tipo;                
    }
}

     

/*print_r($proxima_questao);
echo '<br>';
print_r($Questoes_restantes);*/

//nao repetir a questao anterior a nao ser que seja a ultima questao da atividade
if(($proxima_questao == $cdg_questao_anterior) && (count($Questoes_restantes) > 1))
  $proxima_questao = $Questoes_restantes[0];




//******************************************************************************************************************************//
//********************************************sons de acerto e erro *******************************************//
if($resposta_atual == 1){
    $_SESSION['SOM'] = 'coin.mp3';
    $_SESSION['ACERTOU_ANTERIOR'] = 1;
}else{
    $_SESSION['SOM'] = 'crash.mp3';
    $_SESSION['ACERTOU_ANTERIOR'] = 0;
}




//******************************************************************************************************************************//
//******************************************** animação de erro *******************************************//
//se errou, mostrar dedo negativo
if($resposta_atual != 1){    
    require_once ROOT.'view/quiz/verrou.php';
    require_once ROOT.'view/vhead.php';
    mostrar_animacao_de_erro($tipo_proxima_questao,$proxima_questao);        
}else{
    echo ' <script>';
    avancar($tipo_proxima_questao,$proxima_questao);  
    echo ' </script>';
}


//******************************************************************************************************************************//
//********************                 Regras para continuar ou finalizar                  *************************************//
//******************************************************************************************************************************//

/* $finalizar = ($_SESSION['ERROS'] == 100);
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
	}*/




//********   metodo 3 chances ************//
function avancar($tipo_proxima_questao,$proxima_questao){
    $perdeu = ($_SESSION['ERROS'] >= 3);
    //SE  perdeu direciona para control  perder atividade
    if($perdeu) {   
    //limpar som para , sera setado na pagina gameover_atividade.php  
    $_SESSION['SOM'] = '0';  
        //header("Location: ".ROOT_URL."control/quiz/perder_atividade.php"); 
        echo ' location.href="'.ROOT_URL.'control/quiz/perder_atividade.php";';
            
    }
    else { // se nao proxima questao
        if($tipo_proxima_questao == TIPO_SIMULADO) {
            //header("Location: ".ROOT_URL."view/quiz/vquiz.php?q=".$proxima_questao);     
            echo ' location.href="'.ROOT_URL.'view/quiz/vquiz.php?q='.$proxima_questao.'";'; 
        }else{
            if($tipo_proxima_questao == TIPO_DIGITAR) {
              // header("Location: ".ROOT_URL."view/quiz/digitar/vquiz.php?q=".$proxima_questao); 
               echo  ' location.href="'.ROOT_URL.'view/quiz/digitar/vquiz.php?q='.$proxima_questao.'";'; 
            }
        } 
    }
}

/*
 * //MODO simulado 
 * //se acertos + erros = total de questoes ,  finalizou a atividade        
 
if($_SESSION['ACERTOS'] + $_SESSION['ERROS'] == $_SESSION['QTD_QUESTOES']){
    header("Location: ".ROOT_URL."control/quiz/finalizar_atividade.php"); 
}
*/


        

 if($_SESSION['ACERTOS']   == $_SESSION['QTD_QUESTOES']){
    header("Location: ".ROOT_URL."control/quiz/finalizar_atividade.php"); 
}

