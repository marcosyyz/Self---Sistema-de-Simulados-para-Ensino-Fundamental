<?php
include_once('../../config.php');
include_once(ROOT.'model/mysql.php');

$db = New MySQL();


function escola_cdg($db,$nome){
    
    $cdg = $db->QuerySingleValue('SELECT ESCOLA_CDG FROM ESCOLA WHERE UPPER(ESCOLA_NOME) = "'.strtoupper($nome).'"');
    if($cdg > 0){
        //echo 'SELECT ESCOLA_CDG FROM ESCOLA WHERE UPPER(ESCOLA_NOME) = "'.strtoupper($nome).'"<br>';
        return $cdg;
    }else{
        return -1;
    }
}

 function importar($db,$arquivo,$delimitador,$turma = null){
    // Abre o Arquvio no Modo r (para leitura)
    $arquivo = fopen ($arquivo, 'r');
    $turma = (isset($turma) ? $turma : -1 );


    // Lê o conteúdo do arquivo
    $contador_linha  = 1;            
    $contador_registro = 0;
    while(!feof($arquivo))
    {
        // Pega os dados da linha
        $linha = fgets($arquivo, 1024);

        // Divide as Informações das celular para poder salvar
        $dados = explode($delimitador, $linha);

        // Verifica se o Dados Não é o cabeçalho ou não esta em branco
        if((!empty($linha)  )  && ($contador_linha > 1 ))
        {
            /*
             * $dados[0] = escola
             * $dados[1] = serie
             * $dados[2] = oi

            */                    
            $ultimo_char = strlen(trim($dados[1]));
            $ultimo_char = $ultimo_char-1;

            $serie = substr(trim($dados[1]), 0 , 1);
            $letra = substr(trim($dados[1]), $ultimo_char , 1);
            $ano = '2016';
            $escola = escola_cdg($db,$dados[0]);
            
            

            if(($escola > 0 ) && ($serie != '') 
                    && ($letra != '') && (strlen(trim($letra)) == 1))
                {
                   // echo "'".$serie ."' , '".            $letra ."' , '".            $ano ."' , '".            $escola."'<br>";
                
                    $cdg_ja_existe = $db->QuerySingleValue(' SELECT TURMA_CDG FROM TURMA WHERE 
                                        TURMA_LETRA = "'.$letra.'" 
                                        AND TURMA_SERIE = "'.$serie.'" 
                                        AND  TURMA_ANO = '.$ano.'
                                        AND TURMA_ESCOLA = '.$escola );
                
                if(!$cdg_ja_existe){


                    
                    $sql =  'INSERT INTO TURMA (TURMA_SERIE, TURMA_LETRA,TURMA_ANO,TURMA_PROF,'
                            . 'TURMA_ATIVO,TURMA_ESCOLA)';

                    $sql = $sql.'  VALUES ('.$serie.', "'.$letra.'",'.$ano.',null,
                                1,'.$escola.') ';


                    $db->Query($sql);
                    //$this->db->Close();
                    $contador_registro++;                     
                    echo 'Inserindo Linha ['.$contador_linha.'] = '.$sql.' - ... inserido ...<br><hr> ';                           

                }//ja existe                                                  
            }// login nao sazio
        }//linha ao vazia
        $contador_linha++;
    }
    echo 'Total de registros inseridos: '.$contador_registro;

    // Fecha arquivo aberto
    fclose($arquivo);   
}



importar($db,'c:\turmas.csv', ';', null );

