<?php
include("Mysql.php");

echo "<hr>";

try{

 $filter["ALUNO_NOME"] = MySQL::SQLValue('%');
 
 $db = new MySQL();
 
 if (!$db )
   echo " bd não instanciado! <br><br>";
 else
  echo " bd instanciado.<br><br>";
   
 $db->SelectRows("ALUNO"); 
 
 
 if ($db->RowCount() > 0 ){
   echo "Conectado.<br><br><hr>";
 }
 
 
 
 echo "<br>Tabela: aluno <p>";
 echo $db->GetHTML();
 echo '<br><br>';
  $db->Close();
 
} catch (Exception $e) {
     echo "Erro: ",  $e->getMessage(), "\n";
}

echo "<hr>";
 try{
 //$filter["ALUNO_NOME"] = MySQL::SQLValue('%');
//exibir tabela MATERIA
 echo "Tabela: materia <p>";
 
 $db->SelectRows("MATERIA");
 echo $db->GetHTML();
 echo '<br><br>';
 $db->Close();

} catch (Exception $e) {
  echo "Erro: ",  $e->getMessage(), "\n";
}


echo "<hr>";
 try{
 echo "Tabela: materia <p>";
 
 $db->SelectRows("USUARIO");
 echo $db->GetHTML();
 echo '<br><br>';
 $db->Close();

} catch (Exception $e) {
  echo "Erro: ",  $e->getMessage(), "\n";
}


echo "<hr>";
 try{
 echo "Tabela: materia <p>";
 
 $db->SelectRows("ATIVIDADE");
 echo $db->GetHTML();
 $db->Close();
 echo '<br><br>';

} catch (Exception $e) {
  echo "Erro: ",  $e->getMessage(), "\n";
}




echo "<hr>";
 try{
 echo "Tabela: materia <p>";
 
 $db->SelectRows("ATIVIDADE_QUESTAO");
 echo $db->GetHTML();
 echo '<br><br>';
 $db->Close();

} catch (Exception $e) {
  echo "Erro: ",  $e->getMessage(), "\n";
}


echo "<hr>";
 try{
 echo "Tabela: materia <p>";
 
 $db->SelectRows("QUESTAO");
 echo $db->GetHTML();
 echo '<br><br>';
 $db->Close();

} catch (Exception $e) {
  echo "Erro: ",  $e->getMessage(), "\n";
}