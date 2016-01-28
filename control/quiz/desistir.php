<?php
require_once '../../config.php';
include_once ROOT.'model/atividade.php';




if (isset($_SESSION['ATIVIDADE_ATUAL'])) {
	$ativ = new Atividade($_SESSION['ATIVIDADE_ATUAL'],$_SESSION['ALUNO_TURMA']);
	$ativ->finalizar_sessoes();
} 



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



