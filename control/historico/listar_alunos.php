<?php


$historico = new Historico();

//se selecionou uma turma para vizualisar
if(isset($_SESSION['TURMA_ATUAL'])) {
        $historico->setTurma($_SESSION['TURMA_ATUAL']);   

        echo '<p class="centro branco titulo"> ► Histórico por Alunos '.$_SESSION['TURMA_ATUAL_NOME'].' ►  ';

        echo $historico->listar_alunos($_SESSION['TURMA_ATUAL']);
}else{
    //looping pelas turmas do prof
    for ($i = 0; $i < count($_SESSION['MINHAS_TURMAS_CDG']); $i++) {
        $historico->setTurma($_SESSION['MINHAS_TURMAS_CDG'][$i]);   

        echo '<p class="centro branco titulo"> ► Histórico por Alunos '.$_SESSION['MINHAS_TURMAS_NOME'][$i].' ►  ';

        echo $historico->listar_alunos($_SESSION['MINHAS_TURMAS_CDG'][$i]);

    }
}