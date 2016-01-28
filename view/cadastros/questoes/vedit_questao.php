
<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/admin.css" />
</head>

<title>SELF - Cadastro de Questões</title> 
 <body data-speed="10" class="bg-Parallax">           
   <div id="transparente-div-home">
       
       <form name="form-edit-questao" method="post" action="<?php echo ROOT_URL;?>control/cadastros/questoes/gravar_questao.php">       
       <div class="fundo-edicao padding">
           <span class="titulo_campo_edicao">Questão Codigo:<?php echo $questao_cdg?> </span>
            &nbsp;&nbsp;
            <a href="<?php echo ROOT_URL ?>control/cadastros/questoes/edit_questao.php?q=<?php 
                        $priorid =  $questao->anteriorid($questao_cdg) ;
                        echo ($priorid == -1 ? $questao_cdg : $priorid );
                     ?>" >
                <img src="<?php echo ROOT_URL ?>view/img/prior.png"  height="20px"/>
            </a>           
            &nbsp;&nbsp;
            <a href="<?php echo ROOT_URL ?>control/cadastros/questoes/edit_questao.php?q=<?php                         
                        $nextid = $questao->proximoid($questao_cdg) ;
                        echo $nextid == -1 ? $questao_cdg : $nextid ;
                     ?>" >
                <img src="<?php echo ROOT_URL ?>view/img/next.png"  height="20px"/>
            </a>        
            
            
            <?php 
                $status_msg =  isset($_GET['s'])?  $_GET['s'] : '-1';
                if($status_msg == 'c'){
                    echo '<span class="status_ok">';
                    echo 'Copiado.';
                    echo '</span>';
                }                
                if($status_msg == 's'){
                    echo '<span class="status_ok">';
                    echo 'Salvo.';
                    echo '</span>';
                }                
            ?>
            <br><br>
            <input type="hidden" name="questao_cdg" value="<?php echo $questao_cdg?>"
           
           
                  <span class="campo_revisao" >
                  </span>
          
                  
                  
       <span class="campo_materia">
           <span class="titulo_campo_edicao">Materia:<br></span>
           <select name="materia" class="fundo_campo_edicao">
               <?php                   
                $materias = $materia->carregar_materias();
                   if ($materias->last_result) {
                      if ($materias->RowCount() > 0)   {
                        while ($linha = mysqli_fetch_array($materias->last_result,MYSQLI_NUM)) {
                           echo "<option value=".$linha[0].">".$linha[1]."</option>";
                        }
                      }
                   }
                   
                ?>
           </select>
           </span>                  
           
           <span class="campo_criador">
                <span class="titulo_campo_edicao">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Criado por:<br>
                </span>
               <input type="text"  name="criador"  disabled="disabled" class="campo_criador"  value="
               <?php echo $usuario->cdg_para_nome(
                        isset($questao->campo->QUESTAO_CRIADOR) ? $questao->campo->QUESTAO_CRIADOR : -1); ?>" >
               </input>
           </span>    
           
           
        
                  
                  
           <span class="campo_revisao">
           <span class="titulo_campo_edicao">
                Revisão por:<br>
           </span>
           <select name="revisor_cdg" class="fundo_campo_edicao">
               <?php                   
                   $usuarios = $usuario->carregar_nomes_usuarios();
                   if ($usuarios->last_result) {
                      if ($usuarios->RowCount() > 0)   {
                        while ($linha = mysqli_fetch_array($usuarios->last_result,MYSQLI_NUM)) {
                           echo "<option  value=".$linha[0].">".$linha[1]."</option>";
                        }                        
                      }                      
                   }
                   
                ?>
           </select>
           </span>
           
           <span class="data_criacao">
               <span class="titulo_campo_edicao">Criação </span><br> 
                   <?php echo isset($questao->campo->QUESTAO_DTCRIACAO) ? $questao->campo->QUESTAO_DTCRIACAO: '' ;  ?>
           </span>
           
           <span class="data_alteracao">
               <span class="titulo_campo_edicao">Última Alteração</span> <br> 
                   <?php echo isset($questao->campo->QUESTAO_DTMOD) ? $questao->campo->QUESTAO_DTMOD : '' ; ?>
           </span>
           
           
           <br><br><br>
           <span class="titulo_campo_edicao">Pergunta:</span><br>
           <input type="text"  placeholder="Opcional" name="pergunta" id="campo_pergunta"  value="<?php echo isset($questao->campo->QUESTAO_PERGUNTA)? $questao->campo->QUESTAO_PERGUNTA: ''; ?>" ></input>
           <br><br>
           
           <span class="titulo_campo_edicao">Texto:</span><br>
           <textarea name="texto"  placeholder="Opcional" id="txtArea" style="height: 120px" rows="6" cols="70" ><?php echo isset($questao->campo->QUESTAO_TEXTO)?$questao->campo->QUESTAO_TEXTO :  '' ; ?></textarea>
           <br><br>
           <span class="titulo_campo_edicao">Caminho atual da Imagem:<br>
           <input id="imagem-input" type="text" name="imagem" value="<?php echo isset($questao->campo->QUESTAO_IMAGEM)?$questao->campo->QUESTAO_IMAGEM:''; ?>" ></input>
           &nbsp;&nbsp;&nbsp;&nbsp;
           <input type="file" id="upload">
           
           <div class="posicao_right">
               <a href="javascript:abrirGaleria();">
                   <span style="color:#5db056;top:-30px;left:200px;position:relative;" for="files"> <span class="">Selecionar imagem da Galeria</span></span> 
               </a>
               
               <span class="titulo_campo_edicao">Posição da imagem:&nbsp;</span>
                <input type="radio" name="imagem_pos" value="1" <?php echo (isset($questao->campo->QUESTAO_IMAGEM_POS)?$questao->campo->QUESTAO_IMAGEM_POS:0) == 1 ? "checked": "" ; ?>>Esquerda
                <input type="radio" name="imagem_pos" value="0" <?php echo (isset($questao->campo->QUESTAO_IMAGEM_POS)?$questao->campo->QUESTAO_IMAGEM_POS:0) == 0 ? "checked": "" ; ?>>centro
                <input type="radio" name="imagem_pos" value="2" <?php echo (isset($questao->campo->QUESTAO_IMAGEM_POS)?$questao->campo->QUESTAO_IMAGEM_POS:0) == 2 ? "checked": "" ; ?>>Direita           
           </div>
           <br><br>
           
           <?php if(isset($questao->campo->QUESTAO_IMAGEM)){ ?>
            <img id="img-preview" class="img_preview" src="<?php echo ROOT_URL."view/img/atividades/".$questao->campo->QUESTAO_IMAGEM ?>" />
           <?php } ?>
           
           <span class="verde">Alternativa Correta:</span><br>
           <input type="text" name="opcao1" class="campo_alternativa" value="<?php echo isset($questao->campo->QUESTAO_OPCAO1)?$questao->campo->QUESTAO_OPCAO1:''; ?>" ></input>
           <br><br>
           
           <span class="vermelho">Alternativa Errada 1:</span><br>
           <input type="text" name="opcao2" class="campo_alternativa" value="<?php echo isset($questao->campo->QUESTAO_OPCAO2)?$questao->campo->QUESTAO_OPCAO2:''; ?>" ></input>
           <br><br>
           
           <span class="vermelho">Alternativa Errada 2:</span><br>
           <input type="text" placeholder="Opcional" class="campo_alternativa"   name="opcao3" value="<?php echo isset($questao->campo->QUESTAO_OPCAO3)?$questao->campo->QUESTAO_OPCAO3:''; ?>" ></input>
           <br><br>                      
           
           <span class="vermelho">Alternativa Errada 3:</span><br>
           <input type="text" placeholder="Opcional" class="campo_alternativa" name="opcao4" value="<?php echo isset($questao->campo->QUESTAO_OPCAO4)?$questao->campo->QUESTAO_OPCAO4:''; ?>" ></input>
           <br><br>
           
           <span class="vermelho">Alternativa Errada 4:</span><br>
           <input type="text" placeholder="Opcional" class="campo_alternativa"  name="opcao5" value="<?php echo isset($questao->campo->QUESTAO_OPCAO5)?$questao->campo->QUESTAO_OPCAO5:''; ?>" ></input>
           <br><br>
           
           
           <a class="botao_azul" href="<?php echo ROOT_URL."control/cadastros/questoes/edit_questao.php" ?>" >Novo</a>
           <button type="submit">Salvar</button>
           <a class="botao_azul" target="_blank" href="<?php echo ROOT_URL."view/quiz/vquiz.php?q=".$questao->campo->QUESTAO_CDG ?> " >Preview</a>
           <a class="botao_vermelho"  href="<?php echo ROOT_URL."control/cadastros/questoes" ?>"> Cancelar</a>           
           
           <a class="posicao_right" href="<?php echo ROOT_URL."control/admin/duplicar_questao.php?q=".$questao_cdg ?>" ><img width="50px" src="<?php echo ROOT_URL."view/img/duplic.png" ?>"/>Criar Cópia</a>
        </div>
    </form>
       
 <script>
var janela;    
function abrirGaleria(){
    quintow = (window.screen.width/5);
    quintoh = (window.screen.height/4);
    janela = window.open("<?php echo ROOT_URL?>view/galeria/galeria.php?cbc=imagem-input&cbimg=img-preview", "Galeria de Imagens", 
        "width="+(window.screen.width-quintow)+", height="+(window.screen.height-quintoh)+", left="+(quintow/2)+", top="+(quintoh/2));    
}
</script>