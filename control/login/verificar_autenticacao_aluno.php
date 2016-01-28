<?php
        //verificar se aluno nao estiver logado redireciona para index 
        include_once(ROOT."model/aluno.php");	

        
	$usuario = isset($_SESSION['LOGIN']) ? $_SESSION['LOGIN'] : -1 ;    
        $aluno = new Aluno(isset($_SESSION['ALUNO_CDG']) ? $_SESSION['ALUNO_CDG'] :-1);       
        if(isset($_SESSION['ALUNO_CDG2'])){
           $aluno2 = new Aluno(isset($_SESSION['ALUNO_CDG2']) ? $_SESSION['ALUNO_CDG2'] :-1);
        }
        
        // deslogar se estiver logado em outro lugar apos o seu login
        $deslogar  = $aluno->logado_em_outro_local();
                 

                      
        // deslogar se nao estiverem setados corretamente
	if((!isset ($_SESSION['LOGIN']) ) and (!isset ($_SESSION['SENHA']))) { 
	  $deslogar = true;	
	}
        
        if($deslogar){
             echo 'desligar';
            unset($_SESSION['LOGIN']); 
	    unset($_SESSION['SENHA']); 
	    header('location:'.ROOT_URL.'index.php');
        }
        
?>

