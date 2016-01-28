<?php
include_once ROOT."model/db_classe.php";

class Escola Extends Classe
{
    
    	public function __construct($escola_cdg = -1) {
            parent::__construct();            
            
        }
        
        public function getNome($escola_cdg){
            return $this->db->QuerySingleValue(" SELECT ESCOLA_NOME
                                FROM ESCOLA WHERE ESCOLA_CDG = ".$escola_cdg);
        }
        
        public function lista_escolas($escola = -1,$apenas_ativas = false) {
            $sql = " SELECT *                                
                     FROM ESCOLA WHERE (1=1) ";
            
            if($apenas_ativas){
                $sql = $sql . " AND ESCOLA_ATIVO = 1 ";
            }
                            
            
            $result = $this->db->Query($sql);
                        
            while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
                $escolas[]  =  $row;
            }            
            return $escolas;
	}
}
