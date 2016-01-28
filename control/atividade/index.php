<?php
  require ROOT."model/planejamento.php";
  
  $planej = new Planejamento;

  //setando nivel atual para voltar na tela certa apos acabar atividade  
  $_SESSION['NIVEL_ATUAL'] = $nivel;
  
  if(isset($aluno2)):
    $nivel_a_listar =  $aluno->aluno_nivel > $aluno2->aluno_nivel ? $aluno2->aluno_cdg : $aluno->aluno_cdg;
  else:
    $nivel_a_listar =  $aluno->aluno_cdg;
  endif;
  
  $atividades = $planej->listar_atividades(
                        $nivel_a_listar,
                        $nivel);
  $desabilitar = false;
  while(!$atividades->EndOfSeek()) {        
        $linha =  $atividades->Row();     
        
        if (!$desabilitar){
            echo " <div class='atividades'><a href=".ROOT_URL."control/quiz/iniciar_atividade.php?a=".$linha->ATIVIDADE_CDG.">";
            echo '<input type="button" value="';        
            echo $linha->ATIVIDADE_NOME.'"' ;                        
            echo ' class="botao-atividade ';
            // mostrar joinha se acertou todas
            if ( $linha->ERROS  == 0):
                echo ' 100porcento '; 
            else:
                echo ' semjoinha '; 
            endif;
            
            
            // pintar diferente se finalizou
            if ( $linha->FINALIZOU  > 0):
                echo ' atividade-feita ';
            else:
                echo ' atividade-nao-feita ';
                $desabilitar = true;
            endif;
            
            echo '"  />';
            echo ' </a></div>';
        }else{
           echo '<input type="button" value="'.$linha->ATIVIDADE_NOME .'"  class="botao-atividade desativado" />';
        }
        
  }
  
  
  
  
  
  