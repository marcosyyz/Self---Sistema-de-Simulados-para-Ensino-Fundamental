<?php
include_once ROOT."model/db_classe.php";

class Login extends Classe
{
	
	
	public  $cdg;        
        public  $login;
	public  $nome ;       
	public  $senha; 
        public  $serie;
        public  $turmaatual_cdg;
        
	
	
	public $ThrowExceptions = false;

	public function __construct($login,$serie,$senha='') {
           parent::__construct();
           $this->turmaatual_cdg = null;
	   $this->serie = strtoupper(trim($serie));
           $this->login = strtoupper(trim($login));
           
           // remove espaços extras entre nome e sobrenome
           $this->login  = str_replace('    ', ' ', $this->login );           
           $this->login  = str_replace('   ', ' ', $this->login );
           $this->login  = str_replace('  ', ' ', $this->login );
           
           // remove os espaços entre a serie e a letra
           $this->serie  = str_replace(' ', '', $this->serie );
           $this->serie  = str_replace('  ', '', $this->serie );
           $this->serie  = str_replace('   ', '', $this->serie );
          
           
           $this->senha= (trim($senha));
	}
        
	
	public function __destruct() {
		
	}

	public function autenticar_login_senha() {
             $this->db = new Mysql();
             $filter["ALUNO_LOGIN"] = MySQL::SQLValue($this->login);
             $filter["ALUNO_SENHA"] = MySQL::SQLValue($this->senha);
             $this->db->SelectRows("ALUNO",$filter);
             $ok = ($this->db->RowCount() > 0 );
             if ($ok){ $this->carregar_dados_aluno();}
             $this->db->Close();
             return $ok;             
        }
        
        public function autenticar_apenas_nome(){
            $dados_row = $this->db->QuerySingleRow("
                SELECT ALUNO_CDG FROM ALUNO WHERE ALUNO_LOGIN = '".$this->login."' ");
            return ($this->db->RowCount() > 0 );            
            
        }
        
        // autentica usando apenas o nome de login do aluno
        public function autenticar_login($segundo_aluno = false) {           
            
            $sql = " SELECT A.*,T.*,
                        UPPER(CONCAT(TURMA_SERIE,'º',TURMA_LETRA)) AS ALUNO_TURMA_NOME
                     FROM ALUNO A
                     LEFT JOIN TURMA T ON TURMA_CDG = ALUNO_TURMAATUAL
                     WHERE UPPER(ALUNO_LOGIN)  = '".$this->login."' ";
                     
            
            if(isset($this->turmaatual_cdg)){
                $sql = $sql . " AND ALUNO_TURMAATUAL = ".$this->turmaatual_cdg;
            }else{
                $sql = $sql . " AND UPPER(CONCAT(TURMA_SERIE,TURMA_LETRA)) = '".$this->serie."'";
            }
                
            $dados_row = $this->db->QuerySingleRow($sql);
            $ok = ($this->db->RowCount() > 0 );            
            if($ok){
                //se retornou linha, e se a turma esta ativa
                if($dados_row->TURMA_ATIVO == 1){
                    //se autenticou , carrega dados
                    if($segundo_aluno){                    
                        $this->carregar_dados_segundo_aluno($dados_row);
                    }else{
                        $this->carregar_dados_aluno($dados_row);
                    }
                    return 1; // ok
                }else{
                    return 2; // bloqueado
                }
            }else{
                return 0; // nao trouxe registro
            }
        }
        
        
                
        
        public function autenticar_usuario_senha() {         
            $dados_row = $this->db->QuerySingleRow("
                SELECT *
                    FROM USUARIO                     
                WHERE UPPER(USUARIO_LOGIN)  = '".$this->login."'
                    AND UPPER(USUARIO_SENHA) = '".base64_encode($this->senha)."'");
            $ok = ( $this->db->RowCount() > 0 );
             //se autenticou , carrega dados                        
            if($ok){
                //se retornou linha, e se a turma esta ativa
                if($dados_row->USUARIO_ATIVO == 1){
                    //se autenticou , carrega dados
                    $this->carregar_dados_usuario($dados_row);
                    return 1; // ok
                }else{
                    return 2; // bloqueado
                }
            }else{
                return 0; // nao trouxe registro
            }
             
        }
        
        public function carregar_dados_segundo_aluno($row){
            //gravando sessoes de segundo login
            $_SESSION['ALUNO_CDG2'] = isset($row->ALUNO_CDG)? $row->ALUNO_CDG : null; 
            $_SESSION['LOGIN2'] = isset($row->ALUNO_LOGIN) ? $row->ALUNO_LOGIN : null; 
            $_SESSION['SENHA2'] = isset($row->ALUNO_SENHA) ? $row->ALUNO_SENHA : null;
            $_SESSION['ALUNO_TURMA2'] = isset($row->ALUNO_TURMAATUAL) ? $row->ALUNO_TURMAATUAL : null;
            $_SESSION['ALUNO_TURMA_NOME2'] =  isset($row->ALUNO_TURMA_NOME) ? $row->ALUNO_TURMA_NOME : null;
            
            $_SESSION['ALUNO_NIVEL2'] = isset($row->ALUNO_NIVEL) ? $row->ALUNO_NIVEL : -1;                        
            
            $this->logarAluno($_SESSION['ALUNO_CDG2']);
        }
        
        //carrega dados de login nas variaveis e nas session , ternários necessarios caso classe nao estiver conectada no bd  
        public function carregar_dados_aluno($row){
            
            //gravando sessoes de login            
            $_SESSION['ALUNO_CDG'] = isset($row->ALUNO_CDG)? $row->ALUNO_CDG : null; 
            $_SESSION['LOGIN'] = isset($row->ALUNO_LOGIN) ? $row->ALUNO_LOGIN : null; 
            $_SESSION['SENHA'] = isset($row->ALUNO_SENHA) ? $row->ALUNO_SENHA : null;
            $_SESSION['ALUNO_TURMA'] = isset($row->ALUNO_TURMAATUAL) ? $row->ALUNO_TURMAATUAL : null;
            $_SESSION['ALUNO_TURMA_NOME'] =  isset($row->ALUNO_TURMA_NOME) ? $row->ALUNO_TURMA_NOME : null;
            
            $_SESSION['ALUNO_NIVEL'] = isset($row->ALUNO_NIVEL) ? $row->ALUNO_NIVEL : -1;
            
            $this->cdg =  isset($row->ALUNO_CDG)? $row->ALUNO_CDG : null; 
	    $this->nome = isset($row->ALUNO_LOGIN) ? $row->ALUNO_LOGIN : null; 
            $this->senha= isset($row->ALUNO_SENHA) ? $row->ALUNO_SENHA : null;
            
            $this->logarAluno($this->cdg);
        }
        
     
         //carrega dados de login nas variaveis e nas session , ternários necessarios caso classe nao estiver conectada no bd  
        public function carregar_dados_usuario($row){          
          
            //gravando sessoes de login 
            $this->cdg = $row->USUARIO_CDG; 
            $_SESSION['USUARIO_CDG'] = isset($row->USUARIO_CDG) ? $row->USUARIO_CDG: -1; 
            $_SESSION['LOGIN'] = isset($row->USUARIO_LOGIN) ? $row->USUARIO_LOGIN: null; 
            $_SESSION['SENHA'] = isset($row->USUARIO_SENHA) ? $row->USUARIO_SENHA : null;
            $_SESSION['ALUNO_TURMA'] = '';            
            $_SESSION['ALUNO_NIVEL'] =  -1;
            $_SESSION['USUARIO_NIVEL'] = isset($row->USUARIO_NIVEL) ? $row->USUARIO_NIVEL : null ;
            $_SESSION['ANO_DE_CONSULTA'] =  isset($row->USUARIO_ANODECONSULTA) ? $row->USUARIO_ANODECONSULTA : null ;
            
	    $this->db->Query(" SELECT  USUARIOTURMA_TURMA , CONCAT(TURMA_SERIE,'º',TURMA_LETRA) AS NOME
                                    FROM USUARIO_TURMA 
                                    LEFT JOIN TURMA ON TURMA_CDG = USUARIOTURMA_TURMA
                                WHERE USUARIOTURMA_USUARIO = ".$this->cdg
                                ." AND TURMA_ANO = ".(isset($_SESSION['ANO_DE_CONSULTA']) ? $_SESSION['ANO_DE_CONSULTA'] : "-1")
                             );
	    $this->db->MoveFirst();		 
	    while (!$this->db->EndOfSeek()) {
		$row =  $this->db->Row();
		$_SESSION['MINHAS_TURMAS_CDG'][] = $row->USUARIOTURMA_TURMA;
                $_SESSION['MINHAS_TURMAS_NOME'][] = $row->NOME;
	     }			
	
            
            $this->logarUsuario();
        }
        
        private function logarUsuario(){
             $_SESSION['LOGADO'] = '1';
             $this->db->Query(' UPDATE USUARIO SET USUARIO_LOGADO = 1 WHERE USUARIO_CDG = ' . $this->cdg);
        }
        
        private function logarAluno($aluno_cdg){                          
            if(isset($aluno_cdg)){
                $this->db->Query(' UPDATE ALUNO SET ALUNO_LOGADO = 1, '
                              .' ALUNO_ULTIMOLOGIN = CURRENT_TIMESTAMP(), '
                              .' ALUNO_ULTIMOLOCAL = "'.gethostbyaddr($_SERVER['REMOTE_ADDR']).'"'
                              .' WHERE ALUNO_CDG = ' . $aluno_cdg);             
             
                $_SESSION['LOGADO'] = '1';
            }             
        }
        


	
	
}
?>