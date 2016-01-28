<?php

$historico = new Historico();

//se selecionou uma turma para vizualizar
if(isset($_SESSION['TURMA_ATUAL'])) {
        $historico->setTurma($_SESSION['TURMA_ATUAL']);
        echo "<p class='centro fundo-claro titulo texto-verde '> Histórico de Atividades por Data - ".$_SESSION['TURMA_ATUAL_NOME']."</p>";
        echo "<p class='centro titulo branco'> ".$data." ".$semana[date('l',  strtotime($data))]. " </p>  ";
        echo $historico->listar_atividades_por_data($_SESSION['TURMA_ATUAL'],$data);        
}else{  
    //looping pelas turmas do prof
    for ($i = 0; $i < count($_SESSION['MINHAS_TURMAS_CDG']); $i++) {
        $historico->setTurma($_SESSION['MINHAS_TURMAS_CDG'][$i]);
        echo "<p class='centro fundo-claro titulo texto-verde '> Histórico de Atividades por Data - ".$_SESSION['MINHAS_TURMAS_NOME'][$i]."</p>";
        echo "<p class='centro titulo branco'> ".$data." ".$semana[date('l',  strtotime($data))]. " </p>  ";
        echo $historico->listar_atividades_por_data($_SESSION['MINHAS_TURMAS_CDG'][$i],$data);
    }
}

