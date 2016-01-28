<?php
include_once ROOT."model/db_classe.php";

class Descritor extends Classe
{
    
  public function __construct_vazio()
  { 
      parent::__construct();
  }
 
  public function __destruct() {
        
  }
  
  public function descricao_topico($topico ){
        return  $this->db->QuerySingleValue(" SELECT TOPICODESC_NOME "
                                   . "  FROM TOPICO_DESCRITOR WHERE TOPICODESC_CDG = ".$topico );
         
  }
  
  public function lista_descritores($topico = -1){                             
        $sql  =  "SELECT DESCRITOR_CDG,DESCRITOR_CODIGO,
                                DESCRITOR_DESC,
                                MATERIA_NOME,
                                (SELECT COUNT(*) FROM QUESTAO WHERE QUESTAO_DESCRITOR = DESCRITOR_CDG) AS N_QUESTOES
                           FROM DESCRITOR  
                           LEFT JOIN MATERIA ON MATERIA_CDG = DESCRITOR_MATERIA"    ;
         
         
        if($topico != -1){
            $sql = $sql . "  WHERE DESCRITOR_TOPICO = ".$topico ;
        }else{
            $sql = $sql . "  WHERE DESCRITOR_TOPICO IS NULL ";
        }  
         
        $this->db->Query($sql);
        $desc = array();               
        while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
            $desc[]  =  $row;
        }            
        return $desc;
  }
  

  
  public function lista_topicos(){
        $this->db->Query(" SELECT TOPICODESC_CDG, TOPICODESC_NOME,
                                MATERIA_NOME,
                                (SELECT COUNT(*) FROM QUESTAO 
                                    LEFT JOIN DESCRITOR ON DESCRITOR_CDG = QUESTAO_DESCRITOR
                                WHERE DESCRITOR_TOPICO  = TOPICODESC_CDG ) AS 'N_QUESTOES'
                           FROM TOPICO_DESCRITOR 
                             LEFT JOIN MATERIA ON MATERIA_CDG = TOPICODESC_MATERIA");

          
        while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
            $topic[]  =  $row;
        }            
        return $topic;
  }
    
  

}