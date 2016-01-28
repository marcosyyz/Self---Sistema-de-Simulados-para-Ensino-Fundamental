<?php
/* Define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(1);
$cache_expire = session_cache_expire();

/* Inicia a sessão */
session_start();
echo "O limitador de cache esta definido agora como $cache_limiter<br />"; 
echo "As sessões em cache irão expirar em $cache_expire minutos";
   
  // vamos percorrer o array $_SESSION
  $i = 0;
  echo " Expira em ".session_cache_limiter()."  <p>";
  foreach($_SESSION as $session => $valor){      
    if(is_array($valor)){
        $i = 0;
        echo "\$_SESSION['$session'] : <br> ";
        foreach($valor as $s2 => $v2){            
            echo " - \$_SESSION['$session'][".$i."] = " . $v2 . "<br>";
            $i++;
        }            
        $i = 0;
    }else{
            echo "\$_SESSION['$session'] = " . $valor . "<br>";
    }
  }
?>

