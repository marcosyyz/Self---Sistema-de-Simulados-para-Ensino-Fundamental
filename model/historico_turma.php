<?php
include_once ROOT."model/db_classe.php";


class Historico_Turma extends Classe
{
        private $turma_atual;
        
        public $ThrowExceptions = false;

	public function __construct() {
             parent::__construct();
        }
        
         public function setTurma($turma){
           $this->turma_atual = $turma;                     
        }
        
        
        public function getTurmaNome($turma_cdg){
            return $this->db->QuerySingleValue(" SELECT  CONCAT(TURMA_SERIE,'º',TURMA_LETRA) AS NOME
                                            FROM TURMA                                             
                                          WHERE TURMA_CDG = ".$turma_cdg);
        }
        
        public function listar_precisa_reforcar($status){                       
            $sql =  "SELECT  COUNT(ALUNOATIV_ALUNO_CDG) 'Nº Alunos',
                                  ATIVIDADE_NOME AS Atividade, 
                                 SUM(ALUNOATIV_ERROS) Erros, 
                                  SUM(ALUNOATIV_ACERTOS) Acertos, 
                                  SUM(ALUNOATIV_FINALIZADOS) Finalizou, 
                                  SUM(ALUNOATIV_TENTATIVAS) Tentativas, 
                                  SEC_TO_TIME((COALESCE(SUM(ALUNOATIV_TEMPO),0) ) div count(ALUNOATIV_ALUNO_CDG)) 'Tempo Médio'                               
                                FROM ALUNO_ATIVIDADE 
                                  LEFT JOIN ATIVIDADE ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
                                  LEFT JOIN ALUNO ON ALUNOATIV_ALUNO_CDG = ALUNO_CDG 
                                WHERE ALUNOATIV_TURMA = ".$this->turma_atual."
                                  AND ALUNOATIV_FINALIZADOS > 0
                                  AND ALUNOATIV_FINALIZADOS < 5
                                  AND ALUNOATIV_TENTATIVAS > 0 
                                  AND ALUNOATIV_ERROS > 0
                                  AND ALUNO_STATUS = '".$status."'
                                  GROUP BY ATIVIDADE_NOME
                                  ORDER BY COUNT(ALUNOATIV_ALUNO_CDG) DESC" ;                
                                      
             $this->db->Query($sql);
             return $this->db->GetHTML(false);                                                   
    }
}