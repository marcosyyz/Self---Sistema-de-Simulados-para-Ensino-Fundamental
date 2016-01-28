<?php
include_once ROOT."model/db_classe.php";

class Turma extends Classe
{       
	
	private $turma_cdg;			
        private $turma_nome;
        private $turma_ano;
        private $turma_serie;
        private $turma_letra;
        private $turma_prof_cdg;
        private $turma_prof_nome;
        private $turma_ativo;
        private $turma_escola;
        
        private $sql;
        private $professor_anterior;




        public function getCDG(){  return $this->turma_cdg;  }
        public function getNome(){  return $this->turma_nome;  }
        public function getAno(){  return $this->turma_ano;  }
        public function getSerie(){  return $this->turma_serie;  }
        public function getLetra(){  return $this->turma_letra;  }
        public function getProfCDG(){  return $this->turma_prof_cdg;  }
        public function getProfNome(){  return $this->turma_prof_nome;  }
        public function getAtivo(){  return $this->turma_ativo;  }
        public function getEscolaCDG(){  return $this->turma_escola;  }
        
        
        public function setCDG($param) { $this->turma_cdg = $param; }
        public function setNome($param) { $this->turma_nome = $param; }
        public function setAno($param) { $this->turma_ano = $param; }
        public function setSerie($param) { $this->turma_serie = $param; }
        public function setLetra($param) { $this->turma_letra = $param; }
        public function setProfCDG($param) { $this->turma_prof_cdg = $param; }
        public function setProfNome($param) { $this->turma_prof_nome = $param; }
        public function setAtivo($param) { $this->turma_ativo = $param; }
        public function setEscolaCDG($param) { $this->turma_escola = $param; }


        public function __construct() {
	     parent::__construct();   
             $this->sql = " SELECT TURMA_CDG,TURMA_CDG id,
                            CONCAT(TURMA_SERIE,'º',TURMA_LETRA) AS TURMA_NOME ,                                
                            TURMA_ANO, TURMA_SERIE, TURMA_ATIVO, TURMA_ESCOLA,
                            TURMA_LETRA, TURMA_PROF,
                            USUARIO_NOME AS 'TURMA_PROFESSOR'
                     FROM TURMA 
                        LEFT JOIN USUARIO ON USUARIO_CDG = TURMA_PROF 
                        WHERE (TURMA_ANO = ".(isset($_SESSION['ANO_DE_CONSULTA']) ? $_SESSION['ANO_DE_CONSULTA'] : '-1' )." ) ";                        
	}
	
        
	public function __destruct() {
		
	}


	
	public function carregar_turma($turma = -1) {
	     $this->db->Query($this->sql.' AND TURMA_CDG = '.$turma);
             
	     if($this->db->rowCount() > 0){
                 $row = $this->db->row();
                 $this->setCDG($row->TURMA_CDG);
                 $this->setAno($row->TURMA_ANO);
                 $this->setAtivo($row->TURMA_ATIVO);
                 $this->setEscolaCDG($row->TURMA_ESCOLA);
                 $this->setLetra($row->TURMA_LETRA);
                 $this->setNome($row->TURMA_NOME);
                 $this->setProfCDG($row->TURMA_PROF);
                 $this->setProfNome($row->TURMA_PROFESSOR);
                 $this->setSerie($row->TURMA_SERIE);
                 return true;
             }else{
                 return false;
             }
	}
	
        public function resultset_turmas($escola = -1,$apenas_ativas = false) {
            if($apenas_ativas){
                $this->sql = $this->sql . " AND TURMA_ATIVO = 1 ";
            }
            
            if($escola != -1){
                $this->sql = $this->sql . " AND TURMA_ESCOLA = ".$escola;
            }
                
            
            return  $this->db->Query($this->sql);
        }
	
	
	 // retorna um arrays com os codigos das questoes da turma passada por parametro
	public function lista_turmas($escola = -1,$apenas_ativas = false) {
            $turmas = array();
                       
            $result = $this->resultset_turmas($escola, $apenas_ativas);
                        
            while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
                $turmas[]  =  $row;
            }            
            return $turmas;
	}
	
        
        
        public function bloquear_turmas($turma, $desbloquear = 0 , $escola = - 999) {
             $sql = ' UPDATE TURMA SET TURMA_ATIVO = '.$desbloquear.' WHERE (1=1) ';
             
             if($turma != -1)
                $sql = $sql . ' AND TURMA_CDG = '.$turma;
             
             if($escola != -999)
                $sql = $sql . ' AND TURMA_ESCOLA = '.$escola;
             
             $result = $this->db->Query($sql);
        }
     
         public function gravar($letra,$serie,$ano,$prof,$escola,$turma_cdg){

            
            // valores a serem inseridos           
           $valores["TURMA_LETRA"]  = MySQL::SQLValue($letra, MySQL::SQLVALUE_TEXT);
           $valores["TURMA_SERIE"] = MySQL::SQLValue($serie, MySQL::SQLVALUE_NUMBER);
           $valores["TURMA_ANO"]  = MySQL::SQLValue($ano, MySQL::SQLVALUE_NUMBER);
           $valores["TURMA_PROF"]  = MySQL::SQLValue($prof, MySQL::SQLVALUE_NUMBER);           
           $valores["TURMA_ESCOLA"]  = MySQL::SQLValue($escola, MySQL::SQLVALUE_NUMBER);           
           
                                               
        
        
            //consultar se ja existe
            $this->db->Query(" SELECT * FROM TURMA WHERE TURMA_CDG = ". $turma_cdg);
            $this->db->MoveFirst();		
                                                      
            
            // se  ja existe
            if($this->db->RowCount() > 0){
                $row = $this->db->row();
                
                $this->professor_anterior = isset($row->TURMA_PROF) ? $row->TURMA_PROF : -1;
                // update           
                $where["TURMA_CDG"]  = MySQL::SQLValue($turma_cdg, MySQL::SQLVALUE_NUMBER);                
                $this->db->UpdateRows("TURMA", $valores, $where);
                $retorno = -1;
                
                    
            }else{
                $this->professor_anterior = -1;
                // se nao, executa insert
                $this->db->InsertRow("TURMA", $valores);
                $retorno =  $this->db->GetLastInsertID();
            }
     
         
            
            $this->db->Query(" DELETE FROM USUARIO_TURMA 
                                WHERE USUARIOTURMA_USUARIO = ".$this->professor_anterior.
                               " AND USUARIOTURMA_TURMA = ".$turma_cdg);
            
              
            if(isset($prof)){
                if($prof != -1){
                    $turma_cdg = $turma_cdg == -1 ? $retorno : $turma_cdg;
                    $this->gravar_usuarioTurma($prof, $turma_cdg);
                }
            }


            
            return $retorno;
         }
        
         
         
        public function gravar_usuarioTurma($usuario, $turma){
            if(!$this->db->HasRecords('SELECT * FROM USUARIO_TURMA 
                              WHERE USUARIOTURMA_USUARIO  = '.$usuario.'
                                   AND USUARIOTURMA_TURMA = '.$turma.' ')){
                $this->db->Query(" INSERT INTO USUARIO_TURMA VALUES(".$usuario.",".$turma." ) ");
            }
        }

	
	
}
?>