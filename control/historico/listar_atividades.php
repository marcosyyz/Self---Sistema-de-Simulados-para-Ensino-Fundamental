<?php


    
$historico = new Historico();

//se selecionou uma turma para vizualisar
if(isset($_SESSION['TURMA_ATUAL'])) {
        echo "<p class='centro fundo-claro titulo texto-verde '> Histórico de Atividades NIVEL 1- ".$_SESSION['TURMA_ATUAL_NOME']."</p>";   
        echo $historico->listar_atividades($_SESSION['TURMA_ATUAL'],1);
        echo "<br><br>";

        echo "<p class='centro fundo-claro titulo texto-verde '> NIVEL 2 - ".$_SESSION['TURMA_ATUAL_NOME']."</p>";   
        echo $historico->listar_atividades($_SESSION['TURMA_ATUAL'],2);
        echo "<br><br>";

        echo "<p class='centro fundo-claro titulo texto-verde '> NIVEL 3 - ".$_SESSION['TURMA_ATUAL_NOME']."</p>";   
        echo $historico->listar_atividades($_SESSION['TURMA_ATUAL'],3);
        echo "<br><br>";    
}else{
    //looping pelas turmas do prof
    for ($i = 0; $i < count($_SESSION['MINHAS_TURMAS_CDG']); $i++) {
        $historico->setTurma($_SESSION['MINHAS_TURMAS_CDG'][$i]);    

        echo "<p class='centro fundo-claro titulo texto-verde '> Histórico de Atividades NIVEL 1- ".$_SESSION['MINHAS_TURMAS_NOME'][$i]."</p>";   
        echo $historico->listar_atividades($_SESSION['MINHAS_TURMAS_CDG'][$i],1);
        echo "<br><br>";

        echo "<p class='centro fundo-claro titulo texto-verde '> NIVEL 2 - ".$_SESSION['MINHAS_TURMAS_NOME'][$i]."</p>";   
        echo $historico->listar_atividades($_SESSION['MINHAS_TURMAS_CDG'][$i],2);
        echo "<br><br>";

        echo "<p class='centro fundo-claro titulo texto-verde '> NIVEL 3 - ".$_SESSION['MINHAS_TURMAS_NOME'][$i]."</p>";   
        echo $historico->listar_atividades($_SESSION['MINHAS_TURMAS_CDG'][$i],3);
        echo "<br><br>";

    }
}
