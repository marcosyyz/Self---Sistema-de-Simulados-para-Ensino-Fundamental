<?php      
require_once('../../config.php');
require_once(ROOT.'model/db_classe.php');

                      
// Get all parameters provided by the javascript
$colname = (strip_tags($_POST['colname']));
$id = (strip_tags($_POST['id']));
$campoid = (strip_tags($_POST['campoid']));
$coltype =(strip_tags($_POST['coltype']));
$value =(strip_tags($_POST['newvalue']));
$tablename = (strip_tags($_POST['tablename']));


// Here, this is a little tips to manage date format before update the table
if ($coltype == 'date') {
   if ($value === "") 
  	 $value = NULL;
   else {       
      $date_info = date_parse_from_format('d/m/Y', $value);
      $value = "{$date_info['year']}-{$date_info['month']}-{$date_info['day']}";
   }
}                      

// This very generic. So this script can be used to update several tables.
$return = false;         

$sql = 'UPDATE '.$tablename.' SET '.$colname.' = "'.$value.'" WHERE '.$campoid.' = '.$id;
//$System->log($sql);
$atualizou  = $System->executarSQL($sql);

$return = ($atualizou > 0 );

echo $return ? "ok" : "error";


      
