 <?php        
        include ROOT.'model/admin/turma.php';                   
        require ROOT.'control/login/verificar_autenticacao.php';      
        require_once ROOT.'model/usuario.php';
        require_once ROOT.'model/aluno.php';        
        include(ROOT."view/vhead.php");
        $usuario = new Usuario(-1,$_SESSION['LOGIN']);
        $Turma = new Turma();
 ?>        
        
 </head> 
 
 <title>Self</title> 
 
 <body  data-speed="10" class="bg-Parallax">
 <div id="transparente-div-home" class="fontebase"> 
 


        <table class="table_header" width="100%"  height="60px" border="0" >
        <td align="center" valign="top" class=""> 
            <span class="boas-vindas"><a href="<?php echo ROOT_URL ?>"> Ol&aacute; <?php echo $usuario->getNome(); ?> 
                 =)</a>
            </span>

            <span class="align-right" align="center" valign="top"> 
                <span class="align-right" align="right" style="padding-top:5px" >
                    <?php include ROOT.'view/inc/todasturmas.php'; ?>
                </span>
                
                
            <br>
            <div id="menu">
                <ul>
                    <li><a href="#">Ferramentas</a>		
                        <ul class="sub-menu">
                            <!--<li><a href="<?php echo ROOT_URL ?>view/admin/vtools.php">Funções</a></li>-->
                            <li><a href="<?php echo ROOT_URL ?>view/admin/sessoes.php">Sessões</a></li>
                            <li><a href="<?php echo ROOT_URL ?>control/admin/importador.php">Importar</a></li>
                            <li><a href="<?php echo ROOT_URL ?>control/admin/bloqueio.php">Bloquear/Desbloquear Turmas</a></li>
                        </ul>		
                    </li>
                     <li><a href="#">Cadastros</a>		
                        <ul class="sub-menu">
                            <li><a href="<?php echo ROOT_URL ?>control/cadastros/turmas">Turmas</a></li>
                            <li><a href="<?php echo ROOT_URL ?>control/cadastros/usuarios">Usuários</a></li>
                            <li><a href="<?php echo ROOT_URL ?>control/cadastros/alunos/lista_alunos.php">Alunos</a></li>
                            <li><a href="<?php echo ROOT_URL ?>control/cadastros/atividades">Atividades</a></li>			                            
                            <li><a href="<?php echo ROOT_URL ?>control/cadastros/questoes">Questões</a></li>                            
                            <li><a href="<?php echo ROOT_URL ?>control/cadastros/descritores">Descritores</a></li>
                            
                        </ul>		
                    </li>
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
                            <li><a href="<?php echo ROOT_URL ?>view/historico/vranking_escola.php">Escola Toda</a></li>
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
 
 