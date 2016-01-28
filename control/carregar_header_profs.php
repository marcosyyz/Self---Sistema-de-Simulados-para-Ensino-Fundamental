<?php

if($_SESSION['USUARIO_NIVEL'] == 2):
    require(ROOT.'view/admin/vheader_admin.php');
else:
    require(ROOT.'view/vheader_prof.php');
endif;

?>


