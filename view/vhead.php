<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
    
<head>		
                <!-- ****************************   metas  primeiro *********-->
                <?php   
                     $som =  (isset($_SESSION['SOM']) ? $_SESSION['SOM'] : '0');
                     if( $som != '0'){    
                        echo "<audio id='audio1'  autoplay='autoplay'  >";
                        echo "  <source src='".ROOT_URL."view/sons/".$_SESSION['SOM']."' type='audio/mp3'>";  
                        echo "</audio>";                    
                    }
                    $_SESSION['SOM'] = '0';
                    
                ?>
                <meta charset="utf-8">                 
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />             
				
                 <script src="<?php echo ROOT_URL ?>view/js/jquery-1.11.2.min.js"></script> 
                 
                 <!-- *******************   Estilos *******************   -->
                
                <link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/animation.css" />		
		<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/estilo.php" />
		<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/demo.css" />		
		<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/dialog.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/alerts/al.css" />
                
		<!-- individual effect -->
		<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/dialog-ricky.css" />

                <!-- *******************   scripts   ********************************* -->
		<script src="<?php echo ROOT_URL ?>view/js/alerts/modernizr.custom.js"></script>
		<script src="<?php echo ROOT_URL ?>view/js/alerts/classie.js"></script>
		<script src="<?php echo ROOT_URL ?>view/js/alerts/dialogFx.js"></script>		
                <script src="<?php echo ROOT_URL ?>view/js/home.js"></script>		
                <script src="<?php echo ROOT_URL ?>view/js/alerts/al.js"></script>		                

		<!-- *******************    Fonts    *******************    -->
                <link rel="stylesheet" href="<?php echo ROOT_URL ?>view/css/padrao.css" type="text/css" media="screen"></link>
                <link rel="stylesheet" href=<?php echo ROOT_URL ?>view/js/jquery-ui.css" />
                <link rel="stylesheet" href="<?php echo ROOT_URL ?>view/css/font-awesome-4.1.0/css/font-awesome.min.css" type="text/css" media="screen">		
                
