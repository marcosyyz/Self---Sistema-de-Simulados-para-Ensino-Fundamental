<?php 

include('../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'view/vheader_prof.php');
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

$data = isset($_GET['d']) ? $_GET['d'] : '0';


?>
</head>

 <div>      
    <td width="546" height="300"> 
            <?php include(ROOT.'control/historico/listar_por_data.php');  ?>
    </td>    
    <br>
    <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
    </a>
    
 </div>