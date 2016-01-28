<?php
include_once ROOT."model/db_classe.php";
include_once(ROOT."model/usuario.php");


class Admin_Usuario extends Usuario{
    
            
        public function __construct()
        { 
            parent::__construct_vazio();
        }
        
        public function nome_para_cdg($usuario_nome){
           return $this->db->QuerySingleValue('SELECT USUARIO_CDG'
                   . '  FROM USUARIO WHERE USUARIO_NOME = '.$usuario_nome);
        }
        
        public function cdg_para_nome($usuario_cdg){
           if($usuario_cdg != -1)  
             return $this->db->QuerySingleValue('SELECT USUARIO_NOME'
                   . '  FROM USUARIO WHERE USUARIO_CDG = '.$usuario_cdg);
           else
             return '-1';  
        }
        
        public function carregar_nomes_usuarios() {	     
            
	     $this->db->Query("SELECT USUARIO_CDG, USUARIO_NOME FROM USUARIO ");
	     return $this->db;
	}
        
        
        public function lista_usuarios($nivel,$escola_cdg){
            $profs = array();
            $sql = "   SELECT * FROM USUARIO "
                    ."    LEFT JOIN USUARIO_ESCOLA ON USUARIOESCOLA_USUARIO = USUARIO_CDG "                    
                    ." WHERE USUARIO_ATIVO = 1"
                    ." AND USUARIO_NIVEL <= ".$nivel;
                    
            if($escola_cdg != -1)
                $sql .= "   AND USUARIOESCOLA_ESCOLA = ".$escola_cdg;
                 
            $this->db->Query($sql);

            while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
                $profs[]  =  $row;
            }            
            return $profs;
        }
        
        
        
	
    
    
}
