 <?php        
	require ROOT.'control/login/verificar_autenticacao.php';   
        require ROOT.'model/usuario.php';
        require ROOT.'model/aluno.php';        
        $usuario = new Usuario(-1,$_SESSION['LOGIN']);
 ?>
 
<title>SELF</title> 
 </head> 
 <body  data-speed="10" class="bg-Parallax">      
 <div id="transparente-div-home"> 
 
 <!-- <title>SELF</title> 
 <body  data-speed="10" class="bg-Parallax">      
     <div id="corpo">
         <div id="moldura-transparente"><div>
-->
    <table class="table_header" width="100%"  height="60px" border="0" > <tr> 
        <td align="center" valign="top" class="fundo-claro"> 
            <span class="boas-vindas"><a href="<?php echo ROOT_URL ?>"> Ol&aacute; <?php echo $usuario->getNome(); ?> 
                 =)</a>
            </span>

            <span class="align-right" align="center" valign="top"> 
                <span class="align-right" align="right" style="padding-top:5px" >
                    <?php include ROOT.'view/inc/minhasturmas.php'; ?>
                </span>                 
            <br>
            <div id="menu">
                <ul>
                    <li><a href="#">Historico</a>		
                    <ul class="sub-menu">
			<li><a href="<?php echo ROOT_URL ?>view/historico/vlistar_datas.php">por Data</a></li>
			<li><a href="<?php echo ROOT_URL ?>view/historico/vlistar_atividades.php">por Atividade</a></li>			
			<li><a href="<?php echo ROOT_URL ?>view/historico/vlistar_alunos.php">por Aluno</a></li>
                    </ul>		
                    </li>		
		<li><a href="#">Ranking</a>
		
		<ul class="sub-menu">
			<li><a href="<?php echo ROOT_URL ?>view/historico/vranking_feminino.php">Feminino</a></li>
			<li><a href="<?php echo ROOT_URL ?>view/historico/vranking_masculino.php">Masculino</a></li>
                        <li><a href="<?php echo ROOT_URL ?>view/historico/vranking_reforco.php">Reforço</a></li>
                        <li><a href="<?php echo ROOT_URL ?>view/historico/vranking_prof.php">Geral</a></li>
		</ul>
		
		</li>
		
		<li><a href="<?php echo ROOT_URL ?>control/login/deslogar.php">Sair</a>				
		
		</li>
	</ul>
</div>

                
             <!-- |   &nbsp;<a href="<?php echo ROOT_URL ?>view/admin/vquestoes.php"> Questoes </a>&nbsp| -->
           
            </span>
        </td>
    </tr> </table>
 
 