<?php

include_once('../../config.php');
include_once(ROOT."model/mysql.php");
include_once(ROOT."model/login.php");

 
$prof_login = $_POST['nome_prof']; 
$prof_senha = $_POST['senha_prof'];
 
 
$login = new Login($prof_login,'',$prof_senha);

//entra com USUARIO_LOGIN E USUARIO_SENHA
$autenticacao =  $login->autenticar_usuario_senha();
 if($autenticacao == 1){
    //echo $_SESSION['LOGIN'] ."<br>";
      //   echo    $_SESSION['SENHA']."<br>";
        // echo    $_SESSION['ALUNO_CDG']."<br>";
     ?> 
        <script>
        window.location = '<?php echo ROOT_URL ; ?>';	 
        </script>
    <?php
 } else{ 
        unset ($_SESSION['LOGIN']); 
        unset ($_SESSION['SENHA']);         
        if($autenticacao == 0){ // nao logou
        ?>
            <script>
            window.location = '<?php echo ROOT_URL.'index.php?l=0&p=1&n='.$prof_login; ?>'; 	
            </script>
        <?php
        }
        if($autenticacao == 2){ // nao logou
        ?>
            <script>
            window.location = '<?php echo ROOT_URL.'index.php?l=2&p=1&n='.$prof_login; ?>'; 	
            </script>
        <?php
        }
        
}
?>