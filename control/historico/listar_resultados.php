<?php
include ROOT.'model/crono.php';



        
if(!isset($_SESSION['TURMA_ATUAL']) && ($turma == 0)){
    echo '<p class="centro branco titulo"> Selecione a turma primeiro. 
            <div>                 
            <br>
            <a href="javascript:history.go(-1);">
            <img class="botao_voltar" src="'.ROOT_URL.'view/img/voltar.png"/>
            </a>
            </div>      ';
    exit;
}


        

$historico = new Historico(($turma == 0 ?  $_SESSION['TURMA_ATUAL'] : $turma)); 

if($data == '0'){ 
    echo '<p class="centro branco titulo"> ► '.$historico->atividade_nome($atividade).' ►  ';
    echo $historico->listar_resultados($atividade);
    

    echo '<p class="centro branco titulo"> Quem tentou mas não conseguiu? ►  ';
    echo $historico->listar_resultados_ainda_esta_tentando($atividade);

    echo ' <br> <p class="centro branco titulo">Quem nunca fez essa atividade? </span> => ';
    echo $historico->listar_quem_nao_fez($atividade);
}else{
    //→ listar apenas atividades feitas na data escolhida
    echo '<p class="centro fundo-claro titulo texto-verde"> Atividade: ► '.$historico->atividade_nome($atividade).' ► '.$data.'</p>';
    echo '<p class="centro branco titulo"> Quem Finalizou:'; 
    
    echo $historico->listar_resultados_por_data($atividade,$data);

    echo '<br><p class="centro branco titulo"> Quem tentou mas não conseguiu? ►  ';
    echo $historico->listar_resultados_ainda_esta_tentando_por_data($atividade,$data);

    echo ' <br> <p class="centro branco titulo">Quem nunca fez essa atividade? </span> => ';
    echo $historico->listar_quem_nao_fez($atividade);    
}

    
    





