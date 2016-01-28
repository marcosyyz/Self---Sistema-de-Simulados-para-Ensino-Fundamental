<?php
include_once ROOT."model/db_classe.php";



 class _Questao{
    public $cdg;
    public $tipo;
        
    function __construct($cdg, $tipo) {        
        $this->cdg = $cdg;
        $this->tipo = $tipo;           
    }                       
}


class Atividade extends Classe
{
	//  private $db;      // conexao com o banco
	
	public  $atividade_cdg;
        public  $atividade_nivelfinal;
        public  $verifica_acentuacao;
        
        
	public  $resposta_Correta = "";    // resposta correta sera sempre a opcao1	
	public  $questao_Fields ; 	  //array com os campos da tabela QUESTAO        
	public  $lista_questoes  = array();     
        
        public  $turma_atual;
        public  $pontos_adicionados = 0 ;
        public  $total_finalizados = 0; 
        
        public  $resposta_lacuna1 = "";
        public  $resposta_lacuna2 = "";
        public  $resposta_lacuna3 = "";
        public  $resposta_lacuna4 = "";
        public  $resposta_lacuna5 = "";
        public  $resposta_lacuna6 = "";
	
	
	public $ThrowExceptions = false;

        
	public function __construct($atividade_cdg,$turmaatual) {
            parent::__construct();
             
             
	     
            if($atividade_cdg != -1){
                 
                //carregar informações da atividades
                $this->db->Query(" SELECT ATIVIDADE_VERIFICAACENTO FROM ATIVIDADE "
                                  ." WHERE ATIVIDADE_CDG = ".$atividade_cdg );
                $this->db->MoveFirst();
                while (!$this->db->EndOfSeek()) {
                   $row =  $this->db->Row();
                   $this->verifica_acentuacao = $row->ATIVIDADE_VERIFICAACENTO ;			                
                }			       
                 
                 
                 // atribui os questao_cdg ao array
                $this->carregar_cdg_Questoes($atividade_cdg);
                // adiciona os questaodigitar_cdg ao array  somando com os questao_cdg ja adicionados
                $this->carregar_cdg_QuestoesDigitar($atividade_cdg);
             }                            
	     $this->atividade_cdg = $atividade_cdg;
             $this->turma_atual = $turmaatual;
                      
                         
	}
	
	public function __destruct() {
		
	}

        public function iniciar_sessoes(){
            $_SESSION['ACERTOS'] = 0;	
            $_SESSION['ERROS']= 0;	
            $_SESSION['QTD_QUESTOES']= $this->total_Questoes();	
            $_SESSION['ATIVIDADE_ATUAL']= $this->atividade_cdg;	
            $_SESSION['CDG_QUESTOES_ACERTADAS'] = null;
            $_SESSION['ACERTOU_ANTERIOR'] = 0 ;
            $_SESSION['VERIFICA_ACENTUACAO'] = $this->verifica_acentuacao;
        }
        
        public function finalizar_sessoes() {
            unset($_SESSION['ACERTOS']);	
            unset($_SESSION['ERROS']);	
            unset($_SESSION['QTD_QUESTOES']);
            unset($_SESSION['ATIVIDADE_ATUAL']);	
            unset($_SESSION['CDG_QUESTOES_ACERTADAS']);
            unset($_SESSION['ACERTOU_ANTERIOR']);
        }

	 // retorna um arrays com os codigos das questoes da atividade passada por parametro
	public function carregar_cdg_Questoes($atividade_cdg) {
	     $CDGS = array();
             $TIPOS[] = array();
	     $this->db->Query("SELECT ATIVQUESTAO_QUESTAO FROM ATIVIDADE_QUESTAO WHERE ATIVQUESTAO_ATIVIDADE = ".$atividade_cdg );
	     $this->db->MoveFirst();		 
	     while (!$this->db->EndOfSeek()) {
		$row =  $this->db->Row();
		$CDGS[] = $row->ATIVQUESTAO_QUESTAO ;			
                $TIPOS[] = TIPO_SIMULADO ;			
	     }			 
	     if (isset($CDGS)){
                 //preencher o array lista_questoes com cdg e tipo da questao
                $i = 0; 
                while($i < count($CDGS)){                    
                    $this->lista_questoes[] = new _Questao($CDGS[$i],TIPO_SIMULADO);
                    $i += 1;
                }                                 	               
             }
	}
        
        
        
        	 // retorna um arrays com os codigos das questoes da atividade passada por parametro
	public function carregar_cdg_QuestoesDigitar($atividade_cdg) {
	     $CDGS = array();
             $TIPOS[] = array();            
             $this->db->Query("SELECT ATIVQUESTAODIGITAR_QUESTAO FROM ATIVIDADE_QUESTAODIGITAR WHERE ATIVQUESTAODIGITAR_ATIVIDADE = ".$atividade_cdg );
	     //$this->db->Query("SELECT *                          FROM ATIVIDADE_QUESTAODIGITAR WHERE ATIVQUESTAODIGITAR_ATIVIDADE = ".$atividade_cdg );
	     $this->db->MoveFirst();		 
	     while (!$this->db->EndOfSeek()) {
		$row =  $this->db->Row();
		$CDGS[] = $row->ATIVQUESTAODIGITAR_QUESTAO ;			
                $TIPOS[] = TIPO_DIGITAR;			
	     }			 
	     if (isset($CDGS)){
		      //preencher o array lista_questoes com cdg e tipo da questao
                $i = 0; 
                while($i < count($CDGS)){                    
                    $this->lista_questoes[] = new _Questao($CDGS[$i],TIPO_DIGITAR);
                    $i += 1;
                }       
             }                          
	}
        
        
        
	
	//retorna um array com os campos do registro da tabela questao retornado
	public function carregar_Questao($questao_cdg, $tipo_questao) {            
            if($tipo_questao == TIPO_SIMULADO){
                $this->carregar_Questao_simulado($questao_cdg);
            }else{
                if($tipo_questao == TIPO_DIGITAR){
                   $this->carregar_Questao_digitar($questao_cdg);
                }                                 
            }
	}
        
        public function carregar_Questao_digitar($questao_cdg) {         
                    
            $this->db->Query("SELECT QUESTAODIGITAR_PERGUNTA,QUESTAODIGITAR_IMAGEM,
                                    QUESTAODIGITAR_IMAGEM_POS, QUESTAODIGITAR_TEXTO,
                                    QUESTAODIGITAR_LACUNA1, QUESTAODIGITAR_LACUNA2, 		
                                    QUESTAODIGITAR_LACUNA3, QUESTAODIGITAR_LACUNA4,
                                    QUESTAODIGITAR_LACUNA5
				FROM QUESTAO_DIGITAR 					
				WHERE QUESTAODIGITAR_CDG = ".$questao_cdg);
            $this->questao_Fields =  $this->db->RowArray(0, MYSQL_ASSOC);		 
            $this->resposta_lacuna1 =  $this->questao_Fields['QUESTAODIGITAR_LACUNA1'];
            $this->resposta_lacuna2 =  $this->questao_Fields['QUESTAODIGITAR_LACUNA2'];
            $this->resposta_lacuna3 =  $this->questao_Fields['QUESTAODIGITAR_LACUNA3'];
            $this->resposta_lacuna4 =  $this->questao_Fields['QUESTAODIGITAR_LACUNA4'];
            $this->resposta_lacuna5 =  $this->questao_Fields['QUESTAODIGITAR_LACUNA5'];            
        }
        
        public function carregar_Questao_simulado($questao_cdg) {
            $this->db->Query("SELECT QUESTAO_PERGUNTA,QUESTAO_IMAGEM, QUESTAO_IMAGEM_POS,
                                                        QUESTAO_TEXTO,QUESTAO_SOM,
							QUESTAO_OPCAO1, QUESTAO_OPCAO2, 		
							QUESTAO_OPCAO3, QUESTAO_OPCAO4,
							QUESTAO_OPCAO5, USUARIO_NOME,
							QUESTAO_DTCRIACAO, QUESTAO_DTMOD,
							MATERIA_NOME,  QUESTAO_ASSUNTO							
					FROM QUESTAO 
					LEFT JOIN USUARIO ON USUARIO_CDG = QUESTAO_CRIADOR
					LEFT JOIN MATERIA ON MATERIA_CDG = QUESTAO_MATERIA
					WHERE QUESTAO_CDG = ".$questao_cdg);
            $this->questao_Fields =  $this->db->RowArray(0, MYSQL_ASSOC);		 
            $this->resposta_correta =  $this->questao_Fields['QUESTAO_OPCAO1'];
        }
	
	// retorna as respostas em sequencia aleatorias em um array 
	public function respostas_Aleatorias() {	
            $resp[] = $this->questao_Fields['QUESTAO_OPCAO1'];
            $resp[] = $this->questao_Fields['QUESTAO_OPCAO2'];
            $resp[] = $this->questao_Fields['QUESTAO_OPCAO3'];
            if (isset($this->questao_Fields['QUESTAO_OPCAO4']))                
           	$resp[] = $this->questao_Fields['QUESTAO_OPCAO4'];            
            if (isset($this->questao_Fields['QUESTAO_OPCAO5']))                
           	$resp[] = $this->questao_Fields['QUESTAO_OPCAO5'];
            shuffle($resp);
            return $resp;
	}
        
        public function converter_Lacunas($texto){
            $tamanho  = strlen(utf8_decode( $this->resposta_lacuna1));            
            $tamanho =  $tamanho * 28;
            
            $texto = str_replace('[lacuna1]', "<input class='' name='resposta1' type='text' autocomplete='off'  id='resposta1' "
                    . "   style='width: ".$tamanho."px;'></input>", $texto);
            
            $tamanho  = strlen(utf8_decode( $this->resposta_lacuna2));
            $tamanho =  $tamanho * 28;
            
            $texto = str_replace('[lacuna2]', "<input class='' name='resposta2' type='text' autocomplete='off'  id='resposta2' "
                    . "   style='width: ".$tamanho."px;'></input>", $texto);            
            
            $tamanho  = strlen(utf8_decode( $this->resposta_lacuna3));
            $tamanho =  $tamanho * 28;
            
            $texto = str_replace('[lacuna3]', "<input class='' name='resposta3' type='text' autocomplete='off'  id='resposta3' "
                    . "   style='width: ".$tamanho."px;'></input>", $texto);            
            
            $tamanho  = strlen(utf8_decode( $this->resposta_lacuna4));
            $tamanho =  $tamanho * 28;
            
            $texto = str_replace('[lacuna4]', "<input class='' name='resposta4' type='text' autocomplete='off'  id='resposta4' "
                    . "   style='width: ".$tamanho."px;'></input>", $texto);                                    
            
            $tamanho  = strlen(utf8_decode( $this->resposta_lacuna5));
            $tamanho =  $tamanho * 28;
            
            $texto = str_replace('[lacuna5]', "<input class='' name='resposta5' type='text' autocomplete='off'  id='resposta5' "
                    . "   style='width: ".$tamanho."px;'></input>", $texto);            
            
            return $texto;
        }
	
	// retorna true se a opcao passada for a resposta correta da questao atual carregada na classe
	public function certa_Resposta($opcao){	   
	   if ($opcao == $this->resposta_correta) 
		 return true;		 
	   else
	     return false;
	}
	
	public function certa_RespostaToInt($Popcao){			
		if($this->certa_Resposta($Popcao) )
			return 1;
		else
			return 0;
	}
	
        //retorna toral de questoes da atividade selecionada
	public function total_Questoes() {
                 //total de questao tipo simulado
		 $this->db->Query(" SELECT COUNT(*) AS CONTADOR FROM ATIVIDADE_QUESTAO WHERE ATIVQUESTAO_ATIVIDADE = ".$this->atividade_cdg );		 		 
		 $this->db->MoveFirst();		
		 $row =  $this->db->Row();
		 $contador = $row->CONTADOR ;					
			
                 
                 //total de questao tipo digitar
		 $this->db->Query(" SELECT COUNT(*) AS CONTADOR FROM ATIVIDADE_QUESTAODIGITAR WHERE ATIVQUESTAODIGITAR_ATIVIDADE = ".$this->atividade_cdg );
		 $this->db->MoveFirst();		
		 $row =  $this->db->Row();
		 $contador += $row->CONTADOR ;					
		 if (isset($contador))
			return $contador;
		 else
            return 0;
	}
        
        //retorna a posicao da imagem configurada para a questao carregada atualmente
        public function css_posicao_imagem($nome_do_campo){
           if($this->questao_Fields[$nome_do_campo] == 0)
               return "posicao_central";
           elseif($this->questao_Fields[$nome_do_campo] == 1)
               return "posicao_left";
           elseif($this->questao_Fields[$nome_do_campo] == 2)
               return "posicao_right";
               
        }
        
        
        public function calcular_e_pontuar($aluno_cdg, $acertos, $erros ){
            $nfinalizado = $this->db->QuerySingleValue(' SELECT COALESCE(SUM(ALUNOATIV_FINALIZADOS), 0 )
                                            FROM ALUNO_ATIVIDADE WHERE ALUNOATIV_ALUNO_CDG = '.$aluno_cdg.'
                                            AND ALUNOATIV_ATIVIDADE_CDG = '.$this->atividade_cdg);
            if($nfinalizado  == 1 ): //se finalizou pela segunda vez pontuacao divide por 2
                $acertos  = floor( $acertos  /  2); //remove o resto da divisao
            endif;
            
            if($nfinalizado  >= 2 ) {// se finalizou pela terceira vez ou mais 
                $acertos  = 2; 
                if($erros>0){ // pontuacao é 2 se nao teve erros 
                    $acertos = 1; // se nao, é pontuacao 1
                    $erros = 0;
                }    
                
                if($nfinalizado  > 5 ){//se finalizou pela sexta vez ou mais 
                    $acertos = 1; // ganha um ponto se nao acertou todas
                    $erros = 0;// se nao ganha zero
                    if ($erros > 0) 
                        $erros = 1;
                }
            }
            
            $this->total_finalizados = $nfinalizado;
            if($nfinalizado  <= 10 ){//se ja finalizou 10 vezes nao ganha mais pontos
                $this->pontuar_aluno($aluno_cdg, $acertos - $erros );
                $this->pontos_adicionados = $acertos - $erros;                      
            }else{
                $this->pontos_adicionados = 0;                
            }
            
                
        }
        
        //grava atividade finalizada e suas notas no banco
        public function finalizar($aluno_cdg,$acertos,$erros,$totalquestoes,$tempo,$ganhou = 1){           
            $retorno = -1;
            //setar campos 'Finalizados' e 'Tentativas' para insert
             //e gravar nova pontuacao se ganhou
            if($ganhou == 1){
                $insert_values["ALUNOATIV_FINALIZADOS"] =  1;
                $insert_values["ALUNOATIV_TENTATIVAS"] =  0;
                //gravar nova pontuacao
                $this->calcular_e_pontuar($aluno_cdg, $acertos, $erros );
            }else{
                $insert_values["ALUNOATIV_FINALIZADOS"] =  0;
                $insert_values["ALUNOATIV_TENTATIVAS"] =  1;
            }
            
            
            // valores a serem inseridos
           $insert_values["ALUNOATIV_ALUNO_CDG"]  = MySQL::SQLValue($aluno_cdg, MySQL::SQLVALUE_NUMBER);
           $insert_values["ALUNOATIV_ATIVIDADE_CDG"]  = $this->atividade_cdg;
           $insert_values["ALUNOATIV_ACERTOS"] = MySQL::SQLValue($acertos, MySQL::SQLVALUE_NUMBER);
           $insert_values["ALUNOATIV_ERROS"]  = MySQL::SQLValue($erros, MySQL::SQLVALUE_NUMBER);
           $insert_values["ALUNOATIV_TOTALQUESTOES"]  = MySQL::SQLValue($totalquestoes, MySQL::SQLVALUE_NUMBER);
           $insert_values["ALUNOATIV_TURMA"]  = $this->turma_atual;           
           $insert_values["ALUNOATIV_TEMPO"]  = $tempo;
           
           
           
           /******************** passar de nivel ***********************/
           if($ganhou == 1){
               $this->db->Query('SELECT ATIVIDADE_NIVEL
                                   FROM ATIVIDADE WHERE ATIVIDADE_CDG = '.$this->atividade_cdg.'
                                   AND ATIVIDADE_NIVELFINAL = 1 ');
               $this->db->MoveFirst();	
               // se é a ultima atividade do nivel ?               
               if($this->db->RowCount() > 0){
                    $row = $this->db->Row(); 
                    $this->atividade_nivel = $row->ATIVIDADE_NIVEL ;                
                    $this->db->Close();
                    //atualiza apenas se nivel do aluno é o mesmo que o da atividade atual
                    $this->db->Query(' UPDATE ALUNO SET ALUNO_NIVEL = '.($this->atividade_nivel+1)
                                    .'   WHERE ALUNO_CDG = '.$aluno_cdg
                                    .'   AND ALUNO_NIVEL = '.$this->atividade_nivel );
                    // se nivel do aluno é o mesmo que o da atividade atual
                    // subir nivel na session
					
                    if($_SESSION['ALUNO_NIVEL'] == $this->atividade_nivel){                        
                        $_SESSION['ATUALIZAR_NIVEL'] = 1;
                    }
               }
           }
           /**********************************************************************/
           
           
                 
           
           
                        
        
                                        
            //consultar se ja tentou fazer essa atividade hoje
            $this->db->Query(" SELECT ALUNOATIV_ERROS, ALUNOATIV_ACERTOS    "
                            ." FROM ALUNO_ATIVIDADE  "
                            ."   WHERE ALUNOATIV_ATIVIDADE_CDG = ".$this->atividade_cdg
                            ."   AND ALUNOATIV_ALUNO_CDG = ".$aluno_cdg
                            ."   AND DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y') = DATE_FORMAT(NOW() ,'%d/%m/%Y') ");
            $this->db->MoveFirst();		
                                                      
            
            // se  ja completou hj
            if($this->db->RowCount() > 0){                                               
                $row = $this->db->Row();
                // Se errou menos que antes
                // ou acertou mais que antes
                if (($row->ALUNOATIV_ERROS >   $erros) || 
                    ($row->ALUNOATIV_ACERTOS < $acertos)){
                    //atualiza  e incrementa alunoativ_finalizados                    
                    $this->atualizar_atividade_feita($aluno_cdg, 
                                                 $acertos, 
                                                 $erros, 
                                                 $totalquestoes,
                                                 $tempo  
                                                 );
                }    
                               
                
                //incrementa finalizado ou tentativa                
                if($ganhou == 1){                    
                    return $this->incrementar_finalizados($aluno_cdg);}
                else{                    
                    return $this->incrementar_tentativas($aluno_cdg);                   
                }
                
                
                $retorno = 1;
                                    
            }else{
                // se nao, executa insert                                 
                $retorno = $this->db->InsertRow("ALUNO_ATIVIDADE", $insert_values);
            }
            
             
             //incrementar tempo total do dia de hoje (now)
             $this->incrementar_tempo($aluno_cdg, $tempo);
             return  $retorno;
        }
        
        
        
        
        
         public function atualizar_atividade_feita($aluno_cdg,$acertos,$erros,$totalquestoes,$tempo){
            
            $sql = ('UPDATE ALUNO_ATIVIDADE SET 
                                       ALUNOATIV_ACERTOS = '.$acertos.'
                                      , ALUNOATIV_ERROS = '.$erros.'
                                      , ALUNOATIV_TOTALQUESTOES = '.$totalquestoes);
            
            if($tempo > 0 ){ 
                $sql .=  ', ALUNOATIV_TEMPO  = '.$tempo;                
            }
            
                $sql .=  '         WHERE ALUNOATIV_ALUNO_CDG = '.$aluno_cdg.'
                                        AND ALUNOATIV_ATIVIDADE_CDG = '.$this->atividade_cdg.'
                                        AND DATE_FORMAT(ALUNOATIV_DATA ,"%d/%m/%Y") = DATE_FORMAT(CURRENT_DATE ,"%d/%m/%Y")    
                                    ';
                        
            
            
             
            return $this->db->Query($sql);            
            
         }
		 
		 
          public function pontuar_aluno($aluno_cdg,$pontos){              
              $this->db->Query(" UPDATE ALUNO "
                                    . " SET ALUNO_PONTOS = ALUNO_PONTOS + ".$pontos  
                                    . " WHERE ALUNO_CDG = ".$aluno_cdg );
                                                                
              }
         
         
         public function incrementar_finalizados($aluno_cdg){
             //$values["ALUNOATIV_TENTATIVAS"]= $this->tentativas_feitas($aluno_cdg);
             //$where["ALUNOATIV_ALUNO_CDG"]  = MySQL::SQLValue($aluno_cdg, MySQL::SQLVALUE_NUMBER);
             //$where["ALUNOATIV_ATIVIDADE_CDG"]  = $this->atividade_cdg;
             //return $this->db->UpdateRows("ALUNO_ATIVIDADE", $values, $where);                 
             return $this->db->Query("UPDATE ALUNO_ATIVIDADE "
                                    . "SET ALUNOATIV_FINALIZADOS = ALUNOATIV_FINALIZADOS + 1, "
                                    . " ALUNOATIV_DATA = NOW() "
                                    . " WHERE ALUNOATIV_ALUNO_CDG = ".$aluno_cdg
                                    . "  AND ALUNOATIV_ATIVIDADE_CDG = ".$this->atividade_cdg 
                                    . "  AND DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y') = DATE_FORMAT(NOW() ,'%d/%m/%Y') " );
             
             
          }
         
         public function incrementar_tentativas($aluno_cdg){
             //$values["ALUNOATIV_TENTATIVAS"]= $this->tentativas_feitas($aluno_cdg);
             //$where["ALUNOATIV_ALUNO_CDG"]  = MySQL::SQLValue($aluno_cdg, MySQL::SQLVALUE_NUMBER);
             //$where["ALUNOATIV_ATIVIDADE_CDG"]  = $this->atividade_cdg;
             //return $this->db->UpdateRows("ALUNO_ATIVIDADE", $values, $where);  
             
             return $this->db->Query("UPDATE ALUNO_ATIVIDADE SET ALUNOATIV_TENTATIVAS = ALUNOATIV_TENTATIVAS + 1, "
                                    . " ALUNOATIV_DATA = NOW() "
                                    . " WHERE ALUNOATIV_ALUNO_CDG = ".$aluno_cdg
                                    . " AND ALUNOATIV_ATIVIDADE_CDG = ".$this->atividade_cdg 
                                    . " AND DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y') = DATE_FORMAT(NOW() ,'%d/%m/%Y') ");
             
             
          }
          
           public function incrementar_tempo($aluno_cdg,$tempo){               
               return $this->db->Query(" UPDATE ALUNO_ATIVIDADE SET 
                                        ALUNOATIV_TEMPOTOTAL  =  ALUNOATIV_TEMPOTOTAL + ".$tempo."
                                        WHERE ALUNOATIV_ALUNO_CDG = ".$aluno_cdg."
                                        AND ALUNOATIV_ATIVIDADE_CDG = ".$this->atividade_cdg." 
                                        AND DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y') = DATE_FORMAT(NOW() ,'%d/%m/%Y') ");
           }
          
          
          

          
          
        

	
	
}
?>