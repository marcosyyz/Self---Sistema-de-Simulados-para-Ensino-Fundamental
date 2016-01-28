<?php 

include('../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'control/carregar_header_profs.php');
include_once(ROOT.'model/historico.php');

$semana = array(
    'Sunday' => 'Domingo', 
    'Monday' => 'Segunda-Feira',
    'Tuesday' => 'Terca-Feira',
    'Wednesday' => 'Quarta-Feira',
    'Thursday' => 'Quinta-Feira',
    'Friday' => 'Sexta-Feira',
    'Saturday' => 'Sábado'
);

?>
</head>
 <div>      
    <td width="546" height="300"> 
            <?php include(ROOT.'control/historico/listar_datas.php');  ?>
    </td>    
    <br>
    <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
    </a>
    
 </div>