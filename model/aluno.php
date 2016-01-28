<?php
include_once ROOT."model/db_classe.php";

class Aluno Extends Classe
{						      // conexao com o banco	
	public  $aluno_cdg;
        public  $aluno_senha;
        public  $aluno_serie;
	public  $aluno_pontuacao = 0;       // resposta correta sera sempre a opcao1	
        public  $aluno_nivel ; 
	
	
	public $ThrowExceptions = false;

	public function __construct($aluno_cdg = -1) {
            parent::__construct();            
            $aluno_cdg = (isset($aluno_cdg) &&($aluno_cdg > 0 ) ) ? $aluno_cdg : -1;
 	   
            $this->db->Query("SELECT * FROM ALUNO WHERE ALUNO_CDG = ".$aluno_cdg );		 		 
	    $this->db->MoveFirst();
            if($this->db->RowCount() > 0 ){
                $row =  $this->db->Row();
                $this->aluno_cdg = $row->ALUNO_CDG;
                $this->aluno_senhag = $row->ALUNO_SENHA ;
                $this->aluno_pontuacao = $row->ALUNO_PONTOS ;
                $this->aluno_serie = $row->ALUNO_SERIE ;    
                $this->aluno_nivel = $row->ALUNO_NIVEL ;    
                $this->aluno_atividadeconcluida = $row->ALUNO_ATIVIDADECONCLUIDA ;                       
            }else{
                $this->aluno_cdg = -1; 
            }
            
	}
	
	public function __destruct() {
		
	}
        
        public function getCDG($nome = null){
            // busca o cdg a partir do nome , ou retorna o cdg da instancia                        
            if(isset($nome)){               
                return $this->db->QuerySingleValue(
                    "SELECT ALUNO_CDG FROM ALUNO WHERE  UPPER(ALUNO_LOGIN) = '".strtoupper($nome)."'" );
                
            }else{
                return $this->aluno_cdg;
            }
        }
	
	 // retorna um arrays com os codigos das questoes da atividade passada por parametro
	public function getPontuacao() {
            $CDGS = array();
            $this->db->Query("SELECT ATIVQUESTAO_QUESTAO FROM ATIVIDADE_QUESTAO WHERE ATIVQUESTAO_ATIVIDADE = ".$atividade_cdg );		 		 
            $this->db->MoveFirst();		 
            while (!$this->db->EndOfSeek()) {
            	$row =  $this->db->Row();
		$CDGS[] = $row->ATIVQUESTAO_QUESTAO ;			
            }			 
            if (isset($CDGS))
                return $CDGS; 
	}
	
        //retorna true se a atividade passada por parametro ja foi completada
        public function atividade_completada($atividade_cdg){
            $this->db->Query("SELECT * FROM ALUNO_ATIVIDADE "
                                  ." WHERE ALUNOATIV_ALUNO_CDG =  ".$this->aluno_cdg
                                  ." AND ALUNOATIV_ATIVIDADE_CDG = ".$atividade_cdg
                                  ." AND ALUNOATIV_FINALIZADOS > 0 "
                                  );
            return  $this->db->RowCount() > 0 ?  true : false;                                                      
        }
        
         public function atividade_refazer($atividade_cdg){
            return $this->db->QuerySingleValue("SELECT ALUNOATIV_DATAREFAZER FROM ALUNO_ATIVIDADE "
                                  ." WHERE ALUNOATIV_ALUNO_CDG =  ".$this->aluno_cdg
                                  ." AND ALUNOATIV_ATIVIDADE_CDG = ".$atividade_cdg
                                  ." AND ALUNOATIV_FINALIZADOS > 0 "
                                  );            
        }
        
        
        public function logado_em_outro_local(){
            $resultado = false;
            
            $this->db->Query("SELECT ALUNO_ULTIMOLOCAL FROM ALUNO WHERE ALUNO_CDG = ".$this->aluno_cdg);
            if($this->db->RowCount() > 0 ):
                $row =  $this->db->Row();
                $resultado = ($row->ALUNO_ULTIMOLOCAL != gethostbyaddr($_SERVER['REMOTE_ADDR']));                                     
            endif;
            return $resultado;
        }
        
        
        
        public function passar_de_ano($aluno_cdg = -1,$nova_serie = -1){
            return $this->db->Query(' UPDATE ALUNO SET ALUNO_TURMAATUAL =  '.$nova_serie.' WHERE ALUNO_CDG = '.$aluno_cdg);
        }
	
	
	
}
?>