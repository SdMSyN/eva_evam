<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idExam = $_POST['inputIdExam'];
    $idProf = $_POST['inputIdProfe'];
    $idGrado = $_POST['inputGrado'];
    $idGrupo = $_POST['inputGrupo'];
    $idMat = $_POST['inputMat'];
    $beginF = $_POST['inputBeginF'];
    $beginH = $_POST['inputBeginH'];
    $endF = $_POST['inputEndF'];
    $endH = $_POST['inputEndH'];
    $hora = $_POST['inputH'];
    $min = $_POST['inputM'];
    $aleatorio = (isset($_POST['inputAle'])) ? 1 : 0;

    $begin = $beginF.' '.$beginH;
    $end = $endF.' '.$endH;
    $timeExa = $hora.':'.$min;
    
    $msgErr = '';
    $ban = true;
    
    $sqlInsertExaAsig = "INSERT INTO $tExaAsig "
            . "(grado_id, grupo_id, materia_id, profesor_id, inicio, fin, tiempo, aleatorio, exa_info_id, created, updated) "
            . "VALUES "
            . "('$idGrado', '$idGrupo', '$idMat', '$idProf', '$begin', '$end', '$timeExa', '$aleatorio', '$idExam', '$dateNow', '$dateNow') ";
    if($con->query($sqlInsertExaAsig) === TRUE){
        $ban = true;
        $msgErr = 'Examen asignado con éxito';
    }else{
        $ban = false;
        $msgErr = 'Error al crear examen.<br>'.$con->error;
    }

    if($ban){
        echo json_encode(array("error"=>0, "msgErr"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
?>