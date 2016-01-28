<?php


$historico = new Historico();

if(isset($_SESSION['TURMA_ATUAL'])) {
    echo '<p class="centro branco titulo"> ► Ranking Reforço '.$_SESSION['TURMA_ATUAL_NOME'].' ►  ';
    echo $historico->listar_ranking_reforco($_SESSION['TURMA_ATUAL']);
}else{
    //looping pelas turmas do prof
    for ($i = 0; $i < count($_SESSION['MINHAS_TURMAS_CDG']); $i++) {

        echo '<p class="centro branco titulo"> ► Ranking Reforço '.$_SESSION['MINHAS_TURMAS_NOME'][$i].' ►  ';
        echo $historico->listar_ranking_reforco($_SESSION['MINHAS_TURMAS_CDG'][$i]);

    }
}