<?php 
 include '../../config.php';
 include ROOT.'model/Galeria.php';
 
 $arquivos = Galeria::lista_arquivos(trim(ROOT.'view/img/atividades/'));
 $pastas = Galeria::lista_diretorios(trim(ROOT.'view/img/atividades/'));
 
 $campo_de_volta = isset($_GET['cbc']) ? $_GET['cbc'] : '';
 $src_img_de_volta = isset($_GET['cbimg']) ? $_GET['cbimg'] : '';
 
 
?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />		              
        <link href="<?php echo ROOT_URL?>view/css/galeria.css" rel="stylesheet" />                      
        <script src="<?php echo ROOT_URL ?>view/js/jquery-ui.min.js"></script>
</head>

<script>
 
function subir_diretorio(pasta){        
    
    
    $(document).ajaxStart(function () {
        $(".loading").show();
    });

    $(document).ajaxStop(function () {
        $(".loading").hide();
    });

    $.ajax({
              method: "POST",
              url: "pesquisar_img.php",
              data: { caminho:  $('#diretorio_atual').val() ,
                     subir: 1
                }
            }).done(function( retorno ) {
                 //alert( "Data Saved: " + msg );
                 $("#corpo").html(retorno);                     
            });
}
     
function entrar_na_pasta(pasta){
    $(document).ajaxStart(function () {
        $(".loading").show();
    });

    $(document).ajaxStop(function () {
        $(".loading").hide();
    });

   //alert(pasta);
    $.ajax({
              method: "POST",
              url: "pesquisar_img.php",
              data: { caminho:  pasta                          
                }
            }).done(function( retorno ) {
                 //alert( "Data Saved: " + msg );
                 $("#corpo").html(retorno);                     
            });
}
    

function enviar_imagem_ao_pai(valor){    
    var campo_de_volta = document.getElementById('campo_de_volta').value;
    var src_img_de_volta = document.getElementById('src_img_de_volta').value;
    //alert(campo_de_volta);
    window.opener.document.getElementById(campo_de_volta).value = valor;
    window.opener.document.getElementById(src_img_de_volta).src = valor;    
    window.close();    
}

function aumentar_img(){  
    $(".img-galeria").height($(".img-galeria").height()+20);    
}

function diminuir_img(){  
    $(".img-galeria").height($(".img-galeria").height()-20);    
}



$(document).ready(function() {
    $(".loading").hide();       
    //filtrar ao digitar filtro
    $("#campo-pesquisa-img").keyup(function(e) {
        var outras_teclas = [9,16,17,18,19,20,27,33,34,35,36,37,38,39,40,44,45,91,113,114,115,116,117,118,119,120,121,122,144,145];
        var tecla = e.keyCode;
                       
        
        $(document).ajaxStart(function () {
            $(".loading").show();
        });

        $(document).ajaxStop(function () {
            $(".loading").hide();
        });
        
        
         if(!($.inArray(tecla, outras_teclas) >= 0 )){
            //alert(tecla);    
            $.ajax({
                  method: "POST",
                  url: "pesquisar_img.php",
                  data: { filtro:  $('#campo-pesquisa-img').val(),
                          caminho: $('#diretorio_atual').val()
                        }
                }).done(function( msg ) {
                     //alert( "Data Saved: " + msg );
                     $("#corpo").html(msg);
                });
            }
    });
});

</script>

<html>
<body>
     <input type="hidden" id="campo_de_volta"  value="<?php echo $campo_de_volta ?>"/>
     <input type="hidden" id="src_img_de_volta"  value="<?php echo $src_img_de_volta?>"/>    
    <div class="galeria-box-pesquisa" >     
        <input type="text" value="" id="campo-pesquisa-img" name="campo-pesquisa-img" placeholder="Pesquisar"/>
        <div style="float:right; position:relative;">            
            <a href="javascript:diminuir_img();">-</a>&nbsp;
            <a href="javascript:aumentar_img();">+</a>
        </div>
    </div>
    
     <a class="borda" href="javascript:subir_diretorio();">Voltar</a>    
     <div id="corpo">
         <input type="hidden" id="diretorio_atual"  value="<?php echo Galeria::getDirAtual();?>"/>
         <span id="caminho-atual">Você esta em: <?php echo Galeria::getDirAtual();?><br></span>     
    <?php
        echo ' <ul class="galeria">';
        foreach ($pastas as $i => $a){ 
            // barra normal precisa de 4 pq ao entrar NESTA string vira duas, 
            // e ao entrar na string do browser durante compílacao vira uma.            
            echo "<li>
                <a href=\"javascript:entrar_na_pasta('". str_replace('\\','\\\\', $a).'\\\\'."');\" data-source='#' title='teste'
                    style='width:193px;height:125px;'>
                     <img class='img-galeria' src='".ROOT_URL."view/img/pastinha.png' width='200' height='150' />
                 <span><br>".basename($a)."</span>
                     </a>
              </li>";
        }
        
        foreach ($arquivos as $i => $a){ 
            echo ' <li>
                <a href="javascript:enviar_imagem_ao_pai(\''.str_replace('view/img/atividades/','',$a['path'].$a['file']).'\');" data-source="#" title="teste" 
                style="width:193px;height:125px;">
                <img class="img-galeria" src="'.ROOT_URL.$a['path'].$a['file'].'" width="200" height="150" />
                </a><span><br>'.$a["file"].'</span>
                </li>';
        }
        echo '</ul>';        
    ?>
    </div>
    
    <div class="loading" ><img src="<?php echo ROOT_URL.'view/img/loading.png'?>" /></div>       
</body>
</html>