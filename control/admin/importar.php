<?php
include '../../config.php';
include ROOT.'model/admin/importador.php';
include(ROOT . "view/vhead.php");  
require(ROOT.'view/admin/vheader_admin.php');


$tipo_update   =  isset($_POST['tipo-update'])?  $_POST['tipo-update'] : -1;
$turma   =  isset($_POST['filtro-turma'])?  $_POST['filtro-turma'] : -1;
$delimitador   =  isset($_POST['delimitador'])?  $_POST['delimitador'] : -1;


if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Arquivo: " . $_FILES["file"]["name"] . "<br>";
  echo "Tipo: " . $_FILES["file"]["type"] . "<br>";
  echo "Tamanho: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Uploaded: " . $_FILES["file"]["tmp_name"];
  echo "<p>";
  }
  
  
echo "<body> <div class='fundo-claro'> ";
 
$I = new Importador(); 
$I->importar($_FILES["file"]["tmp_name"], ';', $turma ,$tipo_update);
 
 echo "</div></body> ";
?>

