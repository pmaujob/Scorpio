<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot . '/Libraries/ConvertFormats.php';

class DataFiles {

    private $area = null;
    private $responsable = null;
    private $ipsync = null;
    private $account = null;
    private $directory = null;
    private $lastRecord = null;
    private $hash = null;
    private $lastIp = null;
    private $dirConf = null;
    private $directories = array();
    private $directoriesJson = null;
    private $findInfo = false;
    private $findDirConf = false;
    private $findUsed = false;

    public function getArea() {
        return $this->area;
    }

    public function getResponsable() {
        return $this->responsable;
    }

    public function getIpsync() {
        return $this->ipsync;
    }

    public function getAccount() {
        return $this->account;
    }

    public function getDirectory() {
        return $this->directory;
    }

    public function getLastRecord() {
        return $this->lastRecord;
    }

    public function getHash() {
        return $this->hash;
    }

    public function getDirConf() {
        return $this->dirConf;
    }

    public function getDirectories() {
        return $this->directories;
    }

    public function getDirectoriesJson() {
        return $this->directoriesJson;
    }

    public function getLastIp() {
        return $this->lastIp;
    }

    public function getFindInfo() {
        return $this->findInfo;
    }

    public function getFindDirConf() {
        return $this->findDirConf;
    }

    public function getFindUsed() {
        return $this->findUsed;
    }

    private function setArea($area) {
        $this->area = $area;
    }

    private function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    private function setIpsync($ipsync) {
        $this->ipsync = $ipsync;
    }

    private function setAccount($account) {
        $this->account = $account;
    }

    private function setDirectory($directory) {
        $this->directory = $directory;
    }

    private function setLastRecord($lastRecord) {
        $this->lastRecord = $lastRecord;
    }

    private function setHash($hash) {
        $this->hash = $hash;
    }

    private function setLastIp($lastIp) {
        $this->lastIp = $lastIp;
    }

    private function setDirConf($dirConf) {
        $this->dirConf = $dirConf;
    }

    public function setDirectories($directories) {
        $this->directories = $directories;
    }

    public function setDirectoriesJson($directoriesJson) {
        $this->directoriesJson = $directoriesJson;
    }

    private function setFindInfo($findInfo) {
        $this->findInfo = $findInfo;
    }

    private function setFindDirConf($findDirConf) {
        $this->findDirConf = $findDirConf;
    }

    private function setFindUsed($findUsed) {
        $this->findUsed = $findUsed;
    }

    private function getDirectoriesToJson() {

        $dirs = array();
        foreach ($this->getDirectories() as $row) {
            $aux = array("Size" => $row[0], "Directory" => $row[1]);
            $dirs[] = $aux;
        }

        $directoriesJson = ConvertFormats::convertToJsonItems($dirs);

        return $directoriesJson;
    }

    public function setData($user) {

        $dirInfo = $user . "-info.txt";
        $dirConf = $user . "-dirsconf.txt";
        $dirUsed = $user . "-used.txt";

        if (file_exists($dirInfo))
            $this->setFindInfo(true);
        if (file_exists($dirConf))
            $this->setFindDirConf(true);
        if (file_exists($dirUsed))
            $this->setFindUsed(true);

        try {

            if ($this->getFindInfo()) {

                $file = fopen($dirInfo, "r");

                if ($file) {

                    while (!feof($file)) {

                        $strFull = fgets($file);
                        $search = "AREA";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false && !empty($strFull)) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setArea((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }

                        $search = "RESPONSABLE";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setResponsable((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }

                        $search = "ipsync";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setResponsable((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }

                        $search = "cuenta";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setAccount((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }

                        $search = "home";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setDirectory((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }

                        $search = "ultimoreg";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setLastRecord((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }

                        $search = "hash";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setHash((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }

                        $search = "ultimaip";
                        $resRow = strpos($strFull, $search);

                        if ($resRow !== false) {
                            $strFinal = str_replace('=', '', stristr($strFull, '=', false));
                            $this->setLastIp((strlen(trim($strFinal)) !== 0) ? $strFinal : null);
                        }
                    }

                    fclose($file);

                    if ($this->getFindUsed()) {

                        $fileUsed = fopen($dirUsed, "r");

                        if ($fileUsed) {

                            $rowsUsed = array();
                            $charsToReplace = array("\n");

                            while (!feof($fileUsed)) {

                                $str = fgets($fileUsed);

                                if (strlen(trim($str)) > 0 && !strpos($str, "total")) {
                                    $aux = array(stristr($str, '/', true), str_replace($charsToReplace, '', stristr($str, '/', false)));
                                    $rowsUsed[] = $aux;
                                }
                            }

                            $this->setDirectories($rowsUsed);
                            $this->setDirectoriesJson($this->getDirectoriesToJson());
                        } else {
                            $this->setDirectoriesJson(null);
                        }

                        fclose($fileUsed);
                    }

                    if ($this->getFindDirConf()) {

                        $fileConf = fopen($dirConf, "r");

                        if ($fileConf) {

                            $str = fgets($fileConf);

                            $this->setDirConf($str);
                        }
                    }

                    return $this->getArea();
                } else {
                    return "NOOPEN";
                }
            } else {
                return "NOHAVE";
            }
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

}
