<?php

include_once('../../config.php');
include(ROOT."model/admin/questao.php");
include(ROOT."model/admin/materia.php");
include(ROOT."model/admin/manutencao.php");
include(ROOT."model/admin/admin_usuario.php");
include(ROOT."view/vhead.php");

$questao_cdg =  isset($_GET['q'])?  $_GET['q'] : -1;

$questao = new Questao($questao_cdg);    

$materia = new Materia();
$usuario = new Admin_Usuario();



require('vheader_admin.php');


$funcao =  isset($_GET['f'])?  $_GET['f'] : -1;

if($funcao == 'update_refazer' ){      
   //  $manut = new Manut() ;
   ///  $manut->atualizar_refazer_em_30_dias(22);
//     $manut->atualizar_refazer_em_45_dias(22);
///     $manut->atualizar_refazer_em_60_dias(22);
                
}

?>
<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/admin.css" />
</head>

<title>SELF</title> 
 <body data-speed="10" class="bg-Parallax">           
   <div id="transparente-div-home">
                  <a class="botao_azul"  href="<?php echo ROOT_URL; ?>view/admin/vtools.php?f=update_refazer"> Atualizar Atividades a Refazer</a>
   
   </div>
       
 