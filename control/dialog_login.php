	<link rel="stylesheet" type="text/css" href="../view/css/estilo.css" />
		<link rel="stylesheet" type="text/css" href="../view/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../view/css/demo.css" />
		<!-- common styles -->
		<link rel="stylesheet" type="text/css" href="../view/css/dialog.css" />
		<!-- individual effect -->
		<link rel="stylesheet" type="text/css" href="../view/css/dialog-ricky.css" />
		<script src="../view/js/modernizr.custom.js"></script>
		<script src="../view/js/classie.js"></script>
		<script src="../view/js/dialogFx.js"></script>		
                 <script src="<?php echo ROOT_URL ?>view/js/jquery-1.11.2.min.js"></script> 

		
    <script>
      $( document ).ready(function() {
				dlg = new DialogFx( somedialog1 );
				dlg.toggle();								
      });  	  
    </script>
	
	
	
  <!-- caixa de dialogo login invalido -->
														
				<div id="somedialog1" class="dialog">
					<div class="dialog__overlay"></div>					
					<div class="dialog__content">					
						<h2><strong>Opa!</strong>, O NOME OU A SENHA EST&Atilde;O ERRADOS	</h2><div><button type="reset" data-dialog-close>Tentar novamente</button></div>
					</div>
                                 </div>	


