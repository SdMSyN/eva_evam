<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $infoAsig = array();
    $msgErr = '';
    $ban = false;
    $idExam = $_GET['idExam'];
    
    $sqlGetExaAsig = "SELECT $tExaAsig.id, $tExaAsig.grado_id, $tExaAsig.grupo_id, $tExaAsig.materia_id, "
            . "DATE_FORMAT($tExaAsig.inicio, '%d-%m-%Y %H:%i') as inicio, DATE_FORMAT($tExaAsig.fin, '%d-%m-%Y %H:%i') as fin, "
            . "$tExaAsig.tiempo as tiempo, $tExaAsig.aleatorio, $tExaAsig.created, "
            . "$tGrado.nombre as grado, $tGrupo.nombre as grupo, $tMat.nombre as materia, $tProf.nombre as profesor "
            . "FROM $tExaAsig "
            . "INNER JOIN $tGrado ON $tGrado.id=$tExaAsig.grado_id "
            . "INNER JOIN $tGrupo ON $tGrupo.id=$tExaAsig.grupo_id "
            . "INNER JOIN $tMat ON $tMat.id=$tExaAsig.materia_id "
            . "INNER JOIN $tProf ON $tProf.id=$tExaAsig.profesor_id "
            . "WHERE $tExaAsig.exa_info_id='$idExam' ";
    if(isset($_GET['idExamAsig'])){ $idExamAsig=$_GET['idExamAsig']; $sqlGetExaAsig .= " AND $tExaAsig.id='$idExamAsig' ";}     
    $resGetExaAsig = $con->query($sqlGetExaAsig);
    if($resGetExaAsig->num_rows > 0){
        while($rowGetExaAsig = $resGetExaAsig->fetch_assoc()){
            $id = $rowGetExaAsig['id'];
            $grado = $rowGetExaAsig['grado'];
            $grupo = $rowGetExaAsig['grupo'];
            $materia = $rowGetExaAsig['materia'];
            $profesor = $rowGetExaAsig['profesor'];
            $inicio = $rowGetExaAsig['inicio'];
            $fin = $rowGetExaAsig['fin'];
            $tiempo = $rowGetExaAsig['tiempo'];
            $aleatorio = $rowGetExaAsig['aleatorio'];
            $created = $rowGetExaAsig['created'];
            $infoAsig[] = array('id'=>$id, 'grado'=>$grado, 'grupo'=>$grupo, 
                'materia'=>$materia, 'prof'=>$profesor, 'inicio'=>$inicio, 'fin'=>$fin, 
                'tiempo'=>$tiempo, 'aleatorio'=>$aleatorio, 'creado'=>$created);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No has asignado éste examen.'.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$infoAsig));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>