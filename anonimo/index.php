<?php 


//configuraçoes e classes usadas e head
include_once("../config.php");
include(ROOT . "view/vhead.php");  
require(ROOT . "view/vheader_anonimo.php"); 

$_SESSION['ALUNO_TURMA'] = '';
$_SESSION['ANONIMO'] = '1';

?>
 
<div id="atividades" class="clearfix">
    <br>        
    <?php         
        require ROOT.'control/atividade/anonimo/atividades_home.php';
    ?>
</div>

</div> <!-- fundo transparente-->
 </body> 
 </html>


