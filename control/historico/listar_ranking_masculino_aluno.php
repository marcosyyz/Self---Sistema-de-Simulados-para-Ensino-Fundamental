<?php


$historico = new Historico();

        
    echo '<p class="centro branco titulo"> ► Ranking Masculino  ►  '.$_SESSION['ALUNO_TURMA_NOME'];

    echo $historico->listar_ranking_sexo($_SESSION['ALUNO_TURMA'],'M');
    

