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

        $consult = "SELECT ud.id_eudatos,"//0
                . "us.id_eusuario,"//1
                . "us.cuenta,"//2
                . "ud.responsable,"//3
                . "ud.ipsync,"//4
                . "ud.ultimo_registro,"//5
                . "ud.ultima_ip,"//6
                . "(SELECT COUNT(d.id_dir) "
                . "FROM eudatos AS ud "
                . "INNER JOIN directorios AS d ON ud.id_eudatos = d.id_eudatos "
                . "WHERE ud.id_eudatos = $idEudatos) "//7
                . "FROM eudatos AS ud "
                . "INNER JOIN eusuarios AS us ON ud.id_eusuario = us.id_eusuario "
                . "WHERE ud.id_eudatos = $idEudatos;";

        return ConnectionDB::consult(new HostData(), $consult);
        
    }

    public static function getDirectorios($idEudatos) {

        $consult = "SELECT d.id_dir,"//0
                . "d.directorio "//1
                . "FROM eudatos AS ud "
                . "INNER JOIN directorios AS d ON ud.id_eudatos = d.id_eudatos "
                . "WHERE ud.id_eudatos = $idEudatos;";

        return ConnectionDB::consult(new HostData(), $consult);
    }

}
?>

