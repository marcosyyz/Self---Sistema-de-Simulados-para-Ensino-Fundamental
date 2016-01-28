<?php
require '../../config.php';

$parametro_atual = isset($_POST['parametro_atual']) ? $_POST['parametro_atual'] : ROOT_URL ;
$escola_atual = isset($_POST['escola']) ? $_POST['escola'] : -1 ;

if($parametro_atual == 0){
    $url = ROOT_URL.'index.php?e='.$escola_atual;
}elseif($parametro_atual == 1){
    $url = ROOT_URL.'index.php?p=1&e='.$escola_atual;
}

//echo $url;

?>
<script>
   window.location = '<?php echo $url ?>';
</script>



