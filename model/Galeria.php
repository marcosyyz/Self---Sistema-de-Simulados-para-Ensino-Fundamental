<?php


Class Galeria {
    
    private static $total = 0 ;
    private static $diratual= '';
    
    public function getDirAtual(){
        return self::$diratual;
    }        
    public function setDirAtual($param){
        self::$diratual = $param;
    }
    
    public function getTotal(){
        return self::$total;
    }
    
    public function incTotal(){
        self::setTotal(self::getTotal()+1);
    }
    
    public function setTotal($param){
        self::$total = $param;
    }
    
    
    
public static function diretorio_acima($caminho){
    $caminho = strrev($caminho) ;    
    $indice = strpos($caminho,'\\', 1);
    $caminho = substr($caminho, $indice);
    return  strrev($caminho);
}    
    
public static function busca_arquivos_recursivo($palavra_chave,$diretorio){
    $root_invertido = str_replace('/','\\',ROOT);
    $caminho = '';
    self::setTotal(0);
    self::setDirAtual($diretorio);
    $mostrar_tudo = $palavra_chave == '';
    $arquivos = array();
    $iterator = new RecursiveDirectoryIterator($diretorio);
    $recursiveIterator = new RecursiveIteratorIterator($iterator);
    foreach ( $recursiveIterator as $arquivo ) {
        // se nao for .. ou .
        if(!in_array(trim($arquivo->getFilename()),['..','.'])){
            // localizar palavra de busca        
            if(!$mostrar_tudo){
                $pos = strpos($arquivo->getFilename(), $palavra_chave);
                if($pos !== false){
                  //retirar caminho de root caso esteja invertido a barra  
                 $caminho = str_replace( $root_invertido ,'', $arquivo->getPathname());
                 //depois retirar caminho de root normal
                 $arquivos[] = array("file" => $arquivo->getFilename(), 
                                "path" => str_replace( ROOT ,'', $caminho));
                 self::incTotal();
                }
            }else{
                $caminho = str_replace( $root_invertido ,'', $arquivo->getPathname());
                 $arquivos[] = array("file" => $arquivo->getFilename(), 
                                "path" => str_replace( ROOT ,'', $caminho));
                 self::incTotal();
            }            
             
        }            
    }
    return $arquivos;
}



public static function lista_arquivos($dir){
    $root_invertido = str_replace('/','\\',ROOT);
    self::setDirAtual($dir);
    $diretorio = dir($dir);
    while($arquivo = $diretorio -> read()){
        if(!in_array(trim($arquivo),['..','.'])){
            if(!is_dir($dir.$arquivo)){
                $caminho = str_replace( $root_invertido ,'', $diretorio->path);
                $caminho = str_replace( ROOT ,'', $caminho);
                $caminho = str_replace( '\\' ,'/', $caminho).'/';
                $arquivos[] = array("file" => $arquivo, 
                                "path" => $caminho );
            }
        }
            
    } 
    $diretorio -> close(); 
    return $arquivos;
}

public static function lista_diretorios($dir){    
    $retorno = array();    
    $d = dir($dir); 
    self::setDirAtual($dir);
    
    while($arquivo = $d -> read()){
        if(!in_array(trim($arquivo),['..','.']))
            if(is_dir($dir.$arquivo))
                $retorno[] = $dir.$arquivo;
    }
    $d -> close();
    return $retorno;
}

}