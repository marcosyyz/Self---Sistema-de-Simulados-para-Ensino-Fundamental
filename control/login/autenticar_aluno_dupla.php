<?php

include_once('../../config.php');
include_once(ROOT."model/mysql.php");
include_once(ROOT."model/login.php");

 
$aluno_login = $_POST['nome_aluno']; 
$serie_login = $_POST['serie_aluno'];
$aluno_senha = $_POST['senha_aluno'];
$ainda_eh_o_primeiro_aluno = $_POST['logar_segundo_aluno'];

 
 
$login = new Login($aluno_login,$serie_login);

// entrar apenas com ALUNO_LOGIN e SERIE_LOGIN
//se é o primeiro aluno autenticar com 'false' no parametro
//se é o segundo aluno autenticar com 'true' no parametro (segundo_aluno)
$autenticacao = $login->autenticar_login(($ainda_eh_o_primeiro_aluno == 0));    

if($autenticacao == 1){
     if($ainda_eh_o_primeiro_aluno == 1){
        ?> 
        <script>
        window.location = '<?php echo ROOT_URL.'index.php?p=2' ; ?>';	 
        </script>
        <?php
     }else{ ?>
        <script>
        window.location = '<?php echo ROOT_URL ; ?>';	 
        </script>         
     <?php }          
} else{ 
    if($ainda_eh_o_primeiro_aluno == 1){   
        unset ($_SESSION['ALUNO_CDG']); 
        unset ($_SESSION['LOGIN']); 
        unset ($_SESSION['SENHA']);         
        unset ($_SESSION['ALUNO_TURMA']); 
        unset ($_SESSION['ALUNO_TURMA_NOME']); 
    }else{
        unset ($_SESSION['ALUNO_CDG2']); 
        unset ($_SESSION['LOGIN2']); 
        unset ($_SESSION['SENHA2']); 
        unset ($_SESSION['ALUNO_TURMA2']); 
        unset ($_SESSION['ALUNO_TURMA_NOME2']); 
    }
        
    if($autenticacao == 0){ // nao logou
    ?>
        <script>
        window.location = '<?php echo ROOT_URL.'index.php?p=2&l=0&n='.$aluno_login.'&s='.$serie_login; ?>'; 	
        </script>
    <?php
    }

    if($autenticacao == 2){ // turma bloqueada
    ?>
        <script>
        window.location = '<?php echo ROOT_URL.'index.php?p=2&l=2&n='.$aluno_login.'&s='.$serie_login; ?>'; 	
        </script>
    <?php
    }
 }
    ?>