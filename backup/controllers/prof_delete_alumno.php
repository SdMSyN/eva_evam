<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idAlum = $_GET['idAlum'];
    $ban = false;
    $banTmp = false;
    $msgErr = '';
    //borramos preguntas respondidas por el alumno
    $sqlDeleteRespsAlum = "DELETE FROM $tExaResultPregs WHERE alumno_id='$idAlum' ";
    if($con->query($sqlDeleteRespsAlum) === TRUE){
        $sqlDeleteResultInfo = "DELETE FROM $tExaResultInfo WHERE alumno_id='$idAlum' ";
        if($con->query($sqlDeleteResultInfo) === TRUE){
            $sqlGetIdInfoAlum = "SELECT informacion_id FROM $tAlum WHERE id='$idAlum' ";
            $resGetIdInfoAlum = $con->query($sqlGetIdInfoAlum);
            $rowGetIdInfoAlum = $resGetIdInfoAlum->fetch_assoc();
            $idInfo = $rowGetIdInfoAlum['informacion_id'];
            $sqlDeleteInfo = "DELETE FROM $tInfo WHERE id='$idInfo' ";
            if($con->query($sqlDeleteInfo) === TRUE){
                $sqlDeleteUser = "DELETE FROM $tAlum WHERE id='$idAlum' ";
                if($con->query($sqlDeleteUser) === TRUE){
                    $ban = true;
                }else{
                    $banTmp = false;
                    $msgErr .= 'Error al borrar alumno.'.$con->error.'--';
                }
            }else{
                $banTmp = false;
                $msgErr .= 'Error al borrar información del alumno.'.$con->error.'--';
            }
        }else{
            $banTmp = false;
            $msgErr .= 'Error al borrar información de resultados.'.$con->error.'--';
        }
    }else{
        $banTmp = false;
        $msgErr .= 'Error al borrar respuestas.'.$con->error.'--';
    }

    if($ban){
        $msgErr = 'Se borro con éxito.';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>