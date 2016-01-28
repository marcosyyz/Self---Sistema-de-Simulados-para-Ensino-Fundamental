<?php

include_once ROOT."model/db_classe.php";

class Importador extends Classe
{       
	
    
        public  $db_aux ;

	public function __construct() {
	     parent::__construct();             
             $this->db_aux = New MySQL();
	}
        
        private function ja_existe_RA($ra){

            $sql = ' SELECT COALESCE(TRIM(ALUNO_RA),0) AS ALUNO_RA 
                            FROM ALUNO 
                            WHERE TRIM(UPPER(REPLACE(REPLACE(REPLACE(ALUNO_RA," ",""),"-",""),".",""))) = 
                             "'. str_replace('-','',str_replace('.','', str_replace(' ','',strtoupper(trim(iconv("ISO-8859-1","UTF-8",$ra)))))).'" ';
            
            echo '<br>Verificando se Aluno já existe: '.$sql .'<br>';
            $this->db_aux->Query($sql);
            
            if($this->db_aux->Rowcount() > 0 ){                
                //$row =  $this->db_aux->Row();                
                return true;
            }else{
                return false;
            }
             
       }
        
        
        private function ja_existe($login){
            
              //comparando o nome
               $sql = ' SELECT COALESCE(TRIM(ALUNO_RA),0) AS ALUNO_RA FROM ALUNO WHERE TRIM(UPPER(ALUNO_NOME)) =             
                             "'.strtoupper(trim(iconv("ISO-8859-1","UTF-8",$login))).'" ';
             
         
          

            
            echo '<br>Verificando se Aluno já existe: '.$sql .'<br>';
            $this->db_aux->Query($sql);
            
            if($this->db_aux->Rowcount() > 0 ){                
                //$row =  $this->db_aux->Row();                
                return true;
            }else{
                return false;
            }
             
        }
	
        public function importar($arquivo,$delimitador,$turma = null,$tipo_update = 1){
            // Abre o Arquvio no Modo r (para leitura)
            $arquivo = fopen ($arquivo, 'r');
            $turma = (isset($turma) ? $turma : -1 );
           

            // Lê o conteúdo do arquivo
            $contador_linha  = 1;            
            $contador_updates = 0;
            $contador_inserts = 0;
            $contador_erros = 0;
            while(!feof($arquivo))
            {
                // Pega os dados da linha
                $linha = fgets($arquivo, 1024);

                // Divide as Informações das celular para poder salvar
                $dados = explode($delimitador, $linha);
                
               

                // Verifica se o Dados Não é o cabeçalho ou não esta em branco
                if((!empty($linha)  )  && ($contador_linha > 1 ))
                {
                    $dados[0] = str_replace('"','',$dados[0]);
                    $dados[1] = str_replace('"','',$dados[1]);
                    $dados[2] = str_replace('"','',$dados[2]);
                    $dados[3] = str_replace('"','',$dados[3]);
                    $dados[4] = str_replace('"','',$dados[4]);
                    $dados[5] = str_replace('"','',$dados[5]);
                
                    /*
                     * $dados[0] = RA
                     * $dados[1] = RGM
                     * $dados[2] = LOGIN
                     * $dados[3] = NOME
                     * $dados[4] = DATA
                     * $dados[5] = SEXO
                    */                    
                    if($dados[2] != ''){
                        
                        if($this->ja_existe_RA($dados[0])){
              
                            if((  strpos($dados[4],"-") > 0  )  || (strpos($dados[4],"/") > 0 )){
                              $date = new DateTime(str_replace ('/','-',$dados[4]));
                              $data_campo = ($date->format('Y-m-d'));
                            }else{
                              $data_campo = 0;
                            }

                            //mysql_query(
                            $sql =  ' UPDATE ALUNO SET ALUNO_RA = "'.$dados[0].'",
                                         ALUNO_RGM = "'.trim($dados[1]).'", ';
                            if(trim($dados[5]) != ''){// verificar para nao sobrescrever o sexo
                                $sql = $sql . ' ALUNO_SEXO = "'.trim($dados[5]).'",';
                            }
                            
                             if($turma != -1){
                                $sql = $sql .' ALUNO_TURMAATUAL = "'.$turma.'", ';
                            }
                            
                            $sql = $sql.' ALUNO_DTNASC = "'.$data_campo.'" 
                                            WHERE ALUNO_NOME = "'.iconv("ISO-8859-1","UTF-8",$dados[2]).'" ';
                            $resultado_atual = $this->db->Query($sql);
                              
                            //$this->db->Close();
                            if ($resultado_atual > 0){
                                $contador_updates++;
                                echo 'Atualizando Linha ['.$contador_linha.'] = '.$sql.' - ... <span class="verde">atualizado</span> ...<br><hr> ';    
                            }else{
                                $contador_erros++;  
                                echo 'Atualizando Linha ['.$contador_linha.'] = '.$sql.' - ... <span class="vermelho">NÃO ATUALIZOU</span> ...<br><hr> ';    
                            }
                            
                        }else{                                                       
                                    
                           if((  strpos($dados[4],"-") > 0  )  || (strpos($dados[4],"/") > 0 )){
                              $date = new DateTime(str_replace ('/','-',$dados[4]));
                              $data_campo = ($date->format('Y-m-d'));
                            }else{
                              $data_campo = 0;                              
                            }

                            //mysql_query(
                            $sql =  'INSERT INTO ALUNO (ALUNO_RA,ALUNO_RGM,ALUNO_LOGIN,ALUNO_NOME,
                                                          ALUNO_DTNASC, ALUNO_SEXO';
                            if($turma != -1){
                                $sql = $sql .',ALUNO_TURMAATUAL';
                            }
                            $sql = $sql.')  VALUES ("'.$dados[0].'","'.$dados[1].'", "'.$dados[2].'","'.$dados[2].'","'
                                                     .$data_campo.'", "'.trim($dados[5]).'" ';

                            if($turma != -1){
                                $sql = $sql .','.$turma;
                            }

                            $sql = $sql . ' )';

                            $this->db->Query(iconv("ISO-8859-1","UTF-8",$sql));
                            //$this->db->Close();
                            $contador_inserts++;
                            echo 'Inserindo Linha ['.$contador_linha.'] = '.$sql.' - ...<span class="azul"> inserido </span>...<br><hr> ';
                        }//ja existe                                                  
                    }// login nao sazio
                }//linha ao vazia
                $contador_linha++;
 }
 echo 'Registros inseridos: '.$contador_inserts;
 echo '<br>Registros atualizados: '.$contador_updates;
 echo '<br>Registros não inseridos: '.$contador_erros;

 // Fecha arquivo aberto
 fclose($arquivo);   
            
        }
        
}

