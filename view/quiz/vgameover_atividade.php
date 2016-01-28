<?php 


$_SESSION['SOM'] = 'queda.mp3';
include_once('../../config.php');
include(ROOT . "view/vhead.php"); 

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
        var descricao ="Você errou 3 vezes =/, terá que fazer essa atividade do começo de novo.";
        var segundos = 300;
        var contexto = "warning";
        var redirecionar = "<?php echo ROOT_URL; ?>"; 

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