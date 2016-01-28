<?php
    require_once ROOT.'model/planejamento.php';

    //se for login duplo substituir nivel do aluno1 pelo aluno2 caso este seja superior
    if(isset($_SESSION['ALUNO_CDG2'])){
        $_SESSION['ALUNO_NIVEL'] = 
            ($_SESSION['ALUNO_NIVEL'] > $_SESSION['ALUNO_NIVEL2'] ? $_SESSION['ALUNO_NIVEL2'] : $_SESSION['ALUNO_NIVEL']);
    }
    
    if ($_SESSION['ALUNO_NIVEL'] == 1 ) {
        ?>
            <script>
                window.location = "<?php echo ROOT_URL ?>view/atividade/index.php?n=1";
            </script>
        <?php
    }else{        
        //nivel 1
        if ($_SESSION['ALUNO_NIVEL'] > 0 ) {                
            echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/index.php?n=1'> ";
            echo '<input type="button" value="Nivel 1" class="botao-atividade atividade-feita" />';        
            echo ' </a></div>';  
        }    
        //nivel 2
        if ($_SESSION['ALUNO_NIVEL'] > 1 ) {
            echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/index.php?n=2'> ";
            echo '<input type="button" value="Nivel 2" class="botao-atividade  atividade-feita" />';        
            echo ' </a></div>';  
        }
        
        //nivel 3
        if ($_SESSION['ALUNO_NIVEL'] > 2 ) {
            echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/index.php?n=3'> ";
            echo '<input type="button" value="Nivel 3" class="botao-atividade  atividade-feita" />';        
            echo ' </a></div>';  
        }
        
        //nivel 4
        if ($_SESSION['ALUNO_NIVEL'] > 3 ) {
            echo " <div class='atividade'><a href='".ROOT_URL."view/atividade/index.php?n=4'> ";
            echo '<input type="button" value="Nivel 4" class="botao-atividade  atividade-feita" />';        
            echo ' </a></div>';  
        }
    }
    