<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot . '/Libraries/ConnectionDB.php';
require_once $pRoot . '/Libraries/HostData.php';

class MGetLastRecords{
        
    public static function getUsers($searchValue) {

        $consult = 'select iddat, idusu, res, des from get_usuarios('.$searchValue.') as ("iddat" integer, "idusu" integer, "res" varchar, "des" varchar);';

        return ConnectionDB::consult(new HostData(), $consult);
        
    }
    
}

?>

