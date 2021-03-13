<?php
    session_start();
    include ('../config/conexion.php');
    $user = $_POST['inputUser'];
    $pass = $_POST['inputPass'];
    $idPerfil = $_POST['inputPerfil'];
    
    $perfil = 0;
    $cadErr = '';
    $ban =false;

    if($idPerfil == 2) $tUser = $tProf;
    else if($idPerfil == 3) $tUser = $tAlum;
    else $tUser = null;
    
        $sqlGetUser = "SELECT $tUser.id as id, $tUser.informacion_id as idInfo, $tUser.nombre as name "
                . "FROM $tUser "
                . "WHERE BINARY $tUser.user='$user' AND BINARY $tUser.pass='$pass' ";
        $resGetUser=$con->query($sqlGetUser);
        if($resGetUser->num_rows > 0){
            $rowGetUser=$resGetUser->fetch_assoc();
            $_SESSION['sessU'] = true;
            $_SESSION['userId'] = $rowGetUser['id'];
            $_SESSION['userName'] = $rowGetUser['name'];
            $_SESSION['perfil'] = $idPerfil;
            $perfil = $idPerfil;
            $ban = true;
        }else{ // Definitivamente no existe
            $_SESSION['sessU']=false;
            //echo "Error en la consulta<br>".$con->error;
            $cadErr = "Usuario y/o contraseña incorrecta";
            $ban = false;
        }
    
    if($ban){
        echo json_encode(array("error"=>0, "perfil"=>$perfil));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$cadErr));
    }
?>