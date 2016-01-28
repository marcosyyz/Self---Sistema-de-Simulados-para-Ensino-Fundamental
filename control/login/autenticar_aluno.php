<?php

include_once('../../config.php');
include_once(ROOT."model/mysql.php");
include_once(ROOT."model/login.php");

 
$aluno_login = $_POST['nome_aluno']; 
$serie_login = $_POST['serie_aluno'];
$aluno_senha = $_POST['senha_aluno'];

 
 
$login = new Login($aluno_login,$serie_login);

// entrar apenas com ALUNO_LOGIN e SERIE_LOGIN
$autenticacao = $login->autenticar_login();
 if($autenticacao == 1){
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
            window.location = '<?php echo ROOT_URL.'index.php?l=0&n='.$aluno_login.'&s='.$serie_login; ?>'; 	
            </script>
        <?php
	}
        
        if($autenticacao == 2){ // turma bloqueada
        ?>
            <script>
            window.location = '<?php echo ROOT_URL.'index.php?l=2&n='.$aluno_login.'&s='.$serie_login; ?>'; 	
            </script>
        <?php
	}
 }
    ?>