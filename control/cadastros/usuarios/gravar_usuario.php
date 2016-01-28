<?php
require '../../../config.php';
require ROOT.'model/admin/admin_usuario.php';


$usuario_cdg = isset($_POST['usuario_cdg']) ? $_POST['usuario_cdg'] : -1;
$nome = isset($_POST['nome']) ?  $_POST['nome'] : '' ;
$login = isset($_POST['login']) ?  $_POST['login'] : '' ;
$senha = isset($_POST['senha']) ?  $_POST['senha'] : '' ;
$cargo = isset($_POST['cargo']) ?  $_POST['cargo'] : '' ;

$usuario_cdg =  $usuario_cdg == '' ? -1 : $usuario_cdg;

$Usuario = new Usuario($usuario_cdg);


         
$usuario_inserida =  $Usuario->gravar(                
        $usuario_cdg,
        $nome,
        $login,
        $senha,
        $cargo,
        $_SESSION['ESCOLA']
        );


//die;

 if($usuario_inserida != -1) {
     $usuario_cdg =  $usuario_inserida ;
}
 
 
 
  header("Location: ".ROOT_URL."control/cadastros/usuarios/edit_usuario.php?u=".$usuario_cdg."&s=s");