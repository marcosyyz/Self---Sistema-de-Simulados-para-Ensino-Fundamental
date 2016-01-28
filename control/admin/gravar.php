<?php 
	include_once("../../model/mysql.php");


	$message = $_POST['texto'];
	
	$message = nl2br($message);
	
$db = new Mysql();	
	
$db->Query(" INSERT INTO TESTE(TEXTO,TEXTOTEXTO) VALUES('".$message."','".$message."')");

echo  $message;
