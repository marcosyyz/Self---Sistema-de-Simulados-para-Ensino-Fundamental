<?php

	//verificar se usuario nao estiver logado redireciona para index 
	 if(!isset($_SESSION['LOGADO']) || 
             (!isset($_SESSION['LOGIN']))) {
            Header("Location:".ROOT_URL."index.php"); 
	}        
?>
