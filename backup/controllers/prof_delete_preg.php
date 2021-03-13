<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idPreg = $_GET['idPreg'];
    $ban = false;
    $banTmp = true;
    $msgErr = '';
    //borramos las respuestas
    $sqlGetIdsResps = "SELECT id FROM $tExaResps WHERE exa_preguntas_id='$idPreg' ";
    $resGetIdsResps = $con->query($sqlGetIdsResps);
    while($rowGetIdResp = $resGetIdsResps->fetch_assoc()){
        $idResp = $rowGetIdResp['id'];
        $sqlDeleteResps = "DELETE FROM $tExaResps WHERE id='$idResp' ";
        if($con->query($sqlDeleteResps) === TRUE){
            //$banTmp = true;
            continue;
        }else{
            $banTmp = false;
            $msgErr .= 'Error al borrar respuesta.'.$con->error.'--'.$idResp;
            break;
        }
    }
    
    //borramos pregunta si todo salio bien borrando respuestas
    if($banTmp){
        $sqlDeletePreg = "DELETE FROM $tExaPregs WHERE id='$idPreg' ";
        if($con->query($sqlDeletePreg) === TRUE){
            $ban = true;
        }else{
            $ban = false;
            $msgErr .= 'Error al borrar la pregunta.'.$idPreg.'--'.$con->error;
        }
    }
    
    if($ban){
        $msgErr = 'Se borro con éxito.';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>