<?php

@session_start();
$pRoot = $_SESSION['pRoot'];

require_once '../../Libraries/ConnectionDB.php';

$consult = "SELECT id_litipo, descripcion FROM aciweb.lista_tipo;";

$resTipos = new ConnectionDB();
echo parseToJson($resTipos->consult(ConnectionDB::$MNG_PG, $consult));

function parseToJson($res) {

    $array = array();
    foreach ($res as $row) {
        $object = array("id" => $row[0], "des" => $row[1]);
        
        $array[] = $object;
    }
    
    return json_encode($array);
}
?>

