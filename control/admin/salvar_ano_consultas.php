<?php

include_once('../../config.php');

$campo_ano = isset($_POST['campo-ano']) ? $_POST['campo-ano'] : -1;



if(($campo_ano != -1) && (isset($_SESSION['USUARIO_CDG']))  ){
  
  $System->executarSQL(' UPDATE USUARIO SET USUARIO_ANODECONSULTA = '.$campo_ano
                .' WHERE USUARIO_CDG = '.$_SESSION['USUARIO_CDG']);
  $_SESSION['ANO_DE_CONSULTA'] =  $campo_ano;
}


   header('location:'.ROOT_URL);



