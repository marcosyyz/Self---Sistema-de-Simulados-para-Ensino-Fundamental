<?php
include_once(ROOT."model/login.php");
include_once(ROOT."model/aluno.php");

$param_login = isset($_GET['l']) ?  $_GET['l'] : '-1';
$serie_errada = isset($_GET['s']) ?  $_GET['s'] : '-1';
$login_errado = isset($_GET['n']) ? $_GET['n'] : '-1' ;



















require ROOT.'view/login/vlogin_em_dupla.php';

