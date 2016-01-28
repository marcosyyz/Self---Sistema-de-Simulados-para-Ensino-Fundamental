<?php
require('atividade.php');

$ativ = new Atividade(4,1);


$ativ->finalizar('9', 8, 1, '8',-1);


echo $ativ->pontuar_aluno(9,9);
  


