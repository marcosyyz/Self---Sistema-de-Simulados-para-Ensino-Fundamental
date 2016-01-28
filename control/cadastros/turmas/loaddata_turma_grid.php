<?php      
     
require_once('../../../config.php');      
require_once(ROOT.'model/EditableGrid.php');
require_once(ROOT.'model/admin/turma.php');
/**
 * fetch_pairs is a simple method that transforms a mysqli_result object in an array.
 * It will be used to generate possible values for some columns.
*/



function fetch_pairs($System,$query){
	if (!($res = $System->executarSql($query)))return FALSE;
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
$grid->addColumn('id', 'Cdg', 'integer', NULL, false); 
$grid->addColumn('TURMA_NOME', 'Série', 'string');  
$grid->addColumn('TURMA_ANO', 'Ano', 'string');  
//$grid->addColumn('firstname', 'Firstname', 'string');  
//$grid->addColumn('age', 'Age', 'integer');  
//$grid->addColumn('height', 'Height', 'float');  
/* The column id_country and id_continent will show a list of all available countries and continents. So, we select all rows from the tables */
$grid->addColumn('TURMA_PROF', 'Prof.', 'string' , fetch_pairs($System,'SELECT USUARIO_CDG,USUARIO_NOME '
                                                                      . ' FROM USUARIO '
                                                                      . ' LEFT JOIN USUARIO_ESCOLA ON USUARIOESCOLA_USUARIO = USUARIO_CDG '
                                                                      . ' WHERE USUARIOESCOLA_ESCOLA = '.$_SESSION['ESCOLA']),true);  
//$grid->addColumn('TURMA', 'Turma', 'STRING',NULL,false);  
//$grid->addColumn('id_continent', 'Continent', 'string' , fetch_pairs($mysqli,'SELECT id, name FROM continent'),true);  
//$grid->addColumn('id_country', 'Country', 'string', fetch_pairs($mysqli,'SELECT id, name FROM country'),true );  
//$grid->addColumn('lastvisit', 'Lastvisit', 'date');  
//$grid->addColumn('website', 'Website', 'string');  
$grid->addColumn('action', 'Ações', 'html', NULL, false, 'id'); 


$Turma = New Turma();
$result = $Turma->resultset_turmas($_SESSION['ESCOLA']);

$grid->renderJSON($result);

