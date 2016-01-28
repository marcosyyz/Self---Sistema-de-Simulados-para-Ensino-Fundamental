<?php

$_SESSION['SOM'] = 'coin05.mp3';
include_once(ROOT . "view/vhead.php");
include_once(ROOT . "model/atividade.php");

//$ativ = new Atividade(isset($_SESSION['ATIVIDADE_ATUAL']) ? $_SESSION['ATIVIDADE_ATUAL'] : -1,$_SESSION['ALUNO_TURMA']);


if (isset($_SESSION['STATUS'])){
  if ($_SESSION['STATUS'] == -1 ) //qtd de questoes menor q o numero de acertos necessarios configurado
    echo "Acabaram as Questões para essa Atividade, Verifique suas configurações.";
  if ($_SESSION['STATUS'] == 1 ){//ganhou
    ;     
  }
  if ($_SESSION['STATUS'] == 0 ){//perdeu
    //echo " perdeu!";
      ;
  }
}else
  echo "erro: STATUS não foi definido";
	
	


	

  ?> 

 <title>SELF</title> 
 </head> 
 
 <body  data-speed="10" class="bg-Parallax">      
     
 <div id="transparente-div-home"> 
     
  <?php $acertos = isset($_SESSION['ACERTOS']) ?  $_SESSION['ACERTOS'] : 0 ;
        $erros =  isset($_SESSION['ERROS']) ? $_SESSION['ERROS'] : 0 ;
	
        echo '<div class="centro resultados" >Acertos: '.$acertos.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
	echo 'Erros: '.$erros.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';		 	 
	echo 'Total Questoes : '.$_SESSION['QTD_QUESTOES']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        
        $mensagem = '';
        if(isset($ativ)){
            //se nao tem ativ2 é pq nao tem aluno2 , entao mostra apenas os pontos do ativ1
            if(!isset($ativ2)){ 
                if($ativ->total_finalizados > 10):
                    $mensagem .= "Você já fez muito essa atividade, vamos fazer outra mais difícil? ";
                else:
                    $mensagem .= "Você ganhou ".$ativ->pontos_adicionados.
                        (($ativ->pontos_adicionados > 1) ? " pontos " : " ponto ")
                        . " ...  Continuar. ";
                endif;
            }else{            
                //se nao mostrar pontos do aluno1 e aluno2 com seus nomes
                if($ativ->total_finalizados > 10):
                    $mensagem .= $_SESSION['LOGIN'].": Já fez muito essa atividade ";
                else:
                    $mensagem .= $_SESSION['LOGIN'].": Ganhou ".$ativ->pontos_adicionados.
                        (($ativ->pontos_adicionados > 1) ? " pontos " : " ponto ")
                        . " ...  Continuar. ";
                endif;
                
                if($ativ2->total_finalizados > 10):
                    $mensagem .= "\n".$_SESSION['LOGIN2'].": Já fez muito essa atividade ";
                else:
                    $mensagem .= "\n".$_SESSION['LOGIN2'].": Ganhou ".$ativ2->pontos_adicionados.
                        (($ativ2->pontos_adicionados > 1) ? " pontos " : " ponto ")
                        . " ...  Continuar. ";
                endif;
            }
        }else{
            $mensagem .= "Você ganhou N pontos ...  Continuar";  
        }
        
 
        echo "<br><br>"
             . " <a href='".ROOT_URL."control/atividade/direcionar_proxima_fase.php'>
                    <div class='submit'>
                        <input type='submit' value='".$mensagem."' id='button-green'/>
                         <div class='".( isset($ativ2) ? "ease_maior" : "ease")."'></div>   
                    </div> 
                 </a>        
             <br>";
?>
     
<div class="final_flash">
<object type="application/x-shockwave-flash" width="100%" height="100%" > 
    <param name="movie" value="<?php echo ROOT_URL ?>view/quiz/final.swf"></param> 
    <param name="wmode" value="opaque"></param> 
</object>
</div>

     
    <?php
    
    
if(isset($ativ)):
   $ativ->finalizar_sessoes();
endif;

if(isset($ativ2)):
   $ativ2->finalizar_sessoes();
endif;

