<?php 
    
    //configuraçoes e classes usadas e head
    include_once('../../config.php');
    include(ROOT . "view/vhead.php");  
    require(ROOT .'view/vheader_prof.php');
?>

  
 <div id="atividades" class="clearfix">
    <br>        
    <?php 
        require ROOT.'./control/atividade/prof/atividades_home.php';
    ?>
 </div>

 <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
 </a>

</div> <!-- fundo transparente-->
</body> 
</html>

