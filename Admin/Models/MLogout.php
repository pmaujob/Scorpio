<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot.'/libraries/ConnectionDB.php';

class MLogout {
    
    public static function logOut($idLog){
        
        $consult = 'select from seguridad.logs_logout('.$idLog.');';
        
        ConnectionDB::consult(new HostData(), $consult);
        
    }
    
}

?>
