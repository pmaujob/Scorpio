<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot . '/MlBackups/Class/FileManagement/DataFiles.php';
require_once $pRoot . '/MlBackups/Models/FileManagement/MLoadDataFiles.php';

class CLoadDataFiles {

    private $users = array();

    private function getUsers() {
        return $this->users;
    }

    public function setDataFilePasswd() {

        try {

            $file = fopen("passwd", "r") or exit("Unable to open file!");

            while (!feof($file)) {

                $search = "bk";
                $str = fgets($file);
                $resRow = strpos($str, $search);

                if ($resRow !== false) {
                    if (stristr($str, ':', true) !== 'adminbk') {
                        $this->users[] = stristr($str, ':', true);
                    }
                }
            }

            fclose($file);
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    public function recordData($area, $responsable, $ip, $account, $dir, $lastRecord, $hash, $lastIp, $directories, $deviceDirectorie, $findInfo, $findDirConf, $findUsed) {

        echo MLoadDataFiles::loadDataFiles($area == null ? "'null'" : "'".$area."'", $responsable == null ? "'null'" : "'".$responsable."'", $ip == null ? "'null'" : "'".$ip."'", "'".$account."'", $dir == null ? "'null'" : "'".$dir."'", $lastRecord == null ? "'null'" : "'".$lastRecord."'", $hash == null ? "'null'" : "'".$hash."'", $lastIp == null ? "'null'" : "'".$lastIp."'", $directories == null ? "'null'" : $directories, $deviceDirectorie == null ? "'null'" : "'".$deviceDirectorie."'" , $findInfo == null ? "'null'" : "'true'", $findDirConf == null ? "'null'" : "'true'", $findUsed == null ? "'null'" : "'true'");

        echo "<br>";
        echo (int) $findInfo . "info<br>";
        echo (int) $findDirConf . "dir<br>";
        echo (int) $findUsed . "used<br>";
        echo var_dump($area) . "_1<br>";
        echo var_dump($responsable) . "_2<br>";
        echo var_dump($ip) . "_3<br>";
        echo var_dump($account) . "_4<br>";
        echo var_dump($dir) . "_5<br>";
        echo var_dump($lastRecord) . "_6<br>";
        echo var_dump($hash) . "_7<br>";
        echo var_dump($lastIp) . "_8<br>"; //findinfo
        echo var_dump($directories) . "_9<br>"; //findused
        echo var_dump($deviceDirectorie) . "_10<br><br><hr><br>"; //finddirconf
    }

    public function nextData() {

        foreach ($this->getUsers() as $row) {

            $dataFiles = new DataFiles();
            $dataFiles->setData($row);

            $this->recordData($dataFiles->getArea(), $dataFiles->getResponsable(), $dataFiles->getIpsync(), $row, $dataFiles->getDirectory(), $dataFiles->getLastRecord(), $dataFiles->getHash(), $dataFiles->getLastIp(), $dataFiles->getDirectoriesJson(), $dataFiles->getDirConf(), $dataFiles->getFindInfo(), $dataFiles->getFindDirConf(), $dataFiles->getFindUsed());
        }
    }

}

$loadDataFiles = new CLoadDataFiles();
$loadDataFiles->setDataFilePasswd();
$loadDataFiles->nextData();
?>
