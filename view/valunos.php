<?php

include_once('../config.php');
include(ROOT . "model/Mysql.php");
include('vheader_aluno.php');

 // as pr�ximas 3 linhas s�o respons�veis em se conectar com o bando de dados.
 $filter["ALUNO_NOME"] = MySQL::SQLValue('%');
 $db = new MySQL();
 ?>
 
 
 <td width="546" height="300"> 
 
 <?php
 
 if (!$db )
   echo " nao conectou <br><br>";
 else
  echo " conexao OK!<br><br>";
  
 echo "Tabela: aluno <p>";
 $db->SelectRows("ALUNO");
 echo $db->GetHTML();
 


?>
</td> 

 
 
 
 