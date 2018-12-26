<?php

session_start();
include ('../config/conexion.php');
$user = $_POST['inputUser'];
$pass = $_POST['inputPass'];

$cadErr = '';
$ban = false;
$perfil = 0;

/*Lo buscamos en la tabla profesores */
$sqlGetUser = "SELECT $tProf.id as id, $tProf.informacion_id as idInfo, "
        . "$tProf.nombre as name, $tProf.paquete_id as idPaq, $tPaq.cant_alum as cantAlum "
        . "FROM $tProf "
        . "INNER JOIN $tPaq ON $tPaq.id = $tProf.paquete_id "
        . "WHERE BINARY $tProf.user='$user' AND BINARY $tProf.pass='$pass' ";
$resGetUser = $con->query($sqlGetUser);
if ($resGetUser->num_rows > 0) {
    $rowGetUser = $resGetUser->fetch_assoc();
    $_SESSION['sessU'] = true;
    $_SESSION['userId'] = $rowGetUser['id'];
    $_SESSION['userName'] = $rowGetUser['name'];
    $_SESSION['idPaq'] = $rowGetUser['idPaq'];
    $_SESSION['cantAlum'] = $rowGetUser['cantAlum'];
    $_SESSION['perfil'] = 2;
    $perfil = 2;
    $ban = true;
} else { // Si no esta en profesores lo buscamos en alumnos
    $sqlGetUser = "SELECT $tAlum.id as id, $tAlum.informacion_id as idInfo, "
            . "$tAlum.nombre as name FROM $tAlum "
            . "WHERE BINARY $tAlum.user='$user' AND BINARY $tAlum.pass='$pass' ";
    $resGetUser = $con->query($sqlGetUser);
    if ($resGetUser->num_rows > 0) {
        $rowGetUser = $resGetUser->fetch_assoc();
        $_SESSION['sessU'] = true;
        $_SESSION['userId'] = $rowGetUser['id'];
        $_SESSION['userName'] = $rowGetUser['name'];
        $_SESSION['perfil'] = 3;
        $perfil = 3;
        $ban = true;
    } else { // Si no esta en alumnos lo buscamos en tutores
        $sqlGetUser = "SELECT $tTut.id as id, $tTut.informacion_id as idInfo, "
                . "$tTut.nombre as name, $tTut.alumno_id as idAlum FROM $tTut "
                . "WHERE BINARY $tTut.user='$user' AND BINARY $tTut.pass='$pass' ";
        $resGetUser = $con->query($sqlGetUser);
        if ($resGetUser->num_rows > 0) {
            $rowGetUser = $resGetUser->fetch_assoc();
            $_SESSION['sessU'] = true;
            $_SESSION['userId'] = $rowGetUser['id'];
            $_SESSION['userName'] = $rowGetUser['name'];
            $_SESSION['perfil'] = 4;
            $_SESSION['idAlum'] = $rowGetUser['idAlum'];
            $perfil = 4;
            $ban = true;
        } else { // Si no esta en tutores lo buscamos en administradores
            $sqlGetUser = "SELECT $tAdm.id as id, $tAdm.nombre as name FROM $tAdm "
                    . "WHERE BINARY $tAdm.user='$user' AND BINARY $tAdm.pass='$pass' ";
            $resGetUser = $con->query($sqlGetUser);
            if ($resGetUser->num_rows > 0) {
                $rowGetUser = $resGetUser->fetch_assoc();
                $_SESSION['sessU'] = true;
                $_SESSION['userId'] = $rowGetUser['id'];
                $_SESSION['userName'] = $rowGetUser['name'];
                $_SESSION['perfil'] = 10;
                $perfil = 10;
                $ban = true;
            } else { // Definitivamente no existe
                $_SESSION['sessU'] = false;
                //echo "Error en la consulta<br>".$con->error;
                $cadErr = "Usuario y/o contraseña incorrecta";
                $ban = false;
            }
        }
    }
}

if ($ban) {
    echo json_encode(array("error" => 0, "perfil" => $perfil));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $cadErr));
}
?>