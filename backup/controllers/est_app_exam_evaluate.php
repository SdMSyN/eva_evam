<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idUser = $_GET['idUser'];
    $idExam = $_GET['idExam'];
    $idExamAsig = $_GET['idExamAsig'];
    $idExamTime = $_GET['idExaTime'];
    //echo $idUser.'--'.$idExam;
    $ban = true;
    $msgErr = '';
    $msgEx = '';
    $cadCheck = '';
    $countPregs = 0;
    $numCorr = 0; 
    $numErr = 0;
    $valorEst = 0;
    $arrCalRespTmp = array();
    
    $sqlGetPregs = "SELECT *, "
            . "(SELECT SUM(valor_preg) FROM $tExaPregs WHERE exa_info_id='$idExam') as valor_exa "
            . "FROM $tExaPregs WHERE exa_info_id = '$idExam' ";
    $resGetPregs = $con->query($sqlGetPregs);
    $numPregs = $resGetPregs->num_rows;
    while($rowGetPregs = $resGetPregs->fetch_assoc()){
        $valorExa = $rowGetPregs['valor_exa'];
        $idPreg = $rowGetPregs['id'];
        $tipoResp = $rowGetPregs['tipo_resp'];
        $valorPreg = $rowGetPregs['valor_preg'];
        //obtenemos preguntas contestadas
        $sqlGetPregsTmp = "SELECT * FROM $tExaTmp "
                . "WHERE alumno_id='$idUser' AND examen_id='$idExam' AND exa_info_asig_id='$idExamAsig' "
                . "AND pregunta_id='$idPreg' AND tipo_resp_id='$tipoResp'  ";
        $resGetPregsTmp = $con->query($sqlGetPregsTmp);
        if($resGetPregsTmp->num_rows > 0){
            while($rowGetPregsTmp = $resGetPregsTmp->fetch_assoc()){
                $countPregs++;
                //Según tipo de respuesta evaluamos
                $tipoRespTmp = $rowGetPregsTmp['tipo_resp_id'];
                $respTmp = $rowGetPregsTmp['respuesta'];
                if($tipoRespTmp == 1){
                    $sqlCompareResp = "SELECT id, correcta FROM $tExaResps WHERE id='$respTmp' AND exa_preguntas_id='$idPreg' ";
                    $resCompareResp = $con->query($sqlCompareResp);
                    //if($resCompareResp->num_rows > 0){
                        $rowCompareResp = $resCompareResp->fetch_assoc();
                        $respCorr = $rowCompareResp['correcta'];
                        if($respCorr == 1){//respuesta correcta
                            $numCorr++;
                            $valorEst += $valorPreg;
                            $arrCalRespTmp[] = 1;
                        }else{
                            $numErr++;
                            $arrCalRespTmp[] = 0;
                        }
                    /*}else{
                        $ban = false;
                        $msgErr .= 'No hay respuesta existente, te la sacaste de la manga 1.';
                        break;
                    }*/
                }else if($tipoRespTmp == 2){//checkbox aún falta validar
                    //Obtenemos todas las respuestas validas del checkbox
                    $sqlGetRespCorrCheck = "SELECT id FROM $tExaResps WHERE exa_preguntas_id='$idPreg' AND correcta='1' ";
                    $resGetRespCorrCheck = $con->query($sqlGetRespCorrCheck);
                    $respCorrCheck = array();
                    while($rowGetRespCorrCheck = $resGetRespCorrCheck->fetch_assoc()){
                        $respCorrCheck[] = $rowGetRespCorrCheck['id'];
                    }
                    //Obtenemos valores de la respuesta y lo convertimos a un arreglo
                    $arrRespTmpCheck = explode(",",$respTmp);
                    //print_r($arrRespTmpCheck);
                    $cadCheck .= '<br>'.count($respCorrCheck).' vs '.count($arrRespTmpCheck);
                    if(count($respCorrCheck) == count($arrRespTmpCheck)){
                        $banCheck = true;
                        for($j = 0; $j < count($respCorrCheck); $j++){
                            if(in_array($respCorrCheck[$j], $arrRespTmpCheck) == FALSE){
                                $banCheck = false;
                                break;
                            }else continue;
                        }
                        if($banCheck){
                            $numCorr++;
                            $valorEst += $valorPreg;
                            $arrCalRespTmp[] = 1;
                        }else{//no coinciden las respuestas
                            $numErr++;
                            $arrCalRespTmp[] = 0;
                        }
                    }else{//si no coinciden los números de respuestas es incorrecto
                        $numErr++;
                        $arrCalRespTmp[] = 0;
                    }
                }else if($tipoRespTmp == 3){
                    $idRespTmp = $rowGetPregsTmp['respuesta_id'];
                    $sqlCompareResp = "SELECT palabras FROM $tExaResps WHERE id='$idRespTmp' AND exa_preguntas_id='$idPreg' ";
                    //echo $sqlCompareResp;
                    $resCompareResp = $con->query($sqlCompareResp);
                    if($resCompareResp->num_rows > 0){
                        $rowCompareResp = $resCompareResp->fetch_assoc();
                        $arrPalabras = explode(",",$rowCompareResp['palabras']);
                        $banWord = true;
                        for($j = 0 ; $j < count($arrPalabras); $j++){
                            if(!preg_match('/'.$arrPalabras[$j].'/i', $respTmp)){
                                $banWord = false;
                                break;
                            }else continue;
                        }
                        if($banWord){//respuesta correcta
                            $numCorr++;
                            $valorEst += $valorPreg;
                            $arrCalRespTmp[] = 1;
                        }else{
                            $numErr++;
                            $arrCalRespTmp[] = 0;
                        }
                    }else{
                        $ban = false;
                        $msgErr .= 'No hay respuesta existente, te la sacaste de la manga 3.';
                        break;
                    }
                }else if($tipoRespTmp == 4){
                    $idRespTmp = $rowGetPregsTmp['respuesta_id'];
                    $sqlCompareResp = "SELECT palabras FROM $tExaResps WHERE id='$idRespTmp' AND exa_preguntas_id='$idPreg' ";
                    $resCompareResp = $con->query($sqlCompareResp);
                    if($resCompareResp->num_rows > 0){
                        $rowCompareResp = $resCompareResp->fetch_assoc();
                        $arrPalabras = $rowCompareResp['palabras'];
                        if($arrPalabras == $respTmp){
                            $numCorr++;
                            $valorEst += $valorPreg;
                            $arrCalRespTmp[] = 1;
                        }else{
                            $numErr++;
                            $arrCalRespTmp[] = 0;
                        }
                    }else{
                        $ban = false;
                        $msgErr .= 'No hay respuesta existente, te la sacaste de la manga 4.';
                        break;
                    }
                }else{
                    $msgErr .= 'Tipo de respuesta inexistente.';
                    $ban = false;
                    break;
                }
            }
        }else{
            $msgErr .= 'No has contestado ninguna pregunta.';
            //$ban = false;
        }
    }//end while preg
    
    //Registramos hora de finalización
    $sqlInsertHoraFinal = "UPDATE $tExaTime SET hora_fin='$timeNow' WHERE id='$idExamTime' ";
    if($con->query($sqlInsertHoraFinal) === TRUE){
        $banTime = true;
    }else{
        $banTime = false;
    }
    if($banTime){
        //Obtenemos información de los tiempos del examen del usuario
        $sqlGetInfoExaTime = "SELECT * FROM $tExaTime WHERE id='$idExamTime' ";
        $resGetInfoExaTime = $con->query($sqlGetInfoExaTime);
        $rowGetInfoExaTime = $resGetInfoExaTime->fetch_assoc();
        $hInicio = $rowGetInfoExaTime['hora_inicio'];
        $hFin = $rowGetInfoExaTime['hora_fin'];
        //$ban = true;
    }/*else{
        $ban = false;
    }*/
    
    
    
    if($ban){
        //if($resGetPregsTmp->num_rows > 0){
            // obtener porcentaje por regla de 3
            $porc = ($valorEst * 100) / $valorExa; 
            $califTmp = $porc / 10;
            $sqlInsertResultInfo = "INSERT INTO $tExaResultInfo "
                    . "(exa_info_id, exa_info_asig_id, alumno_id, num_preguntas, preg_contestadas, "
                    . "resp_buenas, resp_malas, valor_exa, valor_exa_alum, calificacion, porcentaje, "
                    . "hora_inicio, hora_fin, created, updated) "
                    . "VALUES ('$idExam', '$idExamAsig', '$idUser', '$numPregs', '$countPregs', "
                    . " '$numCorr', '$numErr', '$valorExa', '$valorEst', '$califTmp', '$porc', "
                    . "'$hInicio', '$hFin', '$dateNow', '$dateNow' )";
            if($con->query($sqlInsertResultInfo) === TRUE){
                //echo $sqlInsertResultInfo;
                $idExaResultInfo = $con->insert_id;
                //echo $idExaResultInfo;
                $posArrResp = 0;
                $sqlGetPregsTmp = "SELECT * FROM $tExaTmp "
                        . "WHERE alumno_id='$idUser' AND examen_id='$idExam' AND exa_info_asig_id='$idExamAsig' ";
                $resGetPregsTmp = $con->query($sqlGetPregsTmp);
                while($rowGetPregsTmp2 = $resGetPregsTmp->fetch_assoc()){
                    $idExaTmp = $rowGetPregsTmp2['id'];
                    $idPreg2 = $rowGetPregsTmp2['pregunta_id'];
                    $idTipoResp2 = $rowGetPregsTmp2['tipo_resp_id'];
                    $idResp2 = $rowGetPregsTmp2['respuesta_id'];
                    $resp2 = $rowGetPregsTmp2['respuesta'];
                    $califTmp = $arrCalRespTmp[$posArrResp];
                    //echo '*****'.$califTmp.'--'.$posArrResp.'--'.$arrCalRespTmp[$posArrResp].'*****';
                     $posArrResp++;
                     $sqlInsertResultPreg = "INSERT INTO $tExaResultPregs "
                             . "(exa_info_id, exa_info_asig_id, alumno_id, pregunta_id, tipo_resp_id, respuesta_id, respuesta, "
                             . "exa_result_info_id, calificacion, created, updated) "
                             . "VALUES "
                             . "('$idExam', '$idExamAsig', '$idUser', '$idPreg2', '$idTipoResp2', '$idResp2', '$resp2', "
                             . "'$idExaResultInfo', '$califTmp', '$dateNow', '$dateNow' ) ";
                     //echo $sqlInsertResultPreg.'<br>';
                     if($con->query($sqlInsertResultPreg) === TRUE){
                         $sqlDeleteExaTmp = "DELETE FROM $tExaTmp WHERE id='$idExaTmp' ";
                         if($con->query($sqlDeleteExaTmp) === TRUE){
                            $ban = true;
                            continue;
                         }else{
                             $ban = false;
                            $msgErr .= 'Error al eliminar pregunta temporal.'.$con->error.'--'.$posArrResp;
                            break;
                         }
                     }else{
                         $ban = false;
                         $msgErr .= 'Error al insertar resultado de la pregunta.'.$con->error.'--'.$posArrResp;
                         break;
                     }
                }
            }else{
                $ban = false;
                $msgErr .= 'Error al insertar resultado info del examen.'.$con->error.'--'.$sqlInsertResultInfo;
            }
        //}
    }else{
        $sqlInsertResultInfo = "INSERT INTO $tExaResultInfo "
                . "(exa_info_id, exa_info_asig_id, alumno_id, num_preguntas, preg_contestadas, "
                . "resp_buenas, resp_malas, valor_exa, valor_exa_alum, calificacion, porcentaje, "
                . "hora_inicio, hora_fin, created, updated) "
                . "VALUES ('$idExam', '$idExamAsig', '$idUser', '$numPregs', '0', "
                . " '0', '$numPregs', '$valorExa', '0', '0', '0', "
                . "'$hInicio', '$hFin', '$dateNow', '$dateNow' )";
        if($con->query($sqlInsertResultInfo) === TRUE){
            $ban = true;
        }else{
            $ban = false;
            $msgErr .= 'Error al insertar examen vacio.';
        }
    }
    
    
    $msgEx .= 'Numero de preguntas: '.$numPregs.', Valor del examen: '.$valorExa.', '
            . 'Número de preguntas respondidas: '.$countPregs.', '
            . 'Correctas: '.$numCorr.', Incorrectas: '.$numErr.', valor obtenido: '.$valorEst.'<br>Checks: '.$cadCheck;
    if($ban){
        //echo "Éxito al evaluar tus resultados son: ".$msgEx;
        //print_r($arrCalRespTmp);
        $msgErr .= 'Éxito al calificar tu examen';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
    
?>