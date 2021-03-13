<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $user = $_POST['user'];
    $ban = true;
    $msgErr = 'El usuario ya existe, selecciona otro.';
    
    $sqlCheckUser = "SELECT user FROM $tProf WHERE user='$user' ";
    $resCheckUser = $con->query($sqlCheckUser);
    if($resCheckUser->num_rows > 0){
        $ban = false;
    }
    
    if($ban){
        echo json_encode(array("error"=>0));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>