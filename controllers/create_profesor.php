<?php

include('../config/conexion.php');
include('../config/variables.php');

$idPaq = $_POST['inputPaq'];
$name = $_POST['inputName'];
$user = $_POST['inputMail'];
$pass = $_POST['inputPass'];
$cel = (isset($_POST['inputCel'])) ? $_POST['inputCel'] : "";
$mail = $_POST['inputMail'];

$cadErr = '';
$ban = false;

//Obtenemos número de registros
$sqlGetNumProfs = "SELECT id FROM $tProf ";
$resGetNumProfs = $con->query($sqlGetNumProfs);
$getNumProfs = $resGetNumProfs->num_rows;
$clave = strtolower($user) . ($getNumProfs + 1);

//Buscamos si ya existe el usuario
$sqlSearchUser = "SELECT id FROM $tProf WHERE user = '$user' ";
$resSearchUser = $con->query($sqlSearchUser);
if ($resSearchUser->num_rows > 0) {
    $cadErr = 'Error: El correo ya existe.';
    $ban = false;
} else {//Si no existe
    $sqlInsertInfo = "INSERT INTO $tInfo (celular, correo, foto_perfil, creado, actualizado) "
            . "VALUES ('$cel', '$mail', '$fotoPerfil', '$dateNow', '$dateNow') ";
    if ($con->query($sqlInsertInfo) === TRUE) {
        $idInfo = $con->insert_id;
        $sqlInsertUser = "INSERT INTO $tProf "
                . "(nombre, user, pass, clave, informacion_id, creado, actualizado, activo, paquete_id) "
                . "VALUES ('$name', '$user', '$pass', '$clave', '$idInfo', '$dateNow', '$dateNow', '1', '$idPaq') ";
        if ($con->query($sqlInsertUser) === TRUE) {
            $ban = true;
        } else {
            $ban = false;
            $cadErr .= 'Error al crear nuevo profesor<br>' . $con->error;
        }
    } else {
        $ban = false;
        $cadErr .= 'Error al insertar información.<br>' . $con->error;
    }
}


//$ban = true;
if ($ban) {
    $cadErr = 'Éxito, tu usuario ha sido creado con éxito.';
    echo json_encode(array("error" => 0, "msgErr" => $cadErr));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $cadErr));
}
?>