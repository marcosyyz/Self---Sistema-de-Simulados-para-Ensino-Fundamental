<?php


$historico = new Historico();


    echo '<p class="centro branco titulo"> ► Ranking Feminino  ►  '.$_SESSION['ALUNO_TURMA_NOME'];
	
    echo " <div class='feminino'> ";
    
    echo $historico->listar_ranking_sexo($_SESSION['ALUNO_TURMA'],'F');
    
    echo "</div>";
    
    

