<?php
include_once ROOT."model/db_classe.php";

class Usuario extends Classe
{
  
            
  protected $cdg;
  protected $login;
  protected $senha;
  protected $nome;  
  protected $cargo;
  protected $dtcriacao;
  protected $tipo;
      
      
  public function __construct_vazio()
  { 
     parent::__construct();
  }
  
        
  public function __construct($id, $login = "")
  { 
     parent::__construct();
    $this->cdg = $id;    
    $this->login = $login;             
	
    $this->carregar_dados();
  }

  # FUNCTIONS TO RETRIEVE INFO - DESERIALIZE.
  public function carregar_dados($usuario_cdg = -1)
  {      
    $sql = ( $this->cdg != -1 ? " SELECT * FROM USUARIO WHERE USUARIO_CDG = ".$this->cdg : 
        "SELECT * FROM USUARIO WHERE UPPER(USUARIO_LOGIN) = '".strtoupper($this->login)."'");   
    
    $this->db->Query($sql);
    if($this->db->RowCount() > 0 ){
        $row =  $this->db->Row();    
        $this->cdg = ($row->USUARIO_CDG);
        $this->nome = ($row->USUARIO_NOME);
        $this->senha = base64_decode($row->USUARIO_SENHA);
        $this->cargo =($row->USUARIO_CARGO);
        $this->login =($row->USUARIO_LOGIN);
    }
  }
  
  
  function gravar($usuario_cdg,$nome,$login,$senha,$cargo,$escola){
            
            // valores a serem inseridos           
           $valores["USUARIO_NOME"]  = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
           $valores["USUARIO_LOGIN"] = MySQL::SQLValue($login, MySQL::SQLVALUE_TEXT);           
           $valores["USUARIO_CARGO"]  = MySQL::SQLValue($cargo, MySQL::SQLVALUE_TEXT);           
           
           
          
        
        
            //consultar se ja existe
            $this->db->Query(" SELECT * FROM USUARIO WHERE USUARIO_CDG = ". $usuario_cdg);
            $this->db->MoveFirst();		
                
            
            // se  ja existe
            if($this->db->RowCount() > 0){                                               
                // update                           
                $where["USUARIO_CDG"]  = MySQL::SQLValue($usuario_cdg, MySQL::SQLVALUE_NUMBER);                
                $this->db->UpdateRows("USUARIO", $valores, $where);            
                $retorno = -1;                                    
            }else{                
                // se nao, executa insert
                $this->db->InsertRow("USUARIO", $valores);
                $retorno =  $this->db->GetLastInsertID();
            }  
            
                                                
            $usuario_cdg = $usuario_cdg == -1 ? $retorno : $usuario_cdg;
            if($usuario_cdg != -1){
                $this->gravar_usuarioEscola($usuario_cdg, $escola);
            }
            
            
            $this->db->Query(" UPDATE USUARIO SET USUARIO_SENHA = '".  base64_encode($senha)."' 
                          WHERE USUARIO_CDG = ". $usuario_cdg); 
            
            return $retorno;
  }
  
  
public function gravar_usuarioEscola($usuario, $escola){
    if(!$this->db->HasRecords('SELECT * FROM USUARIO_ESCOLA 
                              WHERE USUARIOESCOLA_USUARIO  = '.$usuario.'
                                   AND USUARIOESCOLA_ESCOLA = '.$escola.' ')){
        $this->db->Query(" INSERT INTO USUARIO_ESCOLA VALUES(".$usuario.",".$escola." ) ");
    }
}





  # GETTER and SETTER FUNCTIONS - DO NOT ALLOW SETTING OF ID
  public function getCdg() {return $this->cdg;}
  public function getLogin() {return $this->login;}
  public function getNome() {return $this->nome;}
  public function getSenha() { return $this->senha;}
  
  public function getCargo() {return $this->cargo;}
  public function getDtCriacao() {return $this->dtcriacao;}
  public function getTipo() {return $this->tipo;}
  
  public function setLogin($login) {$this->login = $login;}
  public function setNome($nome) {$this->nome = $nome;}
  public function setCDG($cdg) {$this->cdg = $cdg;}
  public function setSenha($param) { $this->senha = ($param);  }
  public function setCargo($param) {$this->cargo = $param;}
  public function setDtCriacao($param) {$this->dtcriacao = $param;}
  public function setTipo($param) {$this->tipo = $param;}
  
}

?>