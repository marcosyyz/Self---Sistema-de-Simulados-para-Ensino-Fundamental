<?php

include_once('../../../config.php');
include(ROOT."model/admin/questao.php");
include(ROOT."model/admin/materia.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/vhead.php");

$questao_cdg =  isset($_GET['q'])?  $_GET['q'] : -1;

$questao = new Questao($questao_cdg);    

$materia = new Materia();
$usuario = new Admin_Usuario();



include ROOT.'view/cadastros/questoes/vedit_questao.php';
