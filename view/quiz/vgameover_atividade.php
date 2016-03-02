<?php 


$_SESSION['SOM'] = 'queda.mp3';
include_once('../../config.php');
include(ROOT . "view/vhead.php"); 

if($_SESSION['TIPO_PROGRESSO'] == 1):
  $url_redirecionamento =  ROOT_URL;
else:
  $url_redirecionamento =  ROOT_URL."control/quiz/iniciar_atividade.php?a=".$_SESSION['ATIVIDADE_ATUAL'];
endif;
?>

         
                


</head>
<title>SELF</title> 
 </head> 
 <body  data-speed="10" class="bg-Parallax">      
 <div id="transparente-div-home"> 
 
<div id="alBox"></div>

<script>
    $( document ).ready(function() {        
        var titulo = "TENTE NOVAMENTE..";
        var descricao ="Você errou 3 vezes =/, terá que fazer esta atividade do começo de novo.";
        var segundos = 300;
        var contexto = "warning";
        var redirecionar = "<?php echo $url_redirecionamento; ?>"; 

        $("#alBox").al({
            context: contexto,
            text: {
                title: titulo,
                description: descricao
            },
            seconds: segundos,
            redirect: redirecionar
        });
    });

</script>