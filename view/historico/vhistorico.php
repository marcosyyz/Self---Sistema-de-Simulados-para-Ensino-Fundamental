<?php 

include('../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'view/vheader_prof.php');
include_once(ROOT.'model/historico.php');

?>
</head>
 <div>      
    <td width="546" height="300"> 
            <?php include(ROOT.'control/historico/listar_atividades.php');  ?>
    </td>    
 </div>
     
 
 
 </table> 
 </div>
 </body> 
 </html>

