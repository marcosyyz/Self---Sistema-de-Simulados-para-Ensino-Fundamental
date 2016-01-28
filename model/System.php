<?php
include_once ROOT.'model/db_classe.php';


class System extends Classe{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function log($texto) {
        $this->db->Query(" INSERT INTO SELF_FEED(FEED_TEXTO) VALUES('".$texto."')");
    }
    
    public function executarSQL($sql) {
        return $this->db->Query($sql);
    }
    
}

