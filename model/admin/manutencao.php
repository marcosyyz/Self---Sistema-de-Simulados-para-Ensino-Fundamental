<?php
include_once ROOT."model/db_classe.php";

class Manut extends Classe
{       
	
	public  $materia_cdg;			
        public  $campo;        	

	public function __construct() {
	     parent::__construct();             
	}
	
        
	public function __destruct() {
		
	}


	
	public function atualizar_refazer_em_60_dias($aluno) {
             // tentativas > 0
             // finalizou até 4 vezes
            //  reforçar após 60 dias
	    $this->db->Query("SELECT  A.ALUNOATIV_ATIVIDADE_CDG , A.ALUNOATIV_ERROS, A.ALUNOATIV_FINALIZADOS ,
                                    A.ALUNOATIV_TENTATIVAS ,  A.ALUNOATIV_DATA,
                                    DATEDIFF(CURDATE(),A.ALUNOATIV_DATA) AS TEMPO_DIAS,  TOTAL_FINALIZADO
                                FROM ALUNO_ATIVIDADE AS A
                                INNER JOIN 
                                    (SELECT  SUM(ALUNOATIV_FINALIZADOS) AS TOTAL_FINALIZADO, ALUNOATIV_ATIVIDADE_CDG , MAX(ALUNOATIV_DATA) AS ULTIMADATA
                                        FROM ALUNO_ATIVIDADE 
                                        WHERE ALUNOATIV_ALUNO_CDG = ".$aluno." 
                                        GROUP BY ALUNOATIV_ATIVIDADE_CDG 
                                    ) AS AA
                                ON A.ALUNOATIV_ATIVIDADE_CDG = AA.ALUNOATIV_ATIVIDADE_CDG
                                AND A.ALUNOATIV_DATA = AA.ULTIMADATA
                            WHERE ALUNOATIV_TENTATIVAS > 0
                                AND TOTAL_FINALIZADO BETWEEN  1 AND 4
                                HAVING TEMPO_DIAS > 60
                                ORDER BY alunoativ_tentativas desc,  ALUNOATIV_ERROS DESC ,TEMPO_DIAS DESC ");                          
            $this->db->MoveFirst();		 
	    while (!$this->db->EndOfSeek()) {
		$row =  $this->db->Row();
		$atividades_a_refazer[] = $row->ALUNOATIV_ATIVIDADE_CDG ;			                
	    }	
            if(isset($atividades_a_refazer)):   
              foreach ($atividades_a_refazer as $a){
                $this->db->Query(" UPDATE ALUNO_ATIVIDADE SET
                                          ALUNOATIV_DATAREFAZER = CURRENT_DATE 
                                      WHERE ALUNOATIV_ATIVIDADE_CDG = ".$a);
                           
            }
            endif;
	}
        
        
        public function atualizar_refazer_em_30_dias($aluno) {
            // erros = 2 
            // finalizou até 4 vezes
            // reforçar após 30 dias
	    $this->db->Query("SELECT  A.ALUNOATIV_ATIVIDADE_CDG , A.ALUNOATIV_ERROS, A.ALUNOATIV_FINALIZADOS ,
                                    A.ALUNOATIV_TENTATIVAS ,  A.ALUNOATIV_DATA,
                                    DATEDIFF(CURDATE(),A.ALUNOATIV_DATA) AS TEMPO_DIAS,  TOTAL_FINALIZADO
                                FROM ALUNO_ATIVIDADE AS A
                                INNER JOIN 
                                    (SELECT  SUM(ALUNOATIV_FINALIZADOS) AS TOTAL_FINALIZADO, ALUNOATIV_ATIVIDADE_CDG , MAX(ALUNOATIV_DATA) AS ULTIMADATA
                                        FROM ALUNO_ATIVIDADE 
                                        WHERE ALUNOATIV_ALUNO_CDG = ".$aluno." 
                                        GROUP BY ALUNOATIV_ATIVIDADE_CDG 
                                    ) AS AA
                                ON A.ALUNOATIV_ATIVIDADE_CDG = AA.ALUNOATIV_ATIVIDADE_CDG
                                AND A.ALUNOATIV_DATA = AA.ULTIMADATA
                           WHERE ALUNOATIV_ERROS = 2
                                AND TOTAL_FINALIZADO BETWEEN  1 AND 4
                                HAVING TEMPO_DIAS > 14
                                ORDER BY alunoativ_tentativas desc,  ALUNOATIV_ERROS DESC ,TEMPO_DIAS DESC ");              	                   
            $this->db->MoveFirst();		 
	    while (!$this->db->EndOfSeek()) {
		$row =  $this->db->Row();
		$atividades_a_refazer[] = $row->ALUNOATIV_ATIVIDADE_CDG ;			                
	    }	
            if(isset($atividades_a_refazer)): 
                foreach ($atividades_a_refazer as $a){
                   $this->db->Query(" UPDATE ALUNO_ATIVIDADE SET
                                          ALUNOATIV_DATAREFAZER = CURRENT_DATE 
                                      WHERE ALUNOATIV_ATIVIDADE_CDG = ".$a);
                           
                }
            endif;
             
             
	}
        
        
             
        public function atualizar_refazer_em_45_dias($aluno) {	
               // erros = 1
               // finalizou até 4 vezes
            // reforçar após 45 dias
	    $this->db->Query("SELECT  A.ALUNOATIV_ATIVIDADE_CDG , A.ALUNOATIV_ERROS, A.ALUNOATIV_FINALIZADOS ,
                                    A.ALUNOATIV_TENTATIVAS ,  A.ALUNOATIV_DATA,
                                    DATEDIFF(CURDATE(),A.ALUNOATIV_DATA) AS TEMPO_DIAS,  TOTAL_FINALIZADO
                                FROM ALUNO_ATIVIDADE AS A
                                INNER JOIN 
                                    (SELECT  SUM(ALUNOATIV_FINALIZADOS) AS TOTAL_FINALIZADO, ALUNOATIV_ATIVIDADE_CDG , MAX(ALUNOATIV_DATA) AS ULTIMADATA
                                        FROM ALUNO_ATIVIDADE 
                                        WHERE ALUNOATIV_ALUNO_CDG = ".$aluno." 
                                        GROUP BY ALUNOATIV_ATIVIDADE_CDG 
                                    ) AS AA
                                ON A.ALUNOATIV_ATIVIDADE_CDG = AA.ALUNOATIV_ATIVIDADE_CDG
                                AND A.ALUNOATIV_DATA = AA.ULTIMADATA
                        WHERE ALUNOATIV_ERROS > 0
                                AND TOTAL_FINALIZADO BETWEEN  1 AND 4
                                HAVING TEMPO_DIAS > 45
                        ORDER BY alunoativ_tentativas desc,  ALUNOATIV_ERROS DESC ,TEMPO_DIAS DESC ");              
	    $this->db->MoveFirst();		 
	    while (!$this->db->EndOfSeek()) {
		$row =  $this->db->Row();
		$atividades_a_refazer[] = $row->ALUNOATIV_ATIVIDADE_CDG ;			                
	    }	
            if(isset($atividades_a_refazer)):   
              foreach ($atividades_a_refazer as $a){
                $this->db->Query(" UPDATE ALUNO_ATIVIDADE SET
                                          ALUNOATIV_DATAREFAZER = CURRENT_DATE 
                                      WHERE ALUNOATIV_ATIVIDADE_CDG = ".$a);
                           
              }
            endif;
	}
        
	
	
	
	
	
}
?>


