<?php
include '../../config.php';
include ROOT.'model/Galeria.php';
 
 
$filtro = isset($_POST['filtro']) ? $_POST['filtro'] : -1 ; 
$pasta = isset($_POST['caminho']) ? $_POST['caminho'] : -1 ; 
$subir = isset($_POST['subir']) ? $_POST['subir'] : 0 ; 


 
if($subir == 1){    
    $pasta = Galeria::diretorio_acima($pasta);    
}


//traz arquivos e pastas
 if(($filtro == -1) || ($filtro == '')){
    if($pasta != -1){ // pastas
        $arquivos = Galeria::lista_diretorios($pasta);
        echo ' <input type="hidden" id="diretorio_atual"  value="'.Galeria::getDirAtual().'"/>';         
        echo ' <span id="caminho-atual">Você esta em: '.Galeria::getDirAtual().'<br></span>';
        echo ' <ul class="galeria">';
        foreach ($arquivos as $i => $a){             
            echo "<li>
            <a href=\"javascript:entrar_na_pasta('". str_replace('\\','\\\\', $a).'\\\\'."');\" data-source='#' title='teste'
                    style='width:193px;height:125px;'>
                    <img class='img-galeria' src='".ROOT_URL."view/img/pastinha.png' width='200' height='150' />
                    <span><br>".basename($a)."</span>
                    </a>
                 </li>";
        }
    }
    
  //arquivos 
    $arquivos = Galeria::lista_arquivos($pasta);
    foreach ($arquivos as $i => $a){ 
            echo ' <li>
                <a href="javascript:enviar_imagem_ao_pai(\''.str_replace('view/img/atividades/','',$a['path'].$a['file']).'\');" data-source="#" title="teste" 
                style="width:193px;height:125px;">
                <img class="img-galeria" src="'.ROOT_URL.$a['path'].$a['file'].'" width="200" height="150" />
                </a><span><br>'.$a["file"].'</span>                    
                </li>';
    } 
             
    echo '</ul>';        
}
 

    if(($filtro != -1) && ($filtro != '')){
        $arquivos = Galeria::busca_arquivos_recursivo($filtro, $pasta);
        echo ' <input type="hidden" id="diretorio_atual"  value="'.Galeria::getDirAtual().'"/>';         
        echo ' <span id="caminho-atual">Você esta em: '.Galeria::getDirAtual().'<br></span>';
        echo '<div id="total"> Total Encontrado: '.Galeria::getTotal().'</div> '; 
        echo ' <ul class="galeria">';
        foreach ($arquivos as $i => $c){ 
            echo ' <li>
                 <a href="javascript:enviar_imagem_ao_pai(\''.str_replace('\\','/',ROOT_URL.$c['path']).'\');" data-source="#" title="teste" 
                    style="width:193px;height:125px;">
                     <img class="img-galeria" src="'.ROOT_URL.$c['path'].'" width="200" height="150" />
                 </a><span><br>'.$c["file"].'</span>
                </li>';
        }
        echo '</ul>';        
    }



