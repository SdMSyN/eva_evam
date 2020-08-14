<?php

include ('../config/conexion.php');
include ('../config/variables.php');

$query = $_REQUEST['query'];
$idGrupo = $_GET['idGrupo'];
$idProf = $_GET['idProf'];

$sqlGetStudent = "SELECT $tAlum.id, $tAlum.nombre as nameStudent "
        . "FROM $tAlum "
        . "WHERE ($tAlum.nombre LIKE '%{$query}%' OR $tAlum.user LIKE '%{$query}%' ) "
        . " AND profesor_id = '$idProf' ";


$resGetStudent = $con->query($sqlGetStudent);
$array = array();
if ($resGetStudent->num_rows > 0) {
    while ($rowGetStudent = $resGetStudent->fetch_assoc()) {
        $array[] = $rowGetStudent['id'].' - '.$rowGetStudent['nameStudent'];
    }
} else {
    $array[0] = "";
}
echo json_encode($array);
?>
