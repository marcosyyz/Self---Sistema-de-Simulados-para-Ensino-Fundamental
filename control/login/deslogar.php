<?php
include("../../config.php");



//DESTR�I AS SESSOES
unset($_SESSION['LOGIN']); 
unset($_SESSION['SENHA']);
unset($_SESSION['CODIGO_CDG']);
unset($_SESSION['LOGADO']);
unset($_SESSION['ANONIMO']);

$escola = $_SESSION['ESCOLA'];

session_destroy(); 

//REDIRECIONA PARA A TELA DE LOGIN 
Header("Location:".ROOT_URL."index.php?e=".$escola); 


