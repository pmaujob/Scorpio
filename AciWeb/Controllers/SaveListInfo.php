<?php

require_once '../Libraries/ConvertFormats.php';
require_once '../Libraries/ConnectionDB.php';

class SaveListInfo {

    public static function saveList($listName, $jsonItems) {

        $sql = "select from aciweb.insertar_lista('" . $listName . "'," . $jsonItems . ");";

        $con = new ConnectionDB();
        return $con->afect(ConnectionDB::$MNG_PG, $sql);
    }

}

$listName = $_POST['listName'];
$itemArray = array();
$itemArray = $_POST['itemArray'];

$arrayNew = array();
foreach ($itemArray as $item) {
    $newItem = array("des" => $item[1], "idTipo" => $item[2]);
    $arrayNew[] = $newItem;
}

echo SaveListInfo::saveList($listName,ConvertFormats::convertToJsonItems($arrayNew));

?>

