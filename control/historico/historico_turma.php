<?php




if($turma_filtro == -1){

    //looping pelas turmas do prof
    for ($i = 0; $i < count($_SESSION['MINHAS_TURMAS_CDG']); $i++) {

        $turma->setTurma($_SESSION['MINHAS_TURMAS_CDG'][$i]);   

        echo '<p class="centro branco titulo"> ►Turma '.$_SESSION['MINHAS_TURMAS_NOME'][$i].' ►  ';
        echo '<br> Precisam reforçar as atividades:';
        echo $turma->listar_precisa_reforcar('N');
        echo '<br><p class="centro branco titulo"> ►Turma do reforço: '.$_SESSION['MINHAS_TURMAS_NOME'][$i].' ►  ';
        echo '<br> Precisam reforçar as atividades:';
        echo $turma->listar_precisa_reforcar('R');

    }   

}else{
    
        $turma->setTurma($turma_filtro);

        echo '<p class="centro branco titulo"> ►Turma '.$turma_filtro_nome.' ►  ';
        echo '<br> Precisam reforçar as atividades:';
        echo $turma->listar_precisa_reforcar('N');
        echo '<br><p class="centro branco titulo"> ►Turma do reforço: '.$turma_filtro_nome.' ►  ';
        echo '<br> Precisam reforçar as atividades:';
        echo $turma->listar_precisa_reforcar('R');
}