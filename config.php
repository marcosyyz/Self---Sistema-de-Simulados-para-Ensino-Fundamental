<?php
  // inicia a sessão
session_cache_expire(1);
session_start('aluno');

//variaveis de caminhos
define('ROOT_URL', 'http://info01/aluno/');
define('ROOT', dirname(__FILE__) . '/');

define('TIPO_SIMULADO', 1);
define('TIPO_DIGITAR', 2);


$GLOBALS["ROOT"] = ROOT;

require ROOT.'model/System.php';
$System = New System();



?>
