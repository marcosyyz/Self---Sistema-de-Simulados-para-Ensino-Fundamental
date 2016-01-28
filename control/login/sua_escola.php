<?php
include_once(ROOT.'model/escola.php');

$Escola = New Escola();

$escolas = $Escola->lista_escolas(true);













require ROOT.'view/login/sua_escola.php';
