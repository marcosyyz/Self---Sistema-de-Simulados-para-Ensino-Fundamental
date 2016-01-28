<?php
include_once(ROOT."model/aluno.php");


class Admin_Aluno extends Aluno{
    
    public $aluno_cdg;
    public $login;
    public $senha;
    public $nome;
    public $dtnasc;
    public $sexo;
    public $logado;
    public $rgm;
    public $turmaatual;
    public $pontos;
    public $dtultimologin;
    public $ultimolocal;
    public $nivel;
    public $status;
    
    public function __construct($aluno_cdg = -1) {
         parent::__construct($aluno_cdg);
    }
    
    
    
    public function lista_turmas(){
                    $result = $this->db->Query(" SELECT 
                              TURMA_CDG ,  
                              CONCAT(TURMA_SERIE,'º',TURMA_LETRA) AS TURMA_NOME, 
                              TURMA_ANO, TURMA_ATIVO,
                              USUARIO_NOME AS TURMA_PROFESSOR   
                            FROM TURMA LEFT JOIN USUARIO ON USUARIO_CDG = TURMA_PROF ");
                        
            while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
                $turmas[]  =  $row;
            }
            return $turmas;
    }
    
    
    public function resultset_alunos($escola,$turma, $palavra_chave){
        $sql = " SELECT ALUNO_CDG id,          ALUNO_RA,                ALUNO_LOGIN,  ALUNO_SENHA,
                        ALUNO_NOME,         ALUNO_DTNASC,            ALUNO_SEXO,   ALUNO_LOGADO,
                        ALUNO_PONTOS,       ALUNO_ATIVIDADECONCLUIDA,ALUNO_SERIE,  ALUNO_RGM,
                        ALUNO_TURMAATUAL,   ALUNO_ULTIMOLOGIN,  ALUNO_ULTIMOLOCAL, ALUNO_NIVEL,
                        ALUNO_STATUS,       ALUNO_CDG,          ALUNO_LOGIN,        ALUNO_SENHA,   
                        ALUNO_NOME,         ALUNO_DTNASC,       ALUNO_SEXO,         ALUNO_LOGADO,
                        ALUNO_PONTOS,       ALUNO_ATIVIDADECONCLUIDA, ALUNO_SERIE,  ALUNO_RGM,
                        ALUNO_TURMAATUAL,   ALUNO_ULTIMOLOGIN,  ALUNO_ULTIMOLOCAL,  ALUNO_NIVEL,
                        ALUNO_STATUS,
                        DATE_FORMAT(ALUNO_DTNASC,'%d/%m/%Y') as ALUNO_NASCIMENTO,
                        CONCAT(TURMA_SERIE,'º',TURMA_LETRA) AS TURMA_NOME
                   FROM ALUNO A 
                   LEFT JOIN TURMA T ON ALUNO_TURMAATUAL = TURMA_CDG
                WHERE 1=1 ";
        
        if($turma != -1){
            $sql = $sql . " AND ALUNO_TURMAATUAL =  ". $turma;
        }
        
        if($escola != -1){
            $sql = $sql . " AND TURMA_ESCOLA =  ". $escola;
        }        
               
        if(trim($palavra_chave) != ""){   
            $sql = $sql . " AND UPPER(ALUNO_NOME) LIKE '%" . strtoupper($palavra_chave) . "%' ";
        }
        
        return $this->db->Query($sql);
    }
    
    
     public function lista_alunos($escola,$turma, $palavra_chave){               
        
        $result = $this->resultset_alunos($escola, $turma, $palavra_chave);
                        
            while ($row = mysqli_fetch_array($this->db->last_result,MYSQLI_ASSOC)) {
                $alunos[]  =  $row;
            }            
            return isset($alunos) ? $alunos : array() ;
    }
    
    
    
    
    
    
}
    
