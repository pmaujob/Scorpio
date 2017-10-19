<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot . '/Libraries/ConnectionDB.php';
require_once $pRoot . '/Libraries/HostData.php';

class MConsultUsers {

    public static function getUsers($searchValue) {

        $consult = 'select iddat, idusu, res, des from get_usuarios('.$searchValue.') as ("iddat" integer, "idusu" integer, "res" varchar, "des" varchar);';

        return ConnectionDB::consult(new HostData(), $consult);
        
    }

    public static function getEeudatos($idEudatos) {

        $consult = 'select iddat, ideusu, cuenta, res, ips, ureg, uip, cont from get_eudatos('.$idEudatos.') as ("iddat" integer, "ideusu" integer, "cuenta" varchar, "res" varchar, "ips" varchar, "ureg" varchar, "uip" varchar, "cont" integer);';

        return ConnectionDB::consult(new HostData(), $consult);
        
    }

    public static function getDirectorios($idEudatos) {

        $consult = 'select dir, des from get_directorios('.$idEudatos.') as ("dir" integer, "des" varchar);';

        return ConnectionDB::consult(new HostData(), $consult);
    }

}
?>

