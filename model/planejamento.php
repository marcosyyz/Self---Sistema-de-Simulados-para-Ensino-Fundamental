<?php
include_once("mysql.php");


class Planejamento{
    
    private $db;      // conexao com o banco    
    
    public $ThrowExceptions = false;
    
    public function __construct() {
	     $this->db = new Mysql();	             
	}
    
        
    public function listar_atividades($aluno,$nivel){
         $this->db->Query('SELECT A.*, 
                             MIN(ALUNOATIV_ERROS) as ERROS, MAX(ALUNOATIV_FINALIZADOS) AS FINALIZOU
                           FROM ATIVIDADE A 
                             LEFT JOIN ALUNO_ATIVIDADE ON ALUNOATIV_ATIVIDADE_CDG =  ATIVIDADE_CDG 
                                AND ALUNOATIV_ALUNO_CDG = '.$aluno.'
                             WHERE ATIVIDADE_NIVEL = '.$nivel.'
                        AND ATIVIDADE_ORDEM IS NOT NULL
                            GROUP BY ATIVIDADE_CDG
                            ORDER BY ATIVIDADE_ORDEM ');
                 $this->db->MoveFirst();
        return $this->db;
    }
        
       
        
    public function lista_de_atividades($nivel){
        $this->db->Query("SELECT * FROM ATIVIDADE where ATIVIDADE_NIVEL  = ".$nivel
                           ." ORDER BY ATIVIDADE_ORDEM "); 
        $this->db->MoveFirst();
        return $this->db;
    }
    
    public function lista_de_atividades_do_aluno(){
        $this->db->Query("SELECT * FROM ATIVIDADE WHERE ATIVIDADE_NIVEL  = 1 "
                           ." ORDER BY ATIVIDADE_ORDEM "); 
        $this->db->MoveFirst();
        return $this->db;
    }
    
    public function ultima_atividade_concluida($aluno_cdg,$nivel){
        $ultima_atividade =  $this->db->QuerySingleValue("SELECT  ATIVIDADE_ORDEM FROM ATIVIDADE A
                                    LEFT JOIN ALUNO_ATIVIDADE ON ALUNOATIV_ATIVIDADE_CDG = ATIVIDADE_CDG                                   
                                    WHERE ALUNOATIV_ALUNO_CDG = ".$aluno_cdg."
                                    AND ATIVIDADE_NIVEL = ".$nivel."    
                                    AND ALUNOATIV_FINALIZADOS > 0
                                    ORDER BY ATIVIDADE_ORDEM DESC
                                    LIMIT 1 ");
        
        //QuerySingleValue retorna false se nao encontrar nenhum registro
        return  ($ultima_atividade == false ) ?  '0' : $ultima_atividade ;
    }
    
    public function atividades_concluidas($aluno_cdg,$nivel){
        $this->db->Query("SELECT * FROM ATIVIDADE                          
                            WHERE ATIVIDADE_ORDEM  <= ".$this->ultima_atividade_concluida($aluno_cdg,$nivel)."                             
                            AND ATIVIDADE_NIVEL = ".$nivel."                            
                            ORDER BY ATIVIDADE_ORDEM "); 
        $this->db->MoveFirst();
        return $this->db;
    }
    
    public function proxima_atividade($aluno_cdg,$nivel){
        $this->db->Query("SELECT * FROM ATIVIDADE                            
                            WHERE ATIVIDADE_ORDEM  > ".$this->ultima_atividade_concluida($aluno_cdg, $nivel)."
                            AND ATIVIDADE_NIVEL = ".$nivel."                                
                            ORDER BY ATIVIDADE_ORDEM LIMIT 1 "); 
        $this->db->MoveFirst();
        return $this->db;
    }
    
    
     public function atividades_desabilitadas($aluno_cdg, $nivel){
        $this->db->Query("SELECT * FROM ATIVIDADE                            
                            WHERE ATIVIDADE_ORDEM  > 
                                ( SELECT ATIVIDADE_ORDEM FROM ATIVIDADE WHERE ATIVIDADE_ORDEM > 
                                        ".$this->ultima_atividade_concluida($aluno_cdg, $nivel)." ORDER BY ATIVIDADE_ORDEM LIMIT 1 )
                            AND ATIVIDADE_NIVEL = ".$nivel."                          
                            ORDER BY ATIVIDADE_ORDEM "); 
        $this->db->MoveFirst();
        return $this->db;
    }
    
    
}
    
