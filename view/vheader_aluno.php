<?php    
   require_once ROOT.'control/login/verificar_autenticacao_aluno.php';
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
    
        <div  id="<?php echo isset($_SESSION['ALUNO_CDG2']) ? 'cabecalho_maior' : 'cabecalho_menor'?>" class="fundo-claro" > 
            
            <div class="boas-vindas">
                <a href="<?php echo ROOT_URL ?>"> 
                    Ol&aacute; <?php echo $usuario; ?> =)
                </a>
                <?php
                if(isset($_SESSION['ALUNO_CDG2'])){
                    echo '<br><a href="'.ROOT_URL.'"> 
                    Ol&aacute; '.$_SESSION['LOGIN2'].' =)
                        </a>';
                }
                ?>
            </div>

            <span class="align-right"> 
                <span class="moeda"> <span class="texto-menu"><?php echo $aluno->aluno_pontuacao ?> </span>
                  <img  height="34" width="34" src="<?php echo ROOT_URL ?>view/img/moeda.png"/>
                </span>
                
               
                <div id="menu-rank">
                    <ul>                    
                        <li> <a href="#"><img   width="50px" src="<?php echo ROOT_URL ?>view/img/ranking_icone.png"></a>		
                            <ul class="sub-menu">
                                <li><a href="<?php echo ROOT_URL ?>view/historico/vranking_feminino_aluno.php">Feminino</a></li>
                                <li><a href="<?php echo ROOT_URL ?>view/historico/vranking_masculino_aluno.php">Masculino</a></li>
                                <li><a href="<?php echo ROOT_URL ?>view/historico/vranking_reforco_aluno.php">Reforço</a></li>
                                <li><a href="<?php echo ROOT_URL ?>view/historico/vranking_aluno.php">Geral</a></li>
                            </ul>		
                        </li>								
                    </ul>
                </div>
                <?php 
                echo '&nbsp;<a class="sair" href="'.ROOT_URL.'control/login/deslogar.php"> Sair </a>&nbsp';
                
                if(isset($_SESSION['ALUNO_CDG2'])){
                    echo '<br><br>';
                    echo '<span class="moeda"> <span class="texto-menu">'.$aluno2->aluno_pontuacao.'</span>';
                    echo '&nbsp;<img  height="34" width="34" src="'.ROOT_URL.'view/img/moeda.png"/>';
                    echo '</span>';
                }
                ?>
            </span>
        </div>