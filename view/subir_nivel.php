<?php 

$_SESSION['SOM'] = 'subiu_nivel.mp3';
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
        var titulo = "PARABÉNS!!";
        var descricao ="<center>Você subiu de nível.</center>";
        var segundos = 300;
        var contexto = "success";
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