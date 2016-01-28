<?php 
/*
 *  ALUNO_CDG = null , professor logado no sistema.
 *  ALUNO_CDG = codigo do aluno, aluno logado no sistema.
 * 
 */
//configuraçoes e classes usadas e head
include_once('config.php');
include(ROOT . "view/vhead.php");


$param_escola = (isset($_GET["e"])) ? $_GET["e"] : -1;

//se escola setada = -1
if(isset($_SESSION['ESCOLA'])):
    if($_SESSION['ESCOLA'] == -1):
        $_SESSION['ESCOLA'] = $param_escola;
    endif;
else:
    //se nao tem escola setada
    $_SESSION['ESCOLA'] = $param_escola;
endif;
    
//se tem parametro da escola 'e', substitui escola atual
if($param_escola != -1):
    $_SESSION['ESCOLA'] = $param_escola;
endif;
    

    
$param = (isset($_GET["p"])) ? $_GET["p"] : 0;
//login para prof = 1
//login em dupla = 2
// aluno passar de ano = 3



if($_SESSION['ESCOLA'] == -1){
    require(ROOT . "control/login/sua_escola.php");
    exit;
}



if($param == 2){    
    require(ROOT . "control/login/login_em_dupla.php");
    exit;
}

if($param == 3){    
    require(ROOT . "control/login/login_passar_de_ano.php");
    exit;
}




// se estiver logado
if(isset($_SESSION['LOGADO'])){    

    // se nao for aluno 
    if(!isset($_SESSION['ALUNO_CDG'])) {
            // antes de entrar verificar ano de consulta
            
            if(!isset($_SESSION['ANO_DE_CONSULTA'])){
                require(ROOT . "view/vselecione-ano.php");
                exit;
            }
      
            //vai pra home prof
            if($_SESSION['USUARIO_NIVEL'] == 2):
                // nivel 2 é admin
                require(ROOT . "view/admin/vhome_admin.php");
            else:
                require(ROOT . "view/vhome_prof.php");
            endif;
            
    }else{  
        // se esta logado como aluno 
       if(isset($_SESSION['LOGIN']) AND (isset($_SESSION['ALUNO_CDG']))) {            
            require(ROOT . "view/vhome_aluno.php");    
       }else{
           //nao esta logado corretamente , falta LOGIN e ALUNO_CDG
           require(ROOT . "view/login/vlogin_aluno.php");  
       }           
    }
}else{ //se nao estiver logado
   
    unset($_SESSION['LOGIN']); 
    unset($_SESSION['SENHA']); 
    unset($_SESSION['ALUNO_CDG']);
    if($param == 1 ){
       //se tem o parametro p=1 chamar tela de login de prof      
       require(ROOT . "view/login/vlogin_prof.php");	           
    } else {
        //se for index sem parametro é aluno
        require(ROOT . "view/login/vlogin_aluno.php");
    }
}


        

?>
