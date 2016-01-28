<?php
include_once('../../config.php');

$nome_aluno   =  isset($_POST['nome_aluno'])?  $_POST['nome_aluno'] : -1;
$nova_serie   =  isset($_POST['serie_aluno'])?  $_POST['serie_aluno'] : -1;


if(($nome_aluno == -1) || ($nova_serie == -1)){
    echo '<script>';
    echo " window.location = '".ROOT_URL."index.php?p=3' ";
    echo '</script>    ';
}

include_once(ROOT."model/login.php");
include_once(ROOT."model/aluno.php");


$login = new Login($nome_aluno,-1);
$Aluno = new Aluno();

// entrar apenas com ALUNO_LOGIN e SERIE_LOGIN
$autenticacao = $login->autenticar_apenas_nome();
 if($autenticacao == 1){
    $atualizou = $Aluno->passar_de_ano($Aluno->getCDG($nome_aluno),$nova_serie);
                
    $login->login = $nome_aluno;
    $login->turmaatual_cdg = $nova_serie;
    $login->autenticar_login();
    
    if($atualizou == 1){
        $System->log(' Aluno: '.$nome_aluno.' foi para turma '.$_SESSION['ALUNO_TURMA_NOME']);
    }else{
        $System->log(' Aluno: '.$nome_aluno.' - PROBLEMA -  nao atualizou a para a nova serie: '.$_SESSION['ALUNO_TURMA_NOME']);
    }    
    
    ?> 
        <script>
        window.location = '<?php echo ROOT_URL; ?>';	 
        </script>
    <?php
 } else{
        unset ($_SESSION['LOGIN']);
        unset ($_SESSION['SENHA']);
        if($autenticacao == 0){ // nao logou
        ?>
            <script>
            window.location = '<?php echo ROOT_URL.'index.php?p=3&n='.$nome_aluno.'&l=0'; ?>'; 	
            </script>
        <?php
	}        
 }
    ?>