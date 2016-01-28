<?php 

include('../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'control/carregar_header_profs.php');
include_once(ROOT.'model/historico.php');

$atividade = isset($_GET['a']) ? $_GET['a'] : '0';

?>
</head>

<div>      
    <td width="546" height="300"> 
            <?php include(ROOT.'control/historico/listar_ranking_masculino.php');  ?>
    </td>    
    <br>
    <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
    </a>
    
</div>
     
 
 
 </table> 
 </div>
 </body> 
 </html>



