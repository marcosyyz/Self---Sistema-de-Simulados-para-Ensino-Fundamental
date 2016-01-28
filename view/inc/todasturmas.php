         Turmas: <?php                   
                    $todasturmas = $Turma->lista_turmas($_SESSION['ESCOLA']);
                                                                            
                    foreach ($todasturmas as $t) {
                             echo ' - <a href="'.ROOT_URL.'control/admin/setarturmaatual.php?t='
                                      .$t['id'].'&n='
                                      .$t['TURMA_NOME'].'&'
                                      .'" >'
                                      . ($t['id'] == (isset($_SESSION['TURMA_ATUAL']) ? $_SESSION['TURMA_ATUAL'] : -1) ? ' <span class="turma-atual">' : '' ) 
                                        .($t['TURMA_NOME'])
                                      .($t['id'] == (isset($_SESSION['TURMA_ATUAL']) ? $_SESSION['TURMA_ATUAL'] : -1) ? ' </span>' : '' ) 
                                      .'</a>';
                             echo '&nbsp;&nbsp;';
                        }                  
                        
                ?>


