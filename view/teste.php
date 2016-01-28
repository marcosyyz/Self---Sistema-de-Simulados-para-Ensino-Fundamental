<?php
include_once('../config.php');
include_once ROOT."model/mysql.php";
include(ROOT."model/admin/questao.php");

$questao = New Questao();
echo $questao->anteriorid(11);



?>