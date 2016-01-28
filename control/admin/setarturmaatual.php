<?php
include '../../config.php';

$turma_filtro =  isset($_GET['t'])?  $_GET['t'] : -1;
$turma_filtro_nome =  isset($_GET['n'])?  $_GET['n'] : -1;

$_SESSION['TURMA_ATUAL'] = $turma_filtro;
$_SESSION['TURMA_ATUAL_NOME'] = $turma_filtro_nome;


header('Location: '.ROOT_URL);



