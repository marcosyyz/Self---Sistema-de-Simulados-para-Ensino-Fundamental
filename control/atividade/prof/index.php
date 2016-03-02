<?php
  
  require ROOT."model/planejamento.php";
      
  $planej = new Planejamento;
  $atividades =  $planej->lista_de_atividades($nivel);
  
  while(!$atividades->EndOfSeek()) {
        $linha =  $atividades->Row();
        $finalizado = true;
        echo " <div class='atividade'><a href='".ROOT_URL."control/quiz/iniciar_atividade.php?a=".$linha->ATIVIDADE_CDG."&t=1'>";
        echo '<input type="button" value="';
        echo ($finalizado ? $linha->ATIVIDADE_NOME : 'INICIAR '.$linha->ATIVIDADE_NOME).'"' ;
        
        echo ' class=" botao-atividade  ' . ($finalizado ? 'atividade-feita' : 'atividade-nao-feita') . '"/>';
        echo ' </a></div>';  
        
        
        
  }

  
  /*
  $planej = new Planejamento;
  $atividades =  $planej->atividades_concluidas($aluno->aluno_cdg);
 
  
  
  
  
  
  $atividades->MoveFirst();
  while(!$atividades->EndOfSeek()) {
        $linha =  $atividades->Row();       
        $finalizado = $aluno->atividade_completada($linha->ATIVIDADE_CDG);
        echo " <div class='atividades'><a href=".ROOT_URL."control/quiz/iniciar_atividade.php?a=".$linha->ATIVIDADE_CDG.">";
        echo '<input type="button" value="';
        echo ($finalizado ? $linha->ATIVIDADE_NOME : 'INICIAR '.$linha->ATIVIDADE_NOME).'"' ;
        
        echo ' id="' . ($finalizado ? 'atividade-feita' : 'atividade-nao-feita') . '"/>';
        echo ' </a></div>';                      
  }  
  
  $atividades =  $planej->proxima_atividade($aluno->aluno_cdg);
  
  while(!$atividades->EndOfSeek()) {
        $linha =  $atividades->Row();       
        $finalizado = $aluno->atividade_completada($linha->ATIVIDADE_CDG);
        echo " <div class='atividades'><a href=".ROOT_URL."control/quiz/iniciar_atividade.php?a=".$linha->ATIVIDADE_CDG.">";
        echo '<input type="button" value="';
        echo ($finalizado ? $linha->ATIVIDADE_NOME : 'INICIAR '.$linha->ATIVIDADE_NOME).'"' ;
        
        echo ' id="' . ($finalizado ? 'atividade-feita' : 'atividade-nao-feita') . '"/>';
        echo ' </a></div>';                      
  }
*/