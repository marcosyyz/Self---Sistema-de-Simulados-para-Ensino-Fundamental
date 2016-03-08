<?php
///********************************************** Sessions e Includes **************************************************///

include("../../../config.php");
include(ROOT."model/atividade.php");
include(ROOT."model/admin/questao_digitar.php");


if(!isset($_SESSION['ATIVIDADE_ATUAL'])){
    ?>
<script>
    window.close();    
</script>
<?php
}
     



$ativ = new Atividade($_SESSION['ATIVIDADE_ATUAL'],
                      isset($_SESSION['ALUNO_TURMA']) ? $_SESSION['ALUNO_TURMA'] : -1);

//if (isset($_POST['resposta1']))
//  $resposta1 = ($_POST['resposta1']); 

$resposta1 = isset($_POST['resposta1']) ? html_entity_decode(utf8_decode($_POST['resposta1'])) : '-1';
$resposta2 = isset($_POST['resposta2']) ? html_entity_decode(utf8_decode($_POST['resposta2'])) : '-1';
$resposta3 = isset($_POST['resposta3']) ? html_entity_decode(utf8_decode($_POST['resposta3'])) : '-1';
$resposta4 = isset($_POST['resposta4']) ? html_entity_decode(utf8_decode($_POST['resposta4'])) : '-1';
$resposta5 = isset($_POST['resposta5']) ? html_entity_decode(utf8_decode($_POST['resposta5'])) : '-1';


if (isset($_POST['questao_atual'])){
  $cdg_questao_anterior = $_POST['questao_atual'];
  $questal_atual = new Questao_Digitar($_POST['questao_atual']); 
}else{
    echo 'Questao atual nao definida ';
    die;
}



$resposta_correta1 =  isset($questal_atual->campo->QUESTAODIGITAR_LACUNA1) ? html_entity_decode(utf8_decode($questal_atual->campo->QUESTAODIGITAR_LACUNA1)) : '-1' ;
$resposta_correta2 =  isset($questal_atual->campo->QUESTAODIGITAR_LACUNA2) ? html_entity_decode(utf8_decode($questal_atual->campo->QUESTAODIGITAR_LACUNA2)) : '-1' ;
$resposta_correta3 =  isset($questal_atual->campo->QUESTAODIGITAR_LACUNA3) ? html_entity_decode(utf8_decode($questal_atual->campo->QUESTAODIGITAR_LACUNA3)) : '-1' ;
$resposta_correta4 =  isset($questal_atual->campo->QUESTAODIGITAR_LACUNA4) ? html_entity_decode(utf8_decode($questal_atual->campo->QUESTAODIGITAR_LACUNA4)) : '-1' ;
$resposta_correta5 =  isset($questal_atual->campo->QUESTAODIGITAR_LACUNA5) ? html_entity_decode(utf8_decode($questal_atual->campo->QUESTAODIGITAR_LACUNA5)) : '-1' ;

//inicializar sessoes caso nao existam
if (!isset($_SESSION['ACERTOS']))
  $_SESSION['ACERTOS'] = 0 ;
if (!isset($_SESSION['ERROS']))
  $_SESSION['ERROS'] = 0 ;
if (!isset($_SESSION['STATUS']))  
  $_SESSION['STATUS'] = 0 ;

//***********************************************************************************************************************//
/********************************************** funcoes para tratar  acentos nas respostas *****************************************************************/
/***************************************************************************************************************/
function is_utf8( $string ){
	return preg_match( '%^(?:
		 [\x09\x0A\x0D\x20-\x7E]
		| [\xC2-\xDF][\x80-\xBF]
		| \xE0[\xA0-\xBF][\x80-\xBF]
		| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
		| \xED[\x80-\x9F][\x80-\xBF]
		| \xF0[\x90-\xBF][\x80-\xBF]{2}
		| [\xF1-\xF3][\x80-\xBF]{3}
		| \xF4[\x80-\x8F][\x80-\xBF]{2}
		)*$%xs',
		$string
	);
}
  

function removeAccents( $string ){
	return preg_replace(
		array(
			//Maiúsculos
			'/\xc3[\x80-\x85]/',
			'/\xc3\x87/',
			'/\xc3[\x88-\x8b]/',
			'/\xc3[\x8c-\x8f]/',
			'/\xc3([\x92-\x96]|\x98)/',
			'/\xc3[\x99-\x9c]/',

			//Minúsculos
			'/\xc3[\xa0-\xa5]/',
			'/\xc3\xa7/',
			'/\xc3[\xa8-\xab]/',
			'/\xc3[\xac-\xaf]/',
			'/\xc3([\xb2-\xb6]|\xb8)/',
			'/\xc3[\xb9-\xbc]/',
		),
		str_split( 'ACEIOUaceiou' , 1 ),
		is_utf8( $string ) ? $string : utf8_encode( $string )
	);
};


function strAcentosToUpper($string){
  $resultado = '';  
  for ($i = 0; $i < strlen($string); $i++){
    switch ($string[$i]){
      case utf8_decode('á'): $string[$i] = utf8_decode('Á');
                break;    
      case utf8_decode('à'): $string[$i] = utf8_decode('À');
                break;
      case utf8_decode('â'): $string[$i] = utf8_decode('Â');
                break;
      case utf8_decode('ã'): $string[$i] = utf8_decode('Ã');
                break;
      case utf8_decode('ä'): $string[$i] = utf8_decode('Ä');
                break;
      case utf8_decode('é'): $string[$i] = utf8_decode('É');
                break;
      case utf8_decode('è'): $string[$i] = utf8_decode('È');
                break;
      case utf8_decode('ê'): $string[$i] = utf8_decode('Ê');
                break;
      case utf8_decode('ë'): $string[$i] = utf8_decode('Ë');
                break;
      case utf8_decode('í'): $string[$i] = utf8_decode('Í');
                break;
      case utf8_decode('ì'): $string[$i] = utf8_decode('Ì');
                break;
      case utf8_decode('î'): $string[$i] = utf8_decode('Î');
                break;
      case utf8_decode('ï'): $string[$i] = utf8_decode('Ï');
                break;
      case utf8_decode('ó'): $string[$i] = utf8_decode('Ó');
                break;
      case utf8_decode('ò'): $string[$i] = utf8_decode('Ò');
                break;
      case utf8_decode('õ'): $string[$i] = utf8_decode('Õ');
                break;
      case utf8_decode('ô'): $string[$i] = utf8_decode('Ô');
                break;
      case utf8_decode('ö'): $string[$i] = utf8_decode('Ö');
                break;
      case utf8_decode('ç'): $string[$i] = utf8_decode('Ç');
                break;
      case utf8_decode('ú'): $string[$i] = utf8_decode('Ú');
                break;
      case utf8_decode('ù'): $string[$i] = utf8_decode('Ù');
                break;
      case utf8_decode('û'): $string[$i] = utf8_decode('Û');
                break;
      case utf8_decode('ü'): $string[$i] = utf8_decode('Ü');
                break;      
    }
     
    $resultado .= $string[$i]; 
     //á     
     //àâãäªÁÀÂÃÄéèêëÉÈÊËíìîïÍÌÎÏóòôõöºÓÒÔÕÖúùûüÚÙÛÜçÇÑñ
  }    
  return strtoupper($resultado);
}

function temAcento($string) 
{ 
    $regExp = "#[áàâãäªÁÀÂÃÄéèêëÉÈÊËíìîïÍÌÎÏóòôõöºÓÒÔÕÖúùûüÚÙÛÜçÇÑñ]#";
    return (preg_match($regExp,utf8_encode($string)) == 1); 
} 
/***************************************************************************************************************/
/***************************************************************************************************************/


//remover acentos se tiver //
// e se o tipo da atividade não for de verificar os acentos //

if($_SESSION['VERIFICA_ACENTUACAO'] == 0){
    if(temAcento($resposta1)):
        $resposta1 = removeAccents($resposta1);
    endif;    
    if(temAcento($resposta_correta1)):
        $resposta_correta1 = removeAccents($resposta_correta1);
    endif;

    if ($resposta_correta2  != '-1'){
        if(temAcento($resposta2))
            $resposta2 = removeAccents($resposta2);
        if(temAcento($resposta_correta2))
            $resposta_correta2 = removeAccents($resposta_correta2);
    }

    if ($resposta_correta3  != '-1'){
        if(temAcento($resposta3))
            $resposta3 = removeAccents($resposta3);
        if(temAcento($resposta_correta3))
            $resposta_correta3 = removeAccents($resposta_correta3);
    }

    if ($resposta_correta4  != '-1'){
        if(temAcento($resposta4))
            $resposta4 = removeAccents($resposta4);
        if(temAcento($resposta_correta4))
            $resposta_correta4 = removeAccents($resposta_correta4);
    }

    if ($resposta_correta5  != '-1'){
        if(temAcento($resposta5))
            $resposta5 = removeAccents($resposta5);
        if(temAcento($resposta_correta5))
            $resposta_correta5 = removeAccents($resposta_correta5);
    }
}


// ------------------------------ debug -------------------------------------
//  echo ' <meta charset="utf-8">                 ';
//echo '               <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  ';
//echo '--------------depois --------</br>';
//echo '<br>'.(trim(strtoupper($resposta1))).'<br>';
//echo (trim(strtoupper($resposta_correta))) ;


// se resposta feita igual resposta esperada , acertou


 /*   echo (trim(strtoupper($resposta1)) .'=='. trim(strtoupper($resposta_correta1))) .'<br>'.
           (trim(strtoupper($resposta2)) .'=='.  trim(strtoupper($resposta_correta2))).'<br>'.
           (trim(strtoupper($resposta3))  .'=='.  trim(strtoupper($resposta_correta))).'<br>'.
           (trim(strtoupper($resposta4))  .'=='. trim(strtoupper($resposta_correta1))).'<br>'.
           (trim(strtoupper($resposta5))  .'=='.  trim(strtoupper($resposta_correta1)));
    die;
*/

/* antigo  com problema quando a resposta tem acento ( upper no char com acento transofrma em outro cacarter)
$acertou  =  (trim(strtoupper($resposta1)) == trim(strtoupper($resposta_correta1)))
         &&  (trim(strtoupper($resposta2)) == trim(strtoupper($resposta_correta2)))
         &&  (trim(strtoupper($resposta3)) == trim(strtoupper($resposta_correta3)))
         &&  (trim(strtoupper($resposta4)) == trim(strtoupper($resposta_correta4)))
         &&  (trim(strtoupper($resposta5)) == trim(strtoupper($resposta_correta5)));
*/

$acertou  = (strcasecmp(trim(strAcentosToUpper($resposta1)), trim(strAcentosToUpper($resposta_correta1))) == 0 )
         && (strcasecmp(trim(strAcentosToUpper($resposta2)), trim($resposta_correta2)) == 0 )
         && (strcasecmp(trim(strAcentosToUpper($resposta3)), trim($resposta_correta3)) == 0 )
         && (strcasecmp(trim(strAcentosToUpper($resposta4)), trim($resposta_correta4)) == 0 )
         && (strcasecmp(trim(strAcentosToUpper($resposta5)), trim($resposta_correta5)) == 0 );



    

//echo "'".strAcentosToUpper($resposta1)."' = '".strAcentosToUpper($resposta_correta1)."'<br>";

//echo (strcasecmp(trim($resposta1),trim($resposta_correta1)) == 0) ? 1 : 0;
    
//echo $acertou ? 1 : 0;

//echo temAcento(($resposta_correta1))  ? 'tem acento' : 0 ;
 //$resposta_correta1 = removeAccents($resposta_correta1);
 //echo $resposta_correta1 ;
//die;



//incrementar acertos e erros  
if ($acertou){
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


////////////////////

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

     



//nao repetir a questao anterior a nao ser que seja a ultima questao da atividade
if(($proxima_questao == $cdg_questao_anterior) && (count($Questoes_restantes) > 1))
  $proxima_questao = $Questoes_restantes[0];




//******************************************************************************************************************************//
//********************************************sons de acerto e erro *******************************************//
if($acertou){
    $_SESSION['SOM'] = 'coin.mp3';
    $_SESSION['ACERTOU_ANTERIOR'] = 1;
}else{
    $_SESSION['SOM'] = 'crash.mp3';
    $_SESSION['ACERTOU_ANTERIOR'] = 0;
}

//******************************************************************************************************************************//
//******************************************** animação de erro *******************************************//
//se errou, mostrar dedo negativo
if(!$acertou){    
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
      echo ' location.href="'.ROOT_URL.'control/quiz/perder_atividade.php'.'";';
    }
    else { // se nao proxima questao
        if($tipo_proxima_questao == TIPO_SIMULADO) {
           echo ' location.href="'.ROOT_URL."view/quiz/vquiz.php?q=".$proxima_questao.'";'; 
        }else{
            if($tipo_proxima_questao == TIPO_DIGITAR) 
                echo ' location.href="'.ROOT_URL."view/quiz/digitar/vquiz.php?q=".$proxima_questao.'";';  
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

     //MODO: precisa acertar todas as questoes para finalizar,  errando no maximo 2 vezes
     if($_SESSION['ACERTOS']   == $_SESSION['QTD_QUESTOES']){
        header("Location: ".ROOT_URL."control/quiz/finalizar_atividade.php"); 
    }

