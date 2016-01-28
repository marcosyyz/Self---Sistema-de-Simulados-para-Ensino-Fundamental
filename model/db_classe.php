<?php
include_once "mysql.php";

class Classe{
  
  protected $db;      // conexao com o banco
  public $ThrowExceptions = false;
  
  function __construct(){        
         $this->db = new Mysql();
         
  }
    
    
    
}
