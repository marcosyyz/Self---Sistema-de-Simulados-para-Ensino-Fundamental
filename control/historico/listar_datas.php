<?php


$historico = new Historico();

if(isset($_SESSION['TURMA_ATUAL'])) {
    
        $historico->setTurma($_SESSION['TURMA_ATUAL']);    
        echo "<p class='centro fundo-claro titulo texto-verde '> Histórico de Atividades - ".$_SESSION['TURMA_ATUAL_NOME']."</p>";

        $datas = $historico->listar_datas();
        if(empty($datas)):
            echo '<center> Não há atividades feitas</center>';
        endif;
            
        ///LOOP pelas datas
            foreach ($datas as $data){
            echo "<div class='centro branco titulo'>";
            echo "<a href='".ROOT_URL."view/historico/vlistar_por_data.php?d=".$data."' ><span class='centro branco titulo '> ".$data." - ".$semana[date('l',  strtotime($data))];    
            echo "</span></a><br>";
            echo "</div>";
            //echo $historico->listar_atividades_por_data($_SESSION['MINHAS_TURMAS_CDG'][$i], $data);
            //echo "<br><br><br>";
        }            
    
}else{
    //looping pelas turmas do prof
    for ($i = 0; $i < count($_SESSION['MINHAS_TURMAS_CDG']); $i++) {
        $historico->setTurma($_SESSION['MINHAS_TURMAS_CDG'][$i]);    
        echo "<p class='centro fundo-claro titulo texto-verde '> Histórico de Atividades - ".$_SESSION['MINHAS_TURMAS_NOME'][$i]."</p>";

        $datas = $historico->listar_datas();
        ///LOOP pelas datas
        foreach ($datas as $data){
            echo "<div class='centro branco titulo'>";
            echo "<a href='".ROOT_URL."view/historico/vlistar_por_data.php?d=".$data."' ><span class='centro branco titulo '> ".$data." - ".$semana[date('l',  strtotime($data))];    
            echo "</span></a><br>";
            echo "</div>";
            //echo $historico->listar_atividades_por_data($_SESSION['MINHAS_TURMAS_CDG'][$i], $data);
            //echo "<br><br><br>";
        }        
    }
}
