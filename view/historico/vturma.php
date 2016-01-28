<?php 


include('../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'control/carregar_header_profs.php');
include_once(ROOT.'model/historico_turma.php');


$turma = new Historico_Turma();

$turma_filtro =  isset($_GET['t'])?  $_GET['t'] : -1;
$turma_filtro_nome = $turma->getTurmaNome($turma_filtro);
        
$_SESSION['TURMA_ATUAL'] =  $turma_filtro;
$_SESSION['TURMA_ATUAL_NOME'] =  $turma_filtro_nome;

?>
</head>
 <div>      
    <td width="546" height="300"> 
            <?php include(ROOT.'control/historico/historico_turma.php');  ?>
    </td>    
    <br>
    
    
    
    <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
    </a>
    
 </div>