<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/admin.css" />
</head>

<title>Cadastro de Atividades - SELF</title> 
<body data-speed="10" class="bg-Parallax">           
       
       
       <form name="form-edit-atividade" method="post" action="<?php echo ROOT_URL;?>control/cadastros/atividades/gravar_atividade.php">       
       <div class="fundo-edicao padding">                              
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Codigo:</span> <br><?php echo $atividade_cdg ?>
            </span>
           
    
            <?php if($atividade_cdg != -1 ){ ?>
                  &nbsp;&nbsp;
                <a href="<?php echo ROOT_URL ?>control/cadastros/atividades/edit_atividade.php?a=<?php 
                            $prioid = $atividade->anteriorid($ordem) ;
                            echo ($prioid == -1 ? $atividade_cdg : $prioid );
                         ?>" >
                    <img src="<?php echo ROOT_URL ?>view/img/prior.png"  height="20px"/>
                </a>           
                &nbsp;&nbsp;
                <a href="<?php echo ROOT_URL ?>control/cadastros/atividades/edit_atividade.php?a=<?php                         
                            $nextid = $atividade->proximoid($ordem) ;
                            echo $nextid == -1 ? $atividade_cdg : $nextid ;
                         ?>" >
                    <img src="<?php echo ROOT_URL ?>view/img/next.png"  height="20px"/>
                </a>        
            
            
            <?php 
                }//fim if atividade_cdg == -1 
            
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
           
           <span class="campo_de_edicao">
               <span class="titulo_campo_edicao">Titulo da atividade:</span> <br>
               <input class="fundo_campo_edicao" type="text"  placeholder="Ex. Silabas Complexas" name="nome" id="campo_titulo" value="<?php echo $titulo; ?>" ></input>
            </span>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            <span class="campo_de_edicao">
               <span class="titulo_campo_edicao">Descrição:</span> <br> 
               <input class="fundo_campo_edicao" type="text"  placeholder="Ex. Provinha Quinta Série" name="desc" id="campo_descricao" value="<?php echo $descricao; ?>" ></input>
            </span>   
            
            
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Nível:</span> <br> 
               <select name="nivel">
                    <option <?php echo ($nivel == 1) ? 'selected' : '' ?> value="1" >1</option>
                    <option <?php echo ($nivel == 2) ? 'selected' : '' ?> value="2" >2</option>
                    <option <?php echo ($nivel == 3) ? 'selected' : '' ?> value="3" >3</option>
                    <option <?php echo ($nivel == 4) ? 'selected' : '' ?> value="4" >4</option>
                    <option <?php echo ($nivel == 5) ? 'selected' : '' ?> value="5" >5</option>
               </select> <br>
            </span>
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Série:</span> <br> 
               <select name="serie">
                    <option <?php echo ($serie == 1) ? 'selected' : '' ?> value="1" >1ª</option>
                    <option <?php echo ($serie == 2) ? 'selected' : '' ?> value="2" >2ª</option>
                    <option <?php echo ($serie == 3) ? 'selected' : '' ?> value="3" >3ª</option>
                    <option <?php echo ($serie == 4) ? 'selected' : '' ?> value="4" >4ª</option>
                    <option <?php echo ($serie == 5) ? 'selected' : '' ?> value="5" >5ª</option>
               </select> <br>
            </span>
            
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Tipo da atividade:</span><br> 
               <select name="tipo" >
                    <option <?php echo ($tipo == 0) ? 'selected' : '' ?> value="0">3 Tentativas (padrão)</option>
                    <option <?php echo ($tipo == 1) ? 'selected' : '' ?> value="1">Provinha</option>
               </select> <br>
            </span>
            <br><br><br><br>
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Ordem:</span> <br> 
               <input type="text"  placeholder="1" name="ordem" id="campo_ordem" value="<?php echo $ordem ?>" ></input>
            </span>           
            
           <br><br><br><br>
           
           
           
           <span class="">
               &nbsp;<input id="chk_verificaacento"  <?php echo $chk_verificaacento == 1 ? 'checked' : ''  ?>   type="checkbox" name="verificaacento"/> 
           <label for="chk_verificaacento">Verificar acentuação nas questões de digitação (não aconselhado para atividades de 1º e 2º ano)</label> 
          
           </span>
            <input type="hidden" name="atividade_cdg" value="<?php echo $atividade_cdg?>"
           <br> 
            <br>
            <br>
            <br>
            <br>
             <?php if($atividade_cdg != -1 ){ ?>
            <span class="titulo_campo_edicao">&nbsp;Link da Atividade:&nbsp;</span><?php echo ROOT_URL ?>control/quiz/iniciar_atividade.php?a=<?php echo $atividade_cdg ?> <br>
            <?php } ?>
            <br> 
            <br>
            <br>    
           <div        
            <!-- $$$$$$      botoes de cadastro        $$$$$$$ -->
           &nbsp;<a class="botao_azul" href="<?php echo ROOT_URL."control/cadastros/atividades/edit_atividade.php" ?>" >Novo</a>
           <button type="submit">Salvar</button>
           <a class="botao_azul" target="_blank" href="<?php echo ROOT_URL."control/quiz/iniciar_atividade.php?a=".$atividade_cdg ?> " >Preview</a>
           <a class="botao_vermelho"  href="<?php echo ROOT_URL.'control/cadastros/atividades' ?>"> Cancelar</a>                      
           
           <!-- $$$$$$$$$  fim botoes                 $$$$$$$$$$--->
           </div>
       </div>
       </form>
       </div>
</body>
       