<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/admin.css" />
</head>

<title>Cadastro de Usuarios - SELF</title> 
<body data-speed="10" class="bg-Parallax">           
       
       
       <form name="form-edit-usuario" method="post" action="<?php echo ROOT_URL;?>control/cadastros/usuarios/gravar_usuario.php">       
       <div class="fundo-edicao padding">                              
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Codigo:</span> <br><?php echo $usuario_cdg ?>
            </span>
           
    
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
           
           <span class="campo_de_edicao">
               <span class="titulo_campo_edicao">Nome:</span> <br>
               <input class="fundo_campo_edicao" type="text"  placeholder="Ex. 1" name="nome" id="campo_titulo" value="<?php echo $nome; ?>" ></input>
            </span>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            <span class="campo_de_edicao">
               <span class="titulo_campo_edicao">Login:</span> <br> 
               <input class="fundo_campo_edicao" type="text"  placeholder="Ex. A " name="login" id="campo_descricao" value="<?php echo $login; ?>" ></input>
            </span>   
            

            
            <span class="campo_de_edicao">
               <span class="titulo_campo_edicao">Senha:</span> <br> 
               <input class="fundo_campo_edicao" type="password"  placeholder="Ex. A " name="senha" id="campo_descricao" value="<?php echo $senha; ?>" ></input>
            </span>   
            
            <p><br></p>
            
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Cargo:</span> <br> 
               <select name="cargo">
                    <option <?php echo ($cargo == 'Professor') ? 'selected' : '' ?> value="Professor" >Professor</option>
                    <option <?php echo ($cargo == 'Orientador de informática') ? 'selected' : '' ?> value="Orientador de informática" >Orientador de informática</option>
                            
               </select> <br>
            </span>
             <br><br><br><br>
           
         
            
          
       
                 
            
           <br><br><br><br>
           
           
           
           
            <input type="hidden" name="usuario_cdg" value="<?php echo $usuario_cdg?>"
           <br> 
    
          
            <br>    
           <div        
            <!-- $$$$$$      botoes de cadastro        $$$$$$$ -->
           &nbsp;<a class="botao_azul" href="<?php echo ROOT_URL."control/cadastros/usuarios/edit_usuario.php" ?>" >Novo</a>
           <button type="submit">Salvar</button>
           
           <a class="botao_vermelho"  href="<?php echo ROOT_URL.'control/cadastros/usuarios' ?>"> Voltar</a>                      
           
           <!-- $$$$$$$$$  fim botoes                 $$$$$$$$$$--->
           </div>
       </div>
       </form>
       </div>
</body>
       