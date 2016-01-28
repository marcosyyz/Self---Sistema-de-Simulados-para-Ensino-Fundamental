<?php 

include('../../../config.php');
include(ROOT."view/vhead.php");
require(ROOT.'view/admin/vheader_admin.php');
include_once(ROOT.'model/admin/descritor.php');


$topico =  isset($_GET['t'])?  $_GET['t'] : -1;
$descritor = new Descritor();
        



if($topico == -1):// if nao tem topico no filtro  listar todos
    $topicos = $descritor->lista_topicos($topico);
else:
    $topicos = null;
endif;



$descritores = $descritor->lista_descritores($topico);





include ROOT.'view/cadastros/descritores/vdescritores.php';