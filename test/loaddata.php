<?php     


/*
 * examples/mysql/loaddata.php
 * 
 * This file is part of EditableGrid.
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
                              


/**
 * This script loads data from the database and returns it to the js
 *
 */
       
require_once('config.php');      
require_once('EditableGrid.php');            

/**
 * fetch_pairs is a simple method that transforms a mysqli_result object in an array.
 * It will be used to generate possible values for some columns.
*/
function fetch_pairs($mysqli,$query){
	if (!($res = $mysqli->query($query)))return FALSE;
	$rows = array();
	while ($row = $res->fetch_assoc()) {
		$first = true;
		$key = $value = null;
		foreach ($row as $val) {
			if ($first) { $key = $val; $first = false; }
			else { $value = $val; break; } 
		}
		$rows[$key] = $value;
	}
	return $rows;
}


// Database connection
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 
                    
// create a new EditableGrid object
$grid = new EditableGrid();

/* 
*  Add columns. The first argument of addColumn is the name of the field in the databse. 
*  The second argument is the label that will be displayed in the header
*/
$grid->addColumn('ALUNOATIV_ALUNO_CDG', 'Aluno', 'integer', NULL, false); 
$grid->addColumn('ATIVIDADE_NOME', 'Atividade', 'string');  
$grid->addColumn('ALUNOATIV_ACERTOS', 'Acertos', 'integer');  
$grid->addColumn('ALUNOATIV_ERROS', 'Erros', 'integer');  

//$grid->addColumn('firstname', 'Firstname', 'string');  
//$grid->addColumn('age', 'Age', 'integer');  
//$grid->addColumn('height', 'Height', 'float');  
/* The column id_country and id_continent will show a list of all available countries and continents. So, we select all rows from the tables */
$grid->addColumn('ALUNO_NOME', 'ALUNO', 'string' , fetch_pairs($mysqli,'SELECT ALUNO_CDG, ALUNO_NOME FROM ALUNO'),true);  
$grid->addColumn('TURMA', 'Turma', 'STRING',NULL,false);  
//$grid->addColumn('id_continent', 'Continent', 'string' , fetch_pairs($mysqli,'SELECT id, name FROM continent'),true);  
//$grid->addColumn('id_country', 'Country', 'string', fetch_pairs($mysqli,'SELECT id, name FROM country'),true );  
//$grid->addColumn('email', 'Email', 'email');                                               
//$grid->addColumn('freelance', 'Freelance', 'boolean');  
//$grid->addColumn('lastvisit', 'Lastvisit', 'date');  
//$grid->addColumn('website', 'Website', 'string');  
//$grid->addColumn('action', 'Action', 'html', NULL, false, 'id');  

$mydb_tablename = (isset($_GET['db_tablename'])) ? stripslashes($_GET['db_tablename']) : 'aluno_atividade';
                                                                       
$result = $mysqli->query("SELECT AA.*,AL.*, AT.*,
         CONCAT(TURMA_SERIE,'º',TURMA_LETRA) AS TURMA FROM 
         ALUNO_ATIVIDADE AA LEFT JOIN ALUNO AL ON ALUNO_CDG = ALUNOATIV_ALUNO_CDG 
         LEFT JOIN ATIVIDADE AT ON ATIVIDADE_CDG = ALUNOATIV_ATIVIDADE_CDG
         left join turma on turma_Cdg = alunoativ_turma
         ");
$mysqli->close();

// send data to the browser
$grid->renderJSON($result);

