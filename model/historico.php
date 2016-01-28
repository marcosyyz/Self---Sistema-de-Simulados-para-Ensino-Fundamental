<?php
include_once("mysql.php");

class Historico
{
    private $db;      // conexao com o banco
    private $aluno_cdg;
    public $aluno_nome;
    private $turma_atual;
    
    
    public function __construct($turma = null) {
             $this->db = new Mysql();	               
             $this->setTurma($turma);
    }
    
    public function __destruct() {
        
    }
    
    public function setTurma($turma){
        $this->turma_atual = $turma;
    }
    
    public function atividade_nome($atividade){
          $this->db->Query(" SELECT 
                                ATIVIDADE_NOME
                                FROM ATIVIDADE
                                WHERE ATIVIDADE_CDG  =  ".$atividade);
          $this->db->MoveFirst();
          if ($this->db->RowCount() > 0){
            $row =  $this->db->Row();
            return $row->ATIVIDADE_NOME;			
          }else{
              return '';
          }
    }
    
    public function turma($turma_cdg){
         return $this->db->QuerySingleValue('SELECT CONCAT(TURMA_SERIE,"º",TURMA_LETRA," - ",TURMA_ANO) FROM  TURMA WHERE TURMA_CDG = '.$turma_cdg);
    }
     
    
    public function nome_aluno($aluno_cdg){
         return $this->db->QuerySingleValue('SELECT ALUNO_NOME FROM ALUNO WHERE ALUNO_CDG = '.$aluno_cdg);
    }
    
     
    public function listar_datas(){    
        $DATAS = array();
        $this->db->Query(" SELECT DATE_FORMAT(ALUNOATIV_DATA,'%d-%m-%Y') AS DATA FROM ALUNO_ATIVIDADE
                                WHERE ALUNOATIV_TURMA = ".$this->turma_atual."
                            GROUP BY DATE_FORMAT(ALUNOATIV_DATA,'%d-%m-%Y')
                            ORDER BY ALUNOATIV_DATA DESC");
        $this->db->MoveFirst();		 
	while (!$this->db->EndOfSeek()) {
            $row =  $this->db->Row();
            $DATAS[] = $row->DATA;			
	}
        return $DATAS; 
    }
    
    // listar atividades concluidas por aluno
    public function listar_por_aluno_atividade($aluno_cdg){           
                
             $this->db->Query(" SELECT 
                    ATIVIDADE_CDG AS Atividade,
                                ATIVIDADE_NOME AS Atividade,
                                MATERIA_NOME AS Materia,
                                SUM(ALUNOATIV_ACERTOS) AS Acertos,
                                SUM(ALUNOATIV_ERROS) AS Erros,
                                ALUNOATIV_TOTALQUESTOES AS 'Nº Questões',  
                                SUM(ALUNOATIV_FINALIZADOS) AS Completou,
                                SUM(ALUNOATIV_TENTATIVAS) AS Tentativas,                                
                                MAX(DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y %H:%i')) AS 'Última vez',
                                SEC_TO_TIME(MIN(COALESCE(ALUNOATIV_TEMPO,0))) AS 'Melhor Tempo',
                                (SELECT SEC_TO_TIME(ALUNOATIV_TEMPO) FROM ALUNO_ATIVIDADE
                                    WHERE ALUNOATIV_ATIVIDADE_CDG = ATIVIDADE_CDG
                                    AND ALUNOATIV_ALUNO_CDG = ".$aluno_cdg." ORDER BY ALUNOATIV_DATA DESC LIMIT 1 ) AS 'Último Tempo',
                                SEC_TO_TIME(SUM(COALESCE(ALUNOATIV_TEMPOTOTAL,0))) AS 'Total gasto'
                                FROM ALUNO_ATIVIDADE 
                                LEFT JOIN ATIVIDADE ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
                                LEFT JOIN MATERIA ON ATIVIDADE_MATERIA = MATERIA_CDG
                                WHERE ALUNOATIV_ALUNO_CDG  =  ".$aluno_cdg."
                                GROUP BY ATIVIDADE_CDG
                                ORDER BY ATIVIDADE_ORDEM"
                                
                            );             
             return $this->db->GetHTML();                         
    }
    
    // listar atividades concluidas por aluno
    public function listar_por_aluno_data($aluno_cdg){           
                
             $this->db->Query(" SELECT 
                                ATIVIDADE_CDG as Atividade,
                                ATIVIDADE_NOME AS Nome,
                                MATERIA_NOME AS Materia,
                                ALUNOATIV_ACERTOS AS Acertos,
                                ALUNOATIV_ERROS AS Erros,
                                ALUNOATIV_TOTALQUESTOES AS Total,
                                DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y %H:%i') AS 'Data',
                                ALUNOATIV_FINALIZADOS AS Completou,
                                ALUNOATIV_TENTATIVAS AS Tentativas,
                                SEC_TO_TIME(ALUNOATIV_TEMPO) AS 'Último Tempo',
                                SEC_TO_TIME(SUM(COALESCE(ALUNOATIV_TEMPOTOTAL,0))) AS 'Total gasto'
                                FROM ALUNO_ATIVIDADE 
                                LEFT JOIN ATIVIDADE ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
                                LEFT JOIN MATERIA ON ATIVIDADE_MATERIA = MATERIA_CDG
                                WHERE ALUNOATIV_ALUNO_CDG  =  ".$aluno_cdg."
                                ORDER BY ALUNOATIV_DATA DESC "
                            );             
             return $this->db->GetHTML();                         
    }
    
    
    public function listar_resultados_por_data($atividade,$data){
             $this->db->Query(" SELECT 
                                  ALUNO_CDG,                                
                                  ALUNO_NOME as Aluno,                                                                                                        
                                  ALUNOATIV_ERROS AS Erros,                       
                                  ALUNOATIV_ACERTOS AS Acertos,
                                  ALUNOATIV_TOTALQUESTOES AS Questões,"
                                  //DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y %h:%i') AS 'Data',
                                  ."ALUNOATIV_FINALIZADOS AS Completou,
                                  ALUNOATIV_TENTATIVAS AS Tentativas,
                                  SEC_TO_TIME(ALUNOATIV_TEMPO) AS 'Último Tempo',                                  (
                                      SELECT SEC_TO_TIME(SUM(COALESCE(ALUNOATIV_TEMPOTOTAL,0)))
                                      FROM ALUNO_ATIVIDADE
                                      WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                        AND ALUNOATIV_ATIVIDADE_CDG = ATIVIDADE_CDG         
                                  ) AS 'Total gasto'                       
                                FROM ALUNO_ATIVIDADE 
                                  LEFT JOIN ATIVIDADE ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
                                  LEFT JOIN MATERIA ON ATIVIDADE_MATERIA = MATERIA_CDG
                                  LEFT JOIN ALUNO ON ALUNO_CDG = ALUNOATIV_ALUNO_CDG
                                  LEFT JOIN TURMA ON TURMA_CDG = ALUNOATIV_TURMA
                                WHERE TURMA_CDG = ".$this->turma_atual." 
                                  AND ATIVIDADE_CDG  = ".$atividade." 
                                  AND ALUNOATIV_FINALIZADOS > 0
                                  AND DATE_FORMAT(ALUNOATIV_DATA,'%d-%m-%Y') = '".$data."'
                              
                                ORDER BY ALUNOATIV_FINALIZADOS DESC, ALUNOATIV_TENTATIVAS,ALUNOATIV_ERROS ");
             return $this->getHTML(false,true,'<a href="'.ROOT_URL.'view/historico/vlistar_por_aluno.php?a=');
                
        
    } 
       // listar todos que ja concluiram essa atividades 
    public function listar_resultados($atividade){
             $this->db->Query(" SELECT 
                                  ALUNO_CDG,                                
                                  ALUNO_NOME as Aluno,                                                               
                                  SUM(ALUNOATIV_ERROS) AS Erros,                       
                                  SUM(ALUNOATIV_ACERTOS) AS Acertos,
                                  ALUNOATIV_TOTALQUESTOES AS 'Nº Questões',".
                                  //DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y %h:%i') AS 'Data',
                                 "SUM(ALUNOATIV_FINALIZADOS) AS Completou,
                                  SUM(ALUNOATIV_TENTATIVAS) AS Tentativas
                                FROM ALUNO_ATIVIDADE 
                                  LEFT JOIN ATIVIDADE ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
                                  LEFT JOIN MATERIA ON ATIVIDADE_MATERIA = MATERIA_CDG
                                  LEFT JOIN ALUNO ON ALUNO_CDG = ALUNOATIV_ALUNO_CDG
                                  LEFT JOIN TURMA ON TURMA_CDG = ALUNOATIV_TURMA
                                WHERE TURMA_CDG = ".$this->turma_atual." 
                                  AND ATIVIDADE_CDG  = ".$atividade." 
                                  AND ALUNOATIV_FINALIZADOS > 0
                                GROUP BY ALUNOATIV_ALUNO_CDG
                                ORDER BY ALUNOATIV_FINALIZADOS DESC,ALUNOATIV_ERROS, ALUNOATIV_TENTATIVAS ");
             return $this->getHTML(false,true,'<a href="'.ROOT_URL.'view/historico/vlistar_por_aluno.php?a=');
    }
 
    public function  listar_resultados_ainda_esta_tentando($atividade){
           $this->db->Query(" SELECT 
                                ALUNO_CDG,                                
                                ALUNO_NOME as Aluno,         
                                SUM(ALUNOATIV_ERROS) AS Erros,                       
                                SUM(ALUNOATIV_ACERTOS) AS Acertos,                           
                                SUM(ALUNOATIV_TOTALQUESTOES) AS 'Nº Questões',                                
                                SUM(ALUNOATIV_FINALIZADOS) AS Completou,
                                SUM(ALUNOATIV_TENTATIVAS) AS Tentativas
                              FROM ALUNO_ATIVIDADE 
                                LEFT JOIN ATIVIDADE ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
                                LEFT JOIN MATERIA ON ATIVIDADE_MATERIA = MATERIA_CDG
                                LEFT JOIN ALUNO ON ALUNO_CDG = ALUNOATIV_ALUNO_CDG
                                LEFT JOIN TURMA ON TURMA_CDG = ALUNOATIV_TURMA
                              WHERE TURMA_CDG = ".$this->turma_atual." 
                                 AND ATIVIDADE_CDG  = ".$atividade." 
                              GROUP BY ALUNOATIV_ALUNO_CDG
                                 HAVING SUM(ALUNOATIV_FINALIZADOS) = 0 
                              ORDER BY ALUNOATIV_FINALIZADOS DESC, ALUNOATIV_TENTATIVAS ");
             return $this->getHTML(false,true,'<a href="'.ROOT_URL.'view/historico/vlistar_por_aluno.php?a=');
    }
    
     public function  listar_resultados_ainda_esta_tentando_por_data($atividade,$data){
           $this->db->Query(" SELECT 
                                ALUNO_CDG,                                
                                ALUNO_NOME as Aluno,         
                                ALUNOATIV_ERROS AS Erros,                       
                                ALUNOATIV_ACERTOS AS Acertos,                                
                                ALUNOATIV_TOTALQUESTOES AS Questões,"
                                //DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y %h:%i') AS 'Data',
                                ."ALUNOATIV_FINALIZADOS AS Completou,
                                ALUNOATIV_TENTATIVAS AS Tentativas
                              FROM ALUNO_ATIVIDADE 
                                LEFT JOIN ATIVIDADE ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
                                LEFT JOIN MATERIA ON ATIVIDADE_MATERIA = MATERIA_CDG
                                LEFT JOIN ALUNO ON ALUNO_CDG = ALUNOATIV_ALUNO_CDG
                                LEFT JOIN TURMA ON TURMA_CDG = ALUNOATIV_TURMA
                              WHERE TURMA_CDG = ".$this->turma_atual." 
                                 AND ALUNOATIV_ATIVIDADE_CDG  = ".$atividade." 
                                 AND ALUNOATIV_FINALIZADOS = 0     
                                 AND DATE_FORMAT(ALUNOATIV_DATA,'%d-%m-%Y')= '".$data."'
                              ORDER BY ALUNOATIV_FINALIZADOS DESC, ALUNOATIV_TENTATIVAS ");
           return $this->getHTML(false,true,'<a href="'.ROOT_URL.'view/historico/vlistar_por_aluno.php?a=');
           
             
    }
    
    
    
    
    public function listar_atividades_por_data($turma,$data){
        $this->db->Query("SELECT ATIVIDADE_CDG, 
                                 ATIVIDADE_NOME as Atividade,
                                 MATERIA_NOME as Matéria,
                                 ATIVIDADE_NIVEL as Nível,
                                 (select ( 
                                          (SELECT COUNT(*) AS TOTAL
                                            FROM ATIVIDADE_QUESTAO 
                                          WHERE ATIVQUESTAO_ATIVIDADE =  ATIVIDADE_CDG) 
                                          + 
                                         (SELECT COUNT(*) AS TOTAL
                                           FROM ATIVIDADE_QUESTAODIGITAR 
                                          WHERE ATIVQUESTAODIGITAR_ATIVIDADE = ATIVIDADE_CDG)
                                        )
                               from ATIVIDADE A where ATIVIDADE_CDG = AT2.ATIVIDADE_CDG) AS 'Nº Questões',                                
                               (SELECT COUNT(*) 
                                    FROM ALUNO_ATIVIDADE 
                                    WHERE ALUNOATIV_ATIVIDADE_CDG = A.ALUNOATIV_ATIVIDADE_CDG 
                                    AND ALUNOATIV_FINALIZADOS > 0
                                    AND ALUNOATIV_TURMA = ".$turma."
                                    AND (date_format(ALUNOATIV_DATA,'%d-%m-%Y') = '".$data."')
                               ) AS 'Finalizado por',                               
                               date_format(ALUNOATIV_DATA,'%d-%m-%Y') as Data
                               FROM  ALUNO_ATIVIDADE A
                                 LEFT JOIN ATIVIDADE AT2 ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG 
                                 LEFT JOIN USUARIO ON ATIVIDADE_CRIADOR = USUARIO_CDG
                                 LEFT JOIN MATERIA ON MATERIA_CDG = ATIVIDADE_MATERIA
                                 WHERE date_format(ALUNOATIV_DATA,'%d-%m-%Y') = '".$data."'
                                 GROUP BY  ALUNOATIV_ATIVIDADE_CDG 
                                 ORDER BY ATIVIDADE_NIVEL, ATIVIDADE_ORDEM");
        return $this->getHTMLatividades_por_Data(false,true,'<a href="'.ROOT_URL.'view/historico/vlistar_resultados.php');
    }
    
    
    public function  listar_precisa_reforcar($aluno){
        // ja finalizou até 4 vezes, teve pelo menos um gameover, e pelo menos uma questao errada
        $this->db->Query(" SELECT ATIVIDADE_NOME AS Atividade, 
                                  ALUNOATIV_ERROS Erros, 
                                  ALUNOATIV_ACERTOS Acertos, 
                                  ALUNOATIV_FINALIZADOS Finalizou, 
                                  ALUNOATIV_TENTATIVAS Tentativas, 
                                  SEC_TO_TIME(COALESCE(ALUNOATIV_TEMPOTOTAL,0)) 'Tempo',
                                  DATE_FORMAT(ALUNOATIV_DATA,'%d/%m/%Y %H:%i') AS 'Data',                                  
                                 (
                                   select 
                                       group_concat(a.descritor ) from 
                                    ( select count(questao_cdg) cont,ativquestao_atividade atividade, descritor_codigo descritor
                                         from QUESTAO 
                                         left join ATIVIDADE_QUESTAO on ATIVQUESTAO_QUESTAO = QUESTAO_CDG
                                         left join DESCRITOR on DESCRITOR_CDG = QUESTAO_DESCRITOR
                                         where QUESTAO_DESCRITOR is not null
                                         group by ATIVQUESTAO_ATIVIDADE
                                      union 
                                      select count(questaodigitar_cdg) cont,ativquestaodigitar_atividade atividade, descritor_codigo descritor
                                         from QUESTAO_DIGITAR 
                                         left join ATIVIDADE_QUESTAODIGITAR on ATIVQUESTAODIGITAR_QUESTAO = QUESTAODIGITAR_CDG
                                         left join DESCRITOR on DESCRITOR_CDG = QUESTAODIGITAR_DESCRITOR
                                          where QUESTAODIGITAR_DESCRITOR is not null
                                          group by ATIVQUESTAODIGITAR_ATIVIDADE
                                     ) a
                                     left join ATIVIDADE a2 on a2.ATIVIDADE_CDG = a.ATIVIDADE
                                     where a.ATIVIDADE = a0.ATIVIDADE_CDG
                                     group by a.ATIVIDADE
                                  ) Descritores
                           FROM ALUNO_ATIVIDADE 
                                  LEFT JOIN ATIVIDADE a0 ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG                                                                    
                                  LEFT JOIN ATIVIDADE_QUESTAO ON ATIVQUESTAO_ATIVIDADE = ATIVIDADE_CDG                                                                                                    
                                  LEFT JOIN QUESTAO ON QUESTAO_CDG = ATIVQUESTAO_QUESTAO
                                  LEFT JOIN DESCRITOR ON DESCRITOR_CDG = QUESTAO_DESCRITOR                                  
                           WHERE ALUNOATIV_ALUNO_CDG = '.$aluno.'
                                  AND ALUNOATIV_FINALIZADOS > 0
                                  AND ALUNOATIV_FINALIZADOS < 5
                                  AND ALUNOATIV_TENTATIVAS > 0 
                                  AND ALUNOATIV_ERROS > 0
                           GROUP BY a0.ATIVIDADE_CDG  ");
       return $this->getHTML(true,false,'',"fundo-amarelo");   
    }
    
    public function listar_atividades($turma,$nivel){
        $this->db->Query(" SELECT ATIVIDADE_CDG,
                               ATIVIDADE_NOME as Nome,
                               MATERIA_NOME as Matéria,
                               (SELECT COUNT(*) FROM ATIVIDADE_QUESTAO WHERE ATIVQUESTAO_ATIVIDADE = ATIVIDADE_CDG) as Questões,
                               ATIVIDADE_DESC as Descrição,
                               CONCAT((SELECT  COUNT(DISTINCT ALUNOATIV_ALUNO_CDG) 
                                          FROM ALUNO_ATIVIDADE 
                                            WHERE ALUNOATIV_ATIVIDADE_CDG = ATIVIDADE_CDG 
                                            AND ALUNOATIV_FINALIZADOS > 0 
                                            AND ALUNOATIV_TURMA = ".$turma." ),' Alunos' )
                                            as 'Feito por'
                               FROM ATIVIDADE
                                 LEFT JOIN USUARIO ON ATIVIDADE_CRIADOR = USUARIO_CDG
                                 LEFT JOIN MATERIA ON MATERIA_CDG = ATIVIDADE_MATERIA
                               WHERE ATIVIDADE_NIVEL = ".$nivel."
                               ORDER BY ATIVIDADE_ORDEM ");
        return $this->getHTMLatividades(false,"fundo-verde",true,'<a href="'.ROOT_URL.'view/historico/vlistar_resultados.php');
    }
    
    
        public function listar_quem_nao_fez($atividade){
        $this->db->Query(" SELECT ALUNO_NOME as Aluno
                                FROM ALUNO 
                                LEFT JOIN ALUNO_ATIVIDADE ON ALUNOATIV_ALUNO_CDG = ALUNO_CDG AND ALUNOATIV_ATIVIDADE_CDG = ".$atividade."
                            WHERE ALUNO_TURMAATUAL = ".$this->turma_atual."  
                                AND ALUNO_CDG NOT IN
                           (SELECT ALUNOATIV_ALUNO_CDG FROM ALUNO_ATIVIDADE WHERE ALUNOATIV_ATIVIDADE_CDG = ".$atividade.")");
        return $this->db->getHTML(true);
    }
    
    
     public function listar_alunos($turma){
        $this->db->Query(" SELECT ALUNO_CDG,    
                                  ALUNO_NOME as Aluno ,
                                  ALUNO_PONTOS as Pontuação,
                                  (SELECT COUNT(DISTINCT(ALUNOATIV_ATIVIDADE_CDG))
                                     FROM ALUNO_ATIVIDADE 
                                     WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                     AND ALUNOATIV_FINALIZADOS > 0) 'Nº Atividades',
                                  CONCAT( FORMAT((SELECT COUNT(DISTINCT(ALUNOATIV_ATIVIDADE_CDG))
                                     FROM ALUNO_ATIVIDADE 
                                     WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                     AND ALUNOATIV_FINALIZADOS > 0) 
                                     / 
                                  (SELECT COUNT(ATIVIDADE_CDG) 
                                      FROM ATIVIDADE
                                      WHERE ATIVIDADE_MATERIA = 1
                                      AND ATIVIDADE_NIVEL IS NOT NULL) * 100 ,0),'%')                                       
                                     as '%',
                                     ALUNO_NIVEL AS Nivel,                                     
                                  DATE_FORMAT(ALUNO_ULTIMOLOGIN,'%d/%m/%Y %H:%i')as 'Último Acesso',
                                  ALUNO_ULTIMOLOCAL Computador,
                                  (SELECT sec_to_time(SUM(COALESCE(ALUNOATIV_TEMPO,0)))
                                     FROM ALUNO_ATIVIDADE WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG) AS 'Horas de Estudos'
                                  FROM ALUNO A, (SELECT @RANK := 0 ) as R
                                               WHERE ALUNO_TURMAATUAL = ".$turma
                               ." ORDER BY ALUNO_PONTOS DESC,'Nº Atividades' DESC");
                            
        return $this->getHTML(true, true, '<a href="'.ROOT_URL.'view/historico/vlistar_por_aluno.php?a=');
    }
  
    
    public function listar_ranking($turma){
        $this->db->Query(" SELECT CONCAT(@RANK  := @RANK + 1,'º') AS Posição,    
                                  ALUNO_NOME as Aluno ,
                                  ALUNO_PONTOS as Pontuação,
                                  (SELECT COUNT(DISTINCT(ALUNOATIV_ATIVIDADE_CDG))
                                     FROM ALUNO_ATIVIDADE 
                                     WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                     AND ALUNOATIV_FINALIZADOS > 0) 'Nº Atividades'
                               FROM ALUNO A, (SELECT @RANK := 0 ) as R
                                  WHERE ALUNO_TURMAATUAL = ".$turma."  
                               ORDER BY ALUNO_PONTOS DESC,'Nº Atividades' DESC");
                            
        return $this->getHTMLHanking( false,false);
    }
    
     public function listar_ranking_escola($escola = -1){
        $sql = " SELECT CONCAT(@RANK  := @RANK + 1,'º') AS Posição,    
                                  ALUNO_NOME as Aluno ,
                                  CONCAT(TURMA_SERIE,'º',TURMA_LETRA) 'Série',
                                  ALUNO_PONTOS as Pontuação,
                                  (SELECT COUNT(DISTINCT(ALUNOATIV_ATIVIDADE_CDG))
                                     FROM ALUNO_ATIVIDADE 
                                     WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                     AND ALUNOATIV_FINALIZADOS > 0) as 'Nº Atividades'                                     
                           FROM ALUNO A 
                           INNER JOIN TURMA ON TURMA_CDG = ALUNO_TURMAATUAL ";
                
               
        if($escola != -1):
            $sql .= " AND TURMA_ESCOLA = ".$escola;
        endif;
        
        $sql .= ", (SELECT @RANK := 0 ) as R                                  
                           ORDER BY ALUNO_PONTOS DESC,'Nº Atividades' DESC";
        $this->db->Query($sql);
        return $this->getHTMLHanking( false,false);
    }
    
    
      public function listar_ranking_sexo($turma,$s){
        $this->db->Query(" SELECT CONCAT(@RANK  := @RANK + 1,'º') AS Posição,    
                                  ALUNO_NOME as Aluno ,
                                  ALUNO_PONTOS as Pontuação,
                                  (SELECT COUNT(DISTINCT(ALUNOATIV_ATIVIDADE_CDG))
                                     FROM ALUNO_ATIVIDADE 
                                     WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                     AND ALUNOATIV_FINALIZADOS > 0) as 'Nº Atividades'
                           FROM ALUNO A, (SELECT @RANK := 0 ) as R
                                  WHERE ALUNO_TURMAATUAL = ".$turma."  
                                  AND ALUNO_SEXO = '".$s."'
                           ORDER BY ALUNO_PONTOS DESC,'Nº Atividades' DESC");
                            
        $classe = ($s == 'F') ? 'feminino' : '' ;
        
        return $this->getHTMLHanking(false,false,'',$classe);
    }
    
      public function listar_ranking_reforco($turma){
        $this->db->Query(" SELECT CONCAT(@RANK  := @RANK + 1,'º') AS Posição,    
                                  ALUNO_NOME as Aluno ,
                                  ALUNO_PONTOS as Pontuação,
                                  (SELECT COUNT(DISTINCT(ALUNOATIV_ATIVIDADE_CDG))
                                     FROM ALUNO_ATIVIDADE 
                                     WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                     AND ALUNOATIV_FINALIZADOS > 0) as 'Nº Atividades'
                           FROM ALUNO A, (SELECT @RANK := 0 ) as R
                                  WHERE ALUNO_TURMAATUAL = ".$turma."  
                                  AND ALUNO_STATUS = 'R'
                           ORDER BY ALUNO_PONTOS DESC,'Nº Atividades' DESC");
                            
        return $this->getHTMLHanking( false,false);
    }
    
    
             /*Select para rankear  com numeros
              SELECT CONCAT(@RANK  := @RANK + 1,'º') AS Posição,    
                                  ALUNO_NOME as Aluno ,
                                  ALUNO_PONTOS AS Pontuação,
                                  (SELECT COUNT(DISTINCT(ALUNOATIV_ATIVIDADE_CDG))
                                     FROM ALUNO_ATIVIDADE 
                                     WHERE ALUNOATIV_ALUNO_CDG = ALUNO_CDG
                                     AND ALUNOATIV_FINALIZADOS > 0) AS Atividades
                               FROM ALUNO A, (SELECT @RANK := 0 ) AS R
                                  WHERE ALUNO_TURMAATUAL = 1                               
                                  AND ALUNO_TURMAATUAL = ".$turma."  
                               ORDER BY ALUNO_PONTOS DESC,Atividades DESC");
    */
     public function getHTMLHanking($showCount = true, $SQL_com_link = true, $link = '', $classeTr = ''){                   
        	if ($this->db->last_result) {
			if ($this->db->RowCount() > 0) {
				$html = "";
				if ($showCount) $html = "Total: " . $this->db->RowCount() . "<br />\n";
				$html .= "<table  cellpadding=\"2\" cellspacing=\"2\">\n";
				$this->db->MoveFirst();
				$header = false;
                                $linha_count = 1;
				while ($member = mysqli_fetch_object($this->db->last_result)) {
                                        $coluna_count = 1;
					if (!$header) {
						$html .= "\t<tr>\n";
						foreach ($member as $key => $value) {
                                                    if((!$SQL_com_link) && ($coluna_count == 1)){
							$html .= "\t\t<td class='cabecalho_table'><strong>" . htmlspecialchars($key) . "</strong></th>\n";
                                                    }                                                    
                                                    if($coluna_count > 1){
							$html .= "\t\t<td class='cabecalho_table'><strong>" . htmlspecialchars($key) . "</strong></th>\n";
                                                    }
                                                    $coluna_count += 1;
						}
						$html .= "\t</tr>\n";
						$header = true;
                                              
					}
                                        $coluna_count = 1;
					$html .= "\t<tr class='".$classeTr."'>\n";
                                        $filtro_da_pagina = ''; 
                                        $fecha_link =  '';
                                        $fecha_tag_a = "";                                        
					foreach ($member as $key => $value) {
                                                // se for a primeira coluna e sql com link, nao mostra a primeira coluna
                                                // e grava a 1º coluna como o link das linhas seguintes
                                                if( ($coluna_count == 1) && ($SQL_com_link == true)){
                                                    $filtro_da_pagina = htmlspecialchars($value);
                                                    $fecha_link =  '">';
                                                    $fecha_tag_a = "</a>";
                                                }else{                        
                                                    //selecionando trofeus                                                    
                                                    if($linha_count == 1) 
                                                        $medalha_img =  'medalha-ouro.png';
                                                    if($linha_count == 2) 
                                                        $medalha_img =  'medalha-prata.png';
                                                    if($linha_count == 3) 
                                                        $medalha_img =  'medalha-bronze.png';
                                                    
                                                    if($coluna_count == 1 ){
                                                        
                                                        if(in_array($linha_count,array('1','2','3')))
                                                            $html .= "\t\t<td> <img width='30' class='trofe-ouro' src='".ROOT_URL."view/img/".$medalha_img."'></td>\n";    
                                                        else
                                                            $html .= "\t\t<td>".$linha_count."º</td>\n";    
                                                    }else{
                                                        //alinhar a segunda coluna para esquerda
                                                        $alinhamento = "";                                                        
                                                        if($coluna_count == 2 ){
                                                            $alinhamento = " class='texto_left' ";                                                            
                                                        }
                                                        // aumentar tamanho da fonte nas 3 primeiras linhas
                                                        if(in_array($linha_count,array('1','2','3'))) 
                                                            $html .= "\t\t<td ".$alinhamento."><span  style='font-size:20px'>".$link.$filtro_da_pagina .$fecha_link . htmlspecialchars($value) . $fecha_tag_a."</span></td>\n";
                                                        else
                                                            $html .= "\t\t<td ".$alinhamento.">".$link.$filtro_da_pagina .$fecha_link . htmlspecialchars($value) . $fecha_tag_a."</td>\n";
                                                        
                                                    }
                                                }
                                                $coluna_count += 1;
					}
					$html .= "\t</tr>\n";
                                        $linha_count += 1;
				}
				$this->db->MoveFirst();
				$html .= "</table>";
			} else {
				$html = "<BR>Nenhum registro.";
			}
		} else {
			$this->db->active_row = -1;
			$html = false;
		}
		return $html;
    }
    
    
    public function getHTMLatividades($showCount = true, $cor , $SQL_com_link = true, $link = ''){                   
        	if ($this->db->last_result) {
			if ($this->db->RowCount() > 0) {
				$html = "";
				if ($showCount) $html = "Total: " . $this->db->RowCount() . "<br />\n";
				$html .= "<table cellpadding=\"2\" cellspacing=\"2\">\n";
				$this->db->MoveFirst();				

                                // montando cabeçalho 
                                $member = mysqli_fetch_object($this->db->last_result);
                                $coluna_count = 1;					
                                $html .= "\t<tr>\n"; //".($member[8])."
                                foreach ($member as $key => $value) {   
                                    if($coluna_count == 7):
                                        break;
                                    endif; 
                                    if((!$SQL_com_link) && ($coluna_count == 1)){
					$html .= "\t\t<td class='cabecalho_table'><strong>" . htmlspecialchars($key) . "</strong></th>\n";
                                    }
                                    if($coluna_count > 1){
                                        $html .= "\t\t<td class='cabecalho_table'><strong>" . htmlspecialchars($key) . "</strong></th>\n";
                                    }
                                    $coluna_count += 1;
                                }
                                $html .= "\t</tr>\n";						
                                
                                $this->db->MoveFirst();
                                while ($member = mysqli_fetch_array($this->db->last_result,MYSQLI_NUM)) {
                                        $coluna_count = 1;
                                        //pintando de fundo verde a linha se tiver mais q 0 alunos feito a atividade
					$html .= "\t<tr class='".(substr($member[5],0,1) == '0' ? " " : $cor)."'>\n";
                                        $filtro_da_pagina = ''; 
                                        $fecha_link =  '">';
                                        $fecha_tag_a = "</a>";                                        
					foreach ($member as $key => $value) {
                                                if($coluna_count == 7):
                                                    break;
                                                endif; 
                                                // se for a primeira coluna e sql com link, nao mostra a primeira coluna
                                                // e grava a 1º coluna como o link das linhas seguintes
                                                if( ($coluna_count == 1) && ($SQL_com_link == true)){
                                                    $filtro_da_pagina = '?a='.htmlspecialchars($value);
                                                    if(isset($this->turma_atual)):
                                                        $filtro_da_pagina = $filtro_da_pagina . '&t='.$this->turma_atual; 
                                                    endif;
                                                    $fecha_link =  '">';
                                                    $fecha_tag_a = "</a>";
                                                }else{                                                    
                                                    $html .= "\t\t<td>".$link.$filtro_da_pagina.$fecha_link . htmlspecialchars($value) . $fecha_tag_a."</td>\n";
                                                }
                                                $coluna_count += 1;
					}
					$html .= "\t</tr>\n";
				}
				$this->db->MoveFirst();
				$html .= "</table>";
			} else {
				$html = "Nenhum registro.";
			}
		} else {
			$this->db->active_row = -1;
			$html = false;
		}
		return $html;
    }
    
    
    
    
        public function getHTMLatividades_por_Data($showCount = true, $SQL_com_link = true, $link = ''){                   
        	if ($this->db->last_result) {
			if ($this->db->RowCount() > 0) {
				$html = "";
				if ($showCount) $html = "Total: " . $this->db->RowCount() . "<br />\n";
				$html .= "<table cellpadding=\"2\" cellspacing=\"2\">\n";
				$this->db->MoveFirst();				

                                // montando cabeçalho 
                                $member = mysqli_fetch_object($this->db->last_result);
                                $coluna_count = 1;					
                                $html .= "\t<tr>\n"; //".($member[8])."
                                foreach ($member as $key => $value) {   
                                    if($coluna_count == 7):
                                        break;
                                    endif; 
                                    if((!$SQL_com_link) && ($coluna_count == 1)){
					$html .= "\t\t<td class='cabecalho_table'><strong>" . htmlspecialchars($key) . "</strong></th>\n";
                                    }
                                    if($coluna_count > 1){
                                        $html .= "\t\t<td class='cabecalho_table'><strong>" . htmlspecialchars($key) . "</strong></th>\n";
                                    }
                                    $coluna_count += 1;
                                }
                                $html .= "\t</tr>\n";						
                                
                                $this->db->MoveFirst();
                                while ($member = mysqli_fetch_array($this->db->last_result,MYSQLI_NUM)) {
                                        $coluna_count = 1;
                                        //pintando de fundo verde a linha se tiver mais q 0 alunos feito a atividade
					$html .= "\t<tr class='".($member[5] == '0'? " " : "fundo-verde")."'>\n";
                                        $filtro_da_pagina = ''; 
                                        $fecha_link =  '">';
                                        $fecha_tag_a = "</a>";                                        
					foreach ($member as $key => $value) {
                                                if($coluna_count == 7):
                                                    break;
                                                endif; 
                                                // se for a primeira coluna e sql com link, nao mostra a primeira coluna
                                                // e grava a 1º coluna como o link das linhas seguintes
                                                if( ($coluna_count == 1) && ($SQL_com_link == true)){
                                                    $filtro_da_pagina = '?a='.htmlspecialchars($value).'&t='.$this->turma_atual.'&d='.$member[6];
                                                    $fecha_link =  '">';
                                                    $fecha_tag_a = "</a>";
                                                }else{                                                    
                                                    $html .= "\t\t<td>".$link.$filtro_da_pagina.$fecha_link . htmlspecialchars($value) . $fecha_tag_a."</td>\n";
                                                }
                                                $coluna_count += 1;
					}
					$html .= "\t</tr>\n";
				}
				$this->db->MoveFirst();
				$html .= "</table>";
			} else {
				$html = "Nenhum registro.";
			}
		} else {
			$this->db->active_row = -1;
			$html = false;
		}
		return $html;
    }
    
    
      public function getHTML($showCount = true, $SQL_com_link = false, $abre_link = '',$cor= ''){                                 
          	if ($this->db->last_result) {
			if ($this->db->RowCount() > 0) {
				$html = "";
				if ($showCount) $html = "Total: " . $this->db->RowCount() . "<br />\n";
				$html .= "<table cellpadding=\"2\" cellspacing=\"2\">\n";
				$this->db->MoveFirst();
				$header = false;
                                // while 
				while ($member = mysqli_fetch_object($this->db->last_result)) {
                                        $coluna_count = 1;
					if (!$header) {
						$html .= "\t<tr>\n";
						foreach ($member as $key => $value) {
                                                    //se nao tiver sql com link mostrar a primeira coluna
                                                    //se nao esconde pois ela sera o codigo do link
                                                    if(($coluna_count > 1)  || 
                                                            (!$SQL_com_link)){
							$html .= "\t\t<td class='cabecalho_table'><strong>" . htmlspecialchars($key) . "</strong></th>\n";
                                                    }
                                                    $coluna_count += 1;
						}
						$html .= "\t</tr>\n";
						$header = true;
                                              
					}
                                        $coluna_count = 1;
					$html .= "\t<tr class='".$cor."'>\n";
                                        $filtro_da_pagina = ''; 
                                        if($SQL_com_link == true){
                                            $fecha_link =  '">';
                                            $fecha_tag_a = "</a>";
                                        }else{
                                            $fecha_link =  '';
                                            $fecha_tag_a = "";
                                        }
                                        
					foreach ($member as $key => $value) {
                                                // se for a primeira coluna e sql com link, nao mostra a primeira coluna
                                                // e grava a 1º coluna como o link das linhas seguintes
                                                if( ($coluna_count == 1) && ($SQL_com_link == true) ){
                                                    //pegar filtro do link que sera o primeiro campo da query
                                                     $filtro_da_pagina = htmlspecialchars($value);
                                                    //$fecha_link =  '">';
                                                    //$fecha_tag_a = "</a>";
                                                }else{                                                    
                                                    //$fecha_link =  '';
                                                    //$fecha_tag_a = "";
                                                    $html .= "\t\t<td>".$abre_link.$filtro_da_pagina .$fecha_link . htmlspecialchars($value) . $fecha_tag_a."</td>\n";
                                                }
                                                $coluna_count += 1;
					}
					$html .= "\t</tr>\n";
				}
				$this->db->MoveFirst();
				$html .= "</table>";
			} else {
				$html = "Nenhum registro.";
			}
		} else {
			$this->db->active_row = -1;
			$html = false;
		}
		return $html;	
    }

}

