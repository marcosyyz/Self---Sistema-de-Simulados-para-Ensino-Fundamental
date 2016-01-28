<?php

class Ad
{  

  protected $host    = "localhost"; // server name
  protected $user    = "root";          // user name
  protected $pass    = "";          // password
  protected $dbname  = "aluno_teste";          // database name
  protected $charset = "utf8";   
	
  public function __construct()
  {  
  }

  # FUNCTIONS TO RETRIEVE INFO
  public function getHost()
  {    
    return $this->host;
  }
  
  public function getUser()
  {    
    return $this->user;
  }
  
    public function getPass()
  {    
    return $this->pass;
  }
  
    public function getDBname()
  {    
    return $this->dbname;
  }
    public function getCharset()
  {    
    return $this->charset;
  }


public function __destruct() {
		
	}

	
}
?>