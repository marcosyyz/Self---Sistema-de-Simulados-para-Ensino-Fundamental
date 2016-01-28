<?php
include_once ROOT."model/db_classe.php";

class Materia extends Classe
{       
	
	public  $materia_cdg;			
        public  $campo;        	

	public function __construct() {
	     parent::__construct();             
	}
	
        
	public function __destruct() {
		
	}


	
	public function carregar_materias() {	     
	     $this->db->Query("SELECT * FROM MATERIA ");              
	     return $this->db;
	}
	
	
	
	 // retorna um arrays com os codigos das questoes da atividade passada por parametro
	public function listar_Materias() {
	     $nomes = array();
	     $this->db->Query("SELECT * FROM MATERIA " );		 		 
	     $this->db->MoveFirst();		 
	     while (!$this->db->EndOfSeek()) {
		$row =  $this->db->Row();
		$nomes[] = $row->MATERIA_NOME ;
	     }			 
	     if (isset($nomes))
		return $nomes; 
	}
	
        
        //grava atividade finalizada e suas notas no banco
        public function finalizar($aluno_cdg,$acertos,$erros,$totalquestoes,$ganhou = 1){
           
            if($ganhou == 1){
                $insert_values["ALUNOATIV_FINALIZADOS"] =  1;
                $insert_values["ALUNOATIV_TENTATIVAS"] =  0;
                //gravar nova pontuacao
                $this->pontuar_aluno($aluno_cdg, $acertos - $erros );		   
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
           
            
            $this->db->Close();                                 
            //consultar se ja completou 
            $this->db->Query(" SELECT ALUNOATIV_ERROS, ALUNOATIV_ACERTOS    "
                            ." FROM ALUNO_ATIVIDADE  "
                            ."   WHERE ALUNOATIV_ATIVIDADE_CDG = ".$this->atividade_cdg
                            ."   AND ALUNOATIV_ALUNO_CDG = ".$aluno_cdg);
            $this->db->MoveFirst();		
                                                      
            
            // se  ja completou 
            if($this->db->RowCount() > 0){               
                // Se errou menos que antes
                $row = $this->db->Row();
                if (($row->ALUNOATIV_ERROS >   $erros) || 
                    ($row->ALUNOATIV_ACERTOS < $acertos)){
                    //atualiza   e incrementa alunoativ_finalizados
                    $this->atualizar_atividade_feita($aluno_cdg, 
                                                 $acertos, 
                                                 $erros, 
                                                 $totalquestoes                                                 
                                                 );
                }    
                
                //incrementa finalizado ou tentativa
                if($ganhou == 1){
                    return $this->incrementar_finalizados($aluno_cdg);}
                else{
                    return $this->incrementar_tentativas($aluno_cdg);}
                    
                
            }else{
                // se nao, executa insert  
               // echo 'aqqqq';
                return $this->db->InsertRow("ALUNO_ATIVIDADE", $insert_values);
            }
           		
        }
        
         public function atualizar_atividade_feita($aluno_cdg,$acertos,$erros,$totalquestoes){
                         
            $values["ALUNOATIV_ACERTOS"] = MySQL::SQLValue($acertos, MySQL::SQLVALUE_NUMBER);
            $values["ALUNOATIV_ERROS"]  = MySQL::SQLValue($erros, MySQL::SQLVALUE_NUMBER);
            $values["ALUNOATIV_TOTALQUESTOES"]  = MySQL::SQLValue($totalquestoes, MySQL::SQLVALUE_NUMBER);            
            
            $where["ALUNOATIV_ALUNO_CDG"]  = MySQL::SQLValue($aluno_cdg, MySQL::SQLVALUE_NUMBER);
            $where["ALUNOATIV_ATIVIDADE_CDG"]  = $this->atividade_cdg;
            
            return $this->db->UpdateRows("ALUNO_ATIVIDADE", $values, $where);
            
         }
		 
		 
     
      
         
 

          
          
        

	
	
}
?>

