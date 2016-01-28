<?php 

include('../../config.php');
include_once(ROOT.'model/historico.php');
include(ROOT."view/vhead.php");
require(ROOT.'control/carregar_header_profs.php');


?>
</head>
 <div>      
    <td width="546" height="300"> 
            <?php include(ROOT.'control/historico/listar_atividades.php');  ?>
    </td>    
    <br>
    <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
    </a>
    
 </div>