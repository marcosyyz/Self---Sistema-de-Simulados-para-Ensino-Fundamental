<?php

include_once '../../config.php';



$atualizar_nivel = isset($_SESSION['ATUALIZAR_NIVEL']) ? $_SESSION['ATUALIZAR_NIVEL'] : 0 ;


//se for pra subir de nivel
if($atualizar_nivel  == 1){
        $_SESSION['ALUNO_NIVEL'] = $_SESSION['ALUNO_NIVEL'] + 1;
        $_SESSION['ATUALIZAR_NIVEL'] =  0 ;   
        require ROOT.'view/subir_nivel.php';            
}else{
    // se nao, volta pro nivel atual 
    if(isset($_SESSION['NIVEL_ATUAL'])){
        ?>
        <script>
           window.location = '<?php echo ROOT_URL.'view/atividade/index.php?n='.$_SESSION['NIVEL_ATUAL'] ?>'; 	
        </script>
        <?php
    }else{
        
        if(!isset($_SESSION['ANONIMO'])){
            // caso for prof nao tem nivel atual vai pra home
            ?>        
            <script>
                window.location = '<?php echo ROOT_URL?>'; 	
            </script>
            <?php
        }else{
            //se for anonimo vai pra home anonimo
            ?>        
            <script>
                window.location = '<?php echo ROOT_URL.'/anonimo'?>'; 	
            </script>
            <?php            
        }
    }
    //
        
}
