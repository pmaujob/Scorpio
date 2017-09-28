<?php

require_once '../../Libraries/ConvertFormats.php';
require_once '../../Libraries/ConnectionDB.php';

class SaveListInfo {

    public static function saveList($listName, $listTipo, $jsonItems) {

        $sql = "select from aciweb.insertar_lista('" . $listName . "'," . $listTipo . "," . $jsonItems . ");";

        $con = new ConnectionDB();
        return $con->afect(ConnectionDB::$MNG_PG, $sql);
    }

}

$listName = $_POST['listName'];
$listTipo = $_POST['listTipo'];
$itemArray = array();
$itemArray = $_POST['itemArray'];

$arrayNew = array();
foreach ($itemArray as $item) {
    $newItem = array("des" => $item[1]);
    $arrayNew[] = $newItem;
}

echo SaveListInfo::saveList($listName, $listTipo, ConvertFormats::convertToJsonItems($arrayNew));
?>

