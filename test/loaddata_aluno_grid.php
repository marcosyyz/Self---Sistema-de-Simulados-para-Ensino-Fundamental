<?php      
     
require_once('../config.php');      
require_once(ROOT.'model/EditableGrid.php');
require_once(ROOT.'model/admin/admin_aluno.php');
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

                    
// create a new EditableGrid object
$grid = new EditableGrid();

/* 
*  Add columns. The first argument of addColumn is the name of the field in the databse. 
*  The second argument is the label that will be displayed in the header
*/
$grid->addColumn('ALUNO_CDG', 'Cdg', 'integer', NULL, false); 
$grid->addColumn('ALUNO_NOME', 'Nome', 'string');  
$grid->addColumn('ALUNO_PONTOS', 'Pontos', 'integer');  
$grid->addColumn('ALUNO_DTNASC', 'Nascimento', 'date',NULL,true,'nasc');  

//$grid->addColumn('firstname', 'Firstname', 'string');  
//$grid->addColumn('age', 'Age', 'integer');  
//$grid->addColumn('height', 'Height', 'float');  
/* The column id_country and id_continent will show a list of all available countries and continents. So, we select all rows from the tables */
//$grid->addColumn('ALUNO_NOME', 'ALUNO', 'string' , fetch_pairs($mysqli,'SELECT ALUNO_CDG, ALUNO_NOME FROM ALUNO'),true);  
//$grid->addColumn('TURMA', 'Turma', 'STRING',NULL,false);  
//$grid->addColumn('id_continent', 'Continent', 'string' , fetch_pairs($mysqli,'SELECT id, name FROM continent'),true);  
//$grid->addColumn('id_country', 'Country', 'string', fetch_pairs($mysqli,'SELECT id, name FROM country'),true );  
//$grid->addColumn('email', 'Email', 'email');                                               
$grid->addColumn('ALUNO_LOGADO', 'Freelance', 'boolean');  
//$grid->addColumn('lastvisit', 'Lastvisit', 'date');  
//$grid->addColumn('website', 'Website', 'string');  
$grid->addColumn('action', 'Ações', 'html', NULL, false, 'id');  


$Aluno = New Admin_Aluno();
$result = $Aluno->resultset_alunos($_SESSION['ESCOLA'], -1, '');

$grid->renderJSON($result);

