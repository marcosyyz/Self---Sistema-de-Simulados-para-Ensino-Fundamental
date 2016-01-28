<?php               
        require ROOT.'model/usuario.php';
        require ROOT.'model/aluno.php';        
        
 ?>
 
<title>SELF</title> 
 </head> 
 <body  data-speed="10" class="bg-Parallax">      
 <div id="transparente-div-home"> 
 
     
     
       <table class="table_header" width="100%"  height="60px" border="0" > <tr> 
        <td align="center" valign="top" class="fundo-claro"> 
            <span class="boas-vindas"><a href="<?php echo ROOT_URL.'/anonimo'; ?>"> Ol&aacute! 
                 </a>
            </span>

            <span class="align-right" align="center" valign="top"> 
                Modo: Anônimo                                
            <br>
            <div id="menu">                
		</li>		
		<li><a href="<?php echo ROOT_URL ?>control/login/deslogar.php">Sair</a>						
		</li>	
            </div>

                
             <!-- |   &nbsp;<a href="<?php echo ROOT_URL ?>view/admin/vquestoes.php"> Questoes </a>&nbsp| -->
           
            </span>
        </td>
    </tr> </table>
 
 