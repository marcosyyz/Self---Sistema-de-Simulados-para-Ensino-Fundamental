         Turmas: <?php                   
                    if(isset($_SESSION['MINHAS_TURMAS_NOME'])){
                        for($i = 0; $i < count($_SESSION['MINHAS_TURMAS_CDG']); $i++) {
                             echo ' - <a href="'.ROOT_URL.'control/admin/setarturmaatual.php?t='
                                      .$_SESSION['MINHAS_TURMAS_CDG'][$i].'&n='
                                      .$_SESSION['MINHAS_TURMAS_NOME'][$i].'&'
                                      .'" >'
                                      . ($_SESSION['MINHAS_TURMAS_CDG'][$i] == (isset($_SESSION['TURMA_ATUAL']) ? $_SESSION['TURMA_ATUAL'] : -1) ? ' <span class="turma-atual">' : '' ) 
                                        .($_SESSION['MINHAS_TURMAS_NOME'][$i])
                                      .($_SESSION['MINHAS_TURMAS_CDG'][$i] == (isset($_SESSION['TURMA_ATUAL']) ? $_SESSION['TURMA_ATUAL'] : -1) ? ' </span>' : '' ) 
                                      .'</a>';
                             echo '&nbsp;&nbsp;';
                        }
                    }else{
                        echo 'Você não tem turmas.';
                    }
                        
                ?>
