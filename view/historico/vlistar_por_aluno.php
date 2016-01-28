<?php 

include('../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'view/vheader_prof.php');
include_once(ROOT.'model/historico.php');

$historico = new Historico();
$aluno = isset($_GET['a']) ? $_GET['a'] : '0';
$nome_completo = $historico->nome_aluno($aluno);

?>
</head>
 <div> 
     <div class="box-dados">
         <span class="branco titulo" >  <?php echo ucwords(strtolower($nome_completo)) ?></span>
     </div>
     
    <td width="546" height="300"> 
            <?php include(ROOT.'control/historico/listar_por_aluno.php');  ?>
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
