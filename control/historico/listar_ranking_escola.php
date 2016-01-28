<?php
include_once ROOT.'model/escola.php';

$historico = new Historico();
$Escola = New Escola();
       
    echo '<p class="centro branco titulo"> ► Ranking da Escola  ► <br> '
            . $Escola->getNome($_SESSION['ESCOLA']) ; 

    echo $historico->listar_ranking_escola($_SESSION['ESCOLA']);
    

