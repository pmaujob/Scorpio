<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot . '/Libraries/ConnectionDB.php';
require_once $pRoot . '/Libraries/HostData.php';

class MLoadDataFiles {

    public static function loadDataFiles($area, $responsable, $ip, $account, $dir, $lastRecord, $hash, $lastIp, $directories, $deviceDirectorie, $findInfo, $findDirConf, $findUsed) {

        $consult = "select from ing_datos_usuarios($area, $responsable, $ip, $account, $dir, $lastRecord, $hash, $lastIp, $directories, $deviceDirectorie, $findInfo, $findDirConf, $findUsed);";

        return $consult;//ConnectionDB::afect(new HostData(), $consult);
        
    }

}
?>

