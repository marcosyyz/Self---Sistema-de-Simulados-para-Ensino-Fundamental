</head>

<body>
<form action="<?php echo $action_pesquisa ; ?>"  method="POST">        
<?php include ROOT.'view/inc/pesquisar.php'; ?>
    
 <div>           
    <td width="546" height="300"> 
           <p class="centro branco titulo"> Questões 
               <?php  echo ($descritor == -1 ) ? "" :  " com Descritor ".$descritor; ?></p>
           
            <table cellpadding="2" cellspacing="2">
                <tr>
                        <td class='cabecalho_table'><strong>Código</strong></th>
                        <td class='cabecalho_table'><strong>Pergunta</strong></th>
                        <td class='cabecalho_table'><strong>Som</strong></th>
                        <td class='cabecalho_table'><strong>Imagem</strong></th>                        
                        <td class='cabecalho_table'><strong>Alternativa Correta</strong></th>
                        <td class='cabecalho_table'><strong>Matéria</strong></th>                                                
                        <td class='cabecalho_table'><strong>Descritor</strong></th>
                </tr>

             <?php foreach($questoes as $quest ){ ?>    

                <tr>		
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/edit_questao.php?q='.$quest['QUESTAO_CDG'] ?>'><?php echo $quest['QUESTAO_CDG']; ?></a></td>
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/edit_questao.php?q='.$quest['QUESTAO_CDG'] ?>'><?php echo $quest['QUESTAO_PERGUNTA']; ?></a></td>
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/edit_questao.php?q='.$quest['QUESTAO_CDG'] ?>'><?php echo $quest['QUESTAO_SOM']; ?></a></td>                
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/edit_questao.php?q='.$quest['QUESTAO_CDG'] ?>'><?php echo $quest['QUESTAO_IMAGEM']; ?></a></td>                        
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/edit_questao.php?q='.$quest['QUESTAO_CDG'] ?>'><?php echo $quest['QUESTAO_OPCAO1']; ?></a></td>                                                
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/edit_questao.php?q='.$quest['QUESTAO_CDG'] ?>'><?php echo $quest['MATERIA_NOME']; ?></a></td>                        
                        <td ><a href='<?php echo ROOT_URL.'control/cadastros/questoes/edit_questao.php?q='.$quest['QUESTAO_CDG'] ?>'><?php echo $quest['DESCRITOR_CODIGO']; ?></a></td>
                        
                </tr>

             <?php } ?>
            </table>
           
    </td>    
 </div>
    <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
    </a>     
 
 
 </table> 
 </div>
</form>
 </body> 
 </html>

