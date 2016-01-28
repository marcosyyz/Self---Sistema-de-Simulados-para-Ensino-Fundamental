<?php




echo '<p class="centro branco titulo "> ► Atividades executadas  ►  ';

echo $historico->listar_por_aluno_atividade($aluno);

echo '<p class="centro branco titulo "> ► Precisa reforçar  ►  ';

echo $historico->listar_precisa_reforcar($aluno);





