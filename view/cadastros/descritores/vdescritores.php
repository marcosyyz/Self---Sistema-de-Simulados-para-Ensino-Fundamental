
</head>
 <div>      
    <?php if($topico == -1){  // if nao tem topico ?>
    <td width="546" height="300"> 
        <p class="centro branco titulo"> ► Tópicos ► </p>
        <table cellpadding="2" cellspacing="2">
                <tr>
                        <td class='cabecalho_table'><strong>Código</strong></th>
                        <td class='cabecalho_table'><strong>Tópico</strong></th>
                        <td class='cabecalho_table'><strong>Matéria</strong></th>
                        <td class='cabecalho_table'><strong>Nº Questões</strong></th>                        
                </tr>

        <?php foreach($topicos as $topic ){ ?>    

                <tr>		
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/descritores/index.php?t='.$topic['TOPICODESC_CDG'] ?>'><?php echo $topic['TOPICODESC_CDG']; ?></a></td>
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/descritores/index.php?t='.$topic['TOPICODESC_CDG'] ?>'><?php echo $topic['TOPICODESC_NOME']; ?></a></td>
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/descritores/index.php?t='.$topic['TOPICODESC_CDG'] ?>'><?php echo $topic['MATERIA_NOME']; ?></a></td>                
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/descritores/index.php?t='.$topic['TOPICODESC_CDG'] ?>'><?php echo $topic['N_QUESTOES']; ?></a></td>                        
                        
                </tr>



        <?php } // foreach ?>
        </table>
    <?php } // if  nao tem topico  ?>  
         
        <p class="centro branco titulo"> ► Descritores ► </p>
        <table cellpadding="2" cellspacing="2">
                <tr>
                        <td class='cabecalho_table'><strong>Código</strong></th>
                        <td class='cabecalho_table'><strong>Descrição</strong></th>
                        <td class='cabecalho_table'><strong>Matéria</strong></th>
                        <td class='cabecalho_table'><strong>Nº Questões</strong></th>                        
                </tr>

        <?php foreach($descritores as $descri ){ ?>    

                <tr>		
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/index.php?d='.$descri['DESCRITOR_CDG'] ?>'><?php echo $descri['DESCRITOR_CODIGO']; ?></a></td>
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/index.php?d='.$descri['DESCRITOR_CDG'] ?>'><?php echo $descri['DESCRITOR_DESC']; ?></a></td>
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/index.php?d='.$descri['DESCRITOR_CDG'] ?>'><?php echo $descri['MATERIA_NOME']; ?></a></td>                
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/index.php?d='.$descri['DESCRITOR_CDG'] ?>'><?php echo $descri['N_QUESTOES']; ?></a></td>                        
                        
                </tr>



        <?php } ?>
        </table>
    </td>   
    <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
    </a>
   
 </div>
     
 
 
 </table> 
 </div>
 </body> 
 </html>

