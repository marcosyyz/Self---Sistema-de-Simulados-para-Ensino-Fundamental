<?php 

include('../../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'view/admin/vheader_admin.php');
include_once(ROOT.'model/admin/descritor.php');

?>
</head>
 <div>      
    <td width="546" height="300"> 
            <?php include(ROOT.'control/admin/cadastros/listar_topicos.php');  ?>
    </td>    
 </div>
     
 
 
 </table> 
 </div>
 </body> 
 </html>

