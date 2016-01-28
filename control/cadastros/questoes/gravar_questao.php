<?php
require '../../../config.php';
require ROOT.'model/admin/questao.php';



$questao_cdg = $_POST['questao_cdg'] ;
        
$questao = new Questao($questao_cdg);
        
        
// $questao->gravar('', '', '0', '', '', '', '', '', '', '1', '1', '1', NULL, NULL, NULL);

         
 $questao_inserida =  $questao->gravar(        
        $_POST['pergunta'] ,
        $_POST['imagem'],
        $_POST['imagem_pos'], 
        $_POST['texto'], 
        $_POST['opcao1'], 
        $_POST['opcao2'], 
        $_POST['opcao3'], 
        $_POST['opcao4'], 
        $_POST['opcao5'],
        $_SESSION['USUARIO_CDG'], 
        $_POST['revisor_cdg'],  
        $_POST['materia'],  
        isset($_POST['assunto']) ? $_POST['assunto'] : null, 
        isset($_POST['tipo']) ? $_POST['tipo'] : null,
        isset($_POST['descritor']) ? $_POST['descritor'] : null
        );



 if($questao_inserida != -1) {
     $questao_cdg =  $questao_inserida ;
 }
 
        header("Location: ".ROOT_URL."control/cadastros/questoes/edit_questao.php?q=".$questao_cdg."&s=s"); 