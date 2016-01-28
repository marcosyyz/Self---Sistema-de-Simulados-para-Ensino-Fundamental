<?php
include_once(ROOT."model/atividade.php");


class Admin_Atividade extends Atividade{
    
    public $atividade_cdg;
    public $serie;
    public $titulo;
    public $descricao;
    public $tipo;
    public $ordem;
    public $nivel;
    public $verifica_acentuacao;
    
    public function __construct($atividade_cdg = null) {
        parent::__construct($atividade_cdg, 1);
        $this->atividade_cdg = isset($atividade_cdg) ? $atividade_cdg : -1;
             if($this->atividade_cdg != -1)
                $this->carregar_atividade();
             
    }
    
    public function atualizar_potuacao(){
            return $this->db->Query(" UPDATE ALUNO SET ALUNO_PONTOS = 
                                        (SELECT ALUNOATIV_ACERTOS - ALUNOATIV_ERROS 
                                            FROM ALUNO_ATIVIDADE 
                                            WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG 
                                            AND ALUNOATIV_FINALIZADOS > 0 ) ");
    }
    
    
    
       //gravar , update ou insert na tabela ATIVDADE
        public function gravar($titulo,$descricao,$serie,$tipo,$ordem,$nivel,$verificaacento,
                                $criador,$revisor,$materia,
                                $assunto){
                      
            
            
            // valores a serem inseridos
           $valores["ATIVIDADE_NOME"]  = MySQL::SQLValue($titulo, MySQL::SQLVALUE_TEXT);
           $valores["ATIVIDADE_DESC"]  = MySQL::SQLValue($descricao, MySQL::SQLVALUE_TEXT);
           $valores["ATIVIDADE_SERIE"] = MySQL::SQLValue($serie, MySQL::SQLVALUE_NUMBER);
           $valores["ATIVIDADE_TIPO"]  = MySQL::SQLValue($tipo, MySQL::SQLVALUE_NUMBER);
           $valores["ATIVIDADE_ORDEM"]  = MySQL::SQLValue($ordem, MySQL::SQLVALUE_NUMBER);
           $valores["ATIVIDADE_NIVEL"]  = MySQL::SQLValue($nivel, MySQL::SQLVALUE_NUMBER);
           $valores["ATIVIDADE_VERIFICAACENTO"]  = MySQL::SQLValue($verificaacento, MySQL::SQLVALUE_NUMBER);
                                               
        
        
            //consultar se ja existe
            $this->db->Query(" SELECT * FROM ATIVIDADE WHERE ATIVIDADE_CDG = ".  $this->atividade_cdg);
            $this->db->MoveFirst();		
                                                      
            
            // se  ja existe
            if($this->db->RowCount() > 0){               
                // update                             
                $where["ATIVIDADE_CDG"]  = MySQL::SQLValue($this->atividade_cdg, MySQL::SQLVALUE_NUMBER);                
                $this->db->UpdateRows("ATIVIDADE", $valores, $where);
                return -1; 
            }else{
                // se nao, executa insert                                   
                $valores["ATIVIDADE_CRIADOR"]  = MySQL::SQLValue($criador, MySQL::SQLVALUE_TEXT);                                
                $this->db->InsertRow("ATIVIDADE", $valores);
                return $this->db->GetLastInsertID();
            }
           		
        }
        
        
        public function carregar_atividade(){
            
            $this->db->Query(" SELECT * FROM ATIVIDADE WHERE ATIVIDADE_CDG = ".$this->atividade_cdg);
            $this->db->MoveFirst();		
            if($this->db->RowCount() > 0){      
                $row =  $this->db->Row();
                $this->serie = $row->ATIVIDADE_SERIE;                
                $this->titulo = $row->ATIVIDADE_NOME;
                $this->descricao = $row->ATIVIDADE_DESC;
                $this->tipo = $row->ATIVIDADE_TIPO;
                $this->ordem = $row->ATIVIDADE_ORDEM;               
                $this->nivel = $row->ATIVIDADE_NIVEL;
                $this->verifica_acentuacao = $row->ATIVIDADE_VERIFICAACENTO;
            }
            
        }
    
        public function lista_atividades($filtro = -1){
            $atividades = array();
            $sql = " SELECT A.*, 
                          (SELECT COUNT(*) AS QTD FROM ATIVIDADE_QUESTAO 
                                WHERE ATIVQUESTAO_ATIVIDADE = ATIVIDADE_CDG)
                             +
                           (SELECT COUNT(*) AS QTD FROM ATIVIDADE_QUESTAODIGITAR 
                                 WHERE ATIVQUESTAODIGITAR_ATIVIDADE = ATIVIDADE_CDG)
                           AS QTD_QUESTOES
                          FROM ATIVIDADE A  WHERE (1=1) ";
            
            if(($filtro != -1 ) && (trim($filtro) != '')){
                $sql .= " AND ATIVIDADE_NOME LIKE '%".$filtro."%' "
                        . " OR ATIVIDADE_DESC LIKE '%".$filtro."%' ";
            }
            
            $sql .= " ORDER BY ATIVIDADE_NIVEL,ATIVIDADE_ORDEM ";
            
            $result = $this->db->Query($sql);
                            
                        
            while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
                $atividades[]  =  $row;
            }            
            return $atividades;
        }
        
        
        public function proximoid($ID){
            return $this->db->NextId('ATIVIDADE', 'ATIVIDADE_CDG',$ID ,'ATIVIDADE_ORDEM');
        }
        
        
        public function anteriorid($ID){
            if($ID > 0.01) 
                return $this->db->PriorId('ATIVIDADE', 'ATIVIDADE_CDG',$ID,'ATIVIDADE_ORDEM','ATIVIDADE_ORDEM' );
            else
              return -1;
          
        }
}

