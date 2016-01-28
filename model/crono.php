<?php
Class Crono{
    
    static public function setInicio($horario){        
        $_SESSION['HORARIO_INICIO'] = $horario;                
    }
    
    static public function setFim($horario){
        $_SESSION['HORARIO_FIM'] = $horario;
    }
    
    
    static public function calcular_segundos_gasto(){
        if((isset($_SESSION['HORARIO_FIM'])) && (isset($_SESSION['HORARIO_INICIO']))){                    
            return  strtotime($_SESSION['HORARIO_FIM']) - strtotime($_SESSION['HORARIO_INICIO']);
        }else{
            return '-2';
        }
    }

    static public function tempo_gasto(){
        return gmdate("H:i:s", Crono::calcular_segundos_gasto());
    }
}

