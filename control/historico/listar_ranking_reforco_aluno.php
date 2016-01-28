<?php


$historico = new Historico();
        
    echo '<p class="centro branco titulo"> ► Ranking Reforço  ►  '.$_SESSION['ALUNO_TURMA_NOME'];

    echo $historico->listar_ranking_reforco($_SESSION['ALUNO_TURMA']);
