<?php


$historico = new Historico();

echo '<p class="centro branco titulo"> ► RANKING - TURMA '.' ►  '.$_SESSION['ALUNO_TURMA_NOME'];

echo $historico->listar_ranking($_SESSION['ALUNO_TURMA']);
