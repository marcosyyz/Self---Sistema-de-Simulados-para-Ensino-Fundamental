<?php


if (isset($_GET['l']))
  $param_login=  $_GET['l'];
else
  $param_login=  '-1';


$login_errado = isset($_GET['n']) ? $_GET['n'] : '-1' ;

if ($param_login == 0){ ?>  
    <script>
      $( document ).ready(function() {
				dlg = new DialogFx( somedialog1 );
				dlg.toggle();				
			
      });  		 	 	
    </script>
    
<?php 
  } 
   if ($param_login == 2){ ?>  
    <script>
      $( document ).ready(function() {
            dlg = new DialogFx( acesso_bloqueado );
	    dlg.toggle();				
            $('#nome_login').val('<?php echo $login_errado ?>');              
            $('#serie_login').val('');
      });  		 	 	
    </script>
    
<?php 
  }  
?>    

<title>SELF Login Professor</title> 
 </head> 


<body data-speed="10" class="bg-Parallax">


<div id="form-main" >
  <div id="transparente-div-login" class="zoom-in-ativo">
     
    <form method="post" class="form" action="<?php echo ROOT_URL ?>control/login/autenticar_prof.php"  id="form-login">
     <center><img width="100" class="logo-login" src="<?php echo ROOT_URL ?>view/img/logo-professor.png"  /> </center>
      <p class="name">
        <input id="nome_login" name="nome_prof" autocomplete="off" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Login do Professor" iProfd="name" />
      </p>
      
            
      <p class="pass">
          <input name="senha_prof" type="password" class="feedback-input" id="senha" placeholder="Senha" />
      </p>
            
      
      <div class="submit">
        <input type="submit" value="ENTRAR" id="button-blue"/>
        <div class="ease"></div>
      </div>
    </form>
  </div>
  
    <script src="dist/js/vendor/jquery.min.js"></script>  
    <script src="dist/js/flat-ui.min.js"></script>
    <script src="docs/assets/js/application.js"></script>
</div>


<!-- caixa de dialogo login invalido -->
			
<div id="somedialog1" class="dialog">
    <div class="dialog__overlay"></div>					
    <div class="dialog__content">					
        <h2><strong>OPA!</strong>, VOCÊ DIGITOU SEU NOME ERRADO </h2><div><button type="reset" data-dialog-close>Tentar novamente</button></div>
    </div>
</div>	


<div id="acesso_bloqueado" class="dialog">
    <div class="dialog__overlay"></div>					
    <div class="dialog__content">					
        <h2><strong>ACESSO BLOQUEADO</strong><BR><BR>Você não pode acessar o sistema agora...</h2><div><button type="reset" data-dialog-close>Tentar novamente</button></div>
    </div>
</div>	



</body>


 <script src="<?php echo ROOT_URL ?>view/js/login.js"></script>

 </html>
