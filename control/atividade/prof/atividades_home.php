<?php
    require_once ROOT.'model/planejamento.php';

    echo "<p class='titulo centro branco'>  Lista de Atividades </p>";
    //nivel 1
    echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/prof/index.php?n=1'> ";
    echo '<input type="button" value="Nivel 1" class="botao-atividade atividade-feita" />';        
    echo ' </a></div>';  
    
    //nivel 2
    echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/prof/index.php?n=2'> ";
    echo '<input type="button" value="Nivel 2" class="botao-atividade atividade-feita" />';        
    echo ' </a></div>';  

    //nivel 3
    echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/prof/index.php?n=3'> ";
    echo '<input type="button" value="Nivel 3" class="botao-atividade atividade-feita" />';        
    echo ' </a></div>';  
    
       //nivel 3
    echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/prof/index.php?n=4'> ";
    echo '<input type="button" value="Nivel 4" class="botao-atividade atividade-feita" />';        
    echo ' </a></div>';  