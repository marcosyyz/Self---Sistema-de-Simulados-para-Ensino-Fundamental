<?php 

//configuraçoes e classes usadas e head
include_once('../../../config.php');
include(ROOT . "view/vhead.php");  
require(ROOT .'view/vheader_anonimo.php');

$nivel = (isset($_GET["n"])) ?  $_GET["n"] : -1;

?>

  
  
 <div id="atividades" class="clearfix">
     <br>        
    <?php 
        require ROOT.'./control/atividade/prof/index.php';
     ?>

 </div>
 <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
 </a>

</div> <!-- fundo transparente-->
 </body> 
 </html>

