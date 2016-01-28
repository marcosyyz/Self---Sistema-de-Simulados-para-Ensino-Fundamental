<?php 

//configuraçoes e classes usadas e head
include_once('../../config.php');
include(ROOT . "view/vhead.php");
require(ROOT .'view/vheader_aluno.php');

//receber o nivel a ser listado
$nivel = (isset($_GET["n"])) ?  $_GET["n"] : -1;

?>
  
  
<div id="atividades" class="clearfix">
    <br>        
    <?php 
        require ROOT.'control/atividade/index.php';
    ?>

</div>
<a href="<?php echo ROOT_URL;?>">       
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
</a>

</div> <!-- fundo transparente-->
</body> 
</html>
