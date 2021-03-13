<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $arrMats = array();
    
    $msgErr = '';
    $ban = true;
    
    $idProf = $_GET['idProf'];
    $idGrado = $_GET['idGrado'];
    $idGrupo = $_GET['idGrupo'];
    //$idProf = 2;
    $cad = '';
    
        for($i=1; $i<=10; $i++){
            $posMat = "mat".$i."_id";
            $posProf = "prof".$i."_id";
            $sqlGetNameMat = "SELECT $tAlumMat.$posMat, $tMat.nombre, $tMat.id as idMat "
                    . "FROM $tAlumMat "
                    . "INNER JOIN $tMat ON $tMat.id=$tAlumMat.$posMat "
                    . "WHERE $tAlumMat.grupo_id='$idGrupo' AND $tAlumMat.$posProf='$idProf' ";
            $resGetNameMat = $con->query($sqlGetNameMat);
            if($resGetNameMat->num_rows > 0){
                $rowGetNameMat = $resGetNameMat->fetch_assoc();
                $nombre = $rowGetNameMat['nombre'];
                $idMat = $rowGetNameMat['idMat'];
                $arrMats[] = array('id'=>$idMat, 'nombre'=>$nombre);
                break;
            }else{continue;}
        }

    if($ban){
        //echo json_encode(array("error"=>0, "dataRes"=>$materia, "gNombre"=>$grupoNombre, "gEscNiv"=>$grupoEscNivel, "gGrado"=>$grupoGrado, "gTurno"=>$grupoTurno, "gEsc"=>$grupoEsc));
        echo json_encode(array("error"=>0, "dataRes"=>$arrMats));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
?>