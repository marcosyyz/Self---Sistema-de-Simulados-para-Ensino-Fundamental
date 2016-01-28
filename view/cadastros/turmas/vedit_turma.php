<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>view/css/admin.css" />
</head>

<title>Cadastro de Turmas - SELF</title> 
<body data-speed="10" class="bg-Parallax">           
       
       
       <form name="form-edit-turma" method="post" action="<?php echo ROOT_URL;?>control/cadastros/turmas/gravar_turma.php">       
       <div class="fundo-edicao padding">                              
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Codigo:</span> <br><?php echo $turma_cdg ?>
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
               <span class="titulo_campo_edicao">Numero:</span> <br>
               <input class="fundo_campo_edicao" type="text"  placeholder="Ex. 1" name="serie" id="campo_titulo" value="<?php echo $numero; ?>" ></input>
            </span>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            <span class="campo_de_edicao">
               <span class="titulo_campo_edicao">Letra:</span> <br> 
               <input class="fundo_campo_edicao" type="text"  placeholder="Ex. A " name="letra" id="campo_descricao" value="<?php echo $letra; ?>" ></input>
            </span>   
            
            
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Ano:</span> <br> 
               <select name="ano">
                    <option <?php echo ($ano == 2015) ? 'selected' : '' ?> value="2015" >2015</option>
                    <option <?php echo ($ano == 2016) ? 'selected' : '' ?> value="2016" >2016</option>
                    <option <?php echo ($ano == 2017) ? 'selected' : '' ?> value="2017" >2017</option>                    
               </select> <br>
            </span>
             <br><br><br><br>
           
            <span class="campo_de_edicao">
                <span class="titulo_campo_edicao">Professor:</span> <br> 
               <select  name="prof">
                    <option selected disabled>Selecione o Professor</option>
                   <?php foreach ($professores as $p){
                       echo '<option '.($prof_cdg == $p['USUARIO_CDG'] ? 'selected' : '' ).' value="'.$p['USUARIO_CDG'].'" >'.$Professor->cdg_para_nome($p['USUARIO_CDG']).'</option>';
                   }
                   ?>
               </select> <br>
            </span>
            
          
       
                 
            
           <br><br><br><br>
           
           
           
           
            <input type="hidden" name="turma_cdg" value="<?php echo $turma_cdg?>"
           <br> 
    
          
            <br>    
           <div        
            <!-- $$$$$$      botoes de cadastro        $$$$$$$ -->
           &nbsp;<a class="botao_azul" href="<?php echo ROOT_URL."control/cadastros/turmas/edit_turma.php" ?>" >Novo</a>
           <button type="submit">Salvar</button>
           
           <a class="botao_vermelho"  href="<?php echo ROOT_URL.'control/cadastros/turmas' ?>"> Voltar</a>                      
           
           <!-- $$$$$$$$$  fim botoes                 $$$$$$$$$$--->
           </div>
       </div>
       </form>
       </div>
</body>
       