    <?php
    include_once ROOT.'view/vhead.php';
    ?>
    <title>SELF Selecione a sua Escola</title> 
</head> 


<body data-speed="10" class="bg-Parallax">


<div id="form-main" >
  <div id="transparente-div-login" class="zoom-in-ativo">
           
        <form method="post" class="form" action="<?php echo ROOT_URL ?>control/login/setar_escola.php"  id="form-login">
        <input type="hidden" name="parametro_atual" value="<?php echo $p ?>"/>
        <p>
        <select  name="escola"  class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" id="escola" >
           <?php
            foreach($escolas as $e){
               echo '<option value="'.$e['ESCOLA_CDG'].'">'.$e['ESCOLA_NOME'].'</option>';
            }
           ?>           
        </select>
        </p>                  
      
        <div class="submit">         
            <input type="submit" value="SELECIONAR" id="button-blue"/>           
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
