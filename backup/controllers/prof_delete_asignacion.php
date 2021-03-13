<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idAsig = $_GET['idAsig'];
    $ban = false;
    $banTmp = false;
    $msgErr = '';
    //borramos preguntas respondidas por el alumno
    $sqlDeleteRespsAlum = "DELETE FROM $tExaAsig WHERE id='$idAsig' ";
    if($con->query($sqlDeleteRespsAlum) === TRUE){
        $ban = true;
        $msgErr = 'Asignación eliminada con éxito.';
    }else{
        $ban = false;
        $msgErr .= 'Error al borrar asignación.'.$con->error.'--';
    }

    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>