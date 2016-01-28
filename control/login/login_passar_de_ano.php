<?php
include_once(ROOT."model/admin/turma.php");

$param_login = isset($_GET['l']) ?  $_GET['l'] : '-1';
$login_errado = isset($_GET['n']) ? $_GET['n'] : '-1' ;

$Turma = New Turma();

$series_ativas = $Turma->lista_turmas($_SESSION['ESCOLA'],true); // apenas turmas ativas

require ROOT.'view/login/vlogin_passar_de_ano.php';