<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    $idUser = $_POST['idProf'];

    $msgErr = '';
    $ban = true;
    $arrClass = array();
    $arrMats = array();
    
    $sqlGetClass = "SELECT $tGrupo.id as id, $tGrupo.nombre as nombre, "
            . "$tNivEsc.nombre as escolar, $tGrado.nombre as grado, "
            . "$tTurn.nombre as turno "
            . "FROM $tGrupo "
            . "INNER JOIN $tNivEsc ON $tNivEsc.id=$tGrupo.escolar_id "
            . "INNER JOIN $tGrado ON $tGrado.id=$tGrupo.grado_id "
            . "INNER JOIN $tTurn ON $tTurn.id=$tGrupo.turno_id "
            . "WHERE $tGrupo.profesor_id='$idUser' ";
    //echo $sqlGetClass;
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetClass .= " ORDER BY ".$vorder;
    }
    
    $resGetClass = $con->query($sqlGetClass);
    if($resGetClass->num_rows > 0){
        while($rowGetClass = $resGetClass->fetch_assoc()){
            $idGrupo = $rowGetClass['id'];
            $nombreGrupo = $rowGetClass['nombre'];
            $nombreEscolar = $rowGetClass['escolar'];
            $nombreGrado = $rowGetClass['grado'];
            $nombreTurno = $rowGetClass['turno'];
            //obtenemos número de alumnos
            $sqlGetNumStudents = "SELECT id FROM $tAlum WHERE grupo_id='$idGrupo' ";
            $resGetStudents = $con->query($sqlGetNumStudents);
            $numStudents = $resGetStudents->num_rows;
            //Obtenemos materias
            $sqlGetMats = "SELECT id, nombre FROM $tMat WHERE grupo_id='$idGrupo' ";
            //echo $sqlGetMats;
            $resGetMats = $con->query($sqlGetMats);
            if($resGetMats->num_rows > 0){
                while($rowGetMats = $resGetMats->fetch_assoc()){
                    $idMat = $rowGetMats['id'];
                    $nombreMat = $rowGetMats['nombre'];
                    //$arrMats[] = array('idMat'=>$idMat,'nombreMat'=>$nombreMat);
                    //echo $idGrupo.'--'.$nombreGrupo.'--'.$nombreEscolar.'--'.$nombreGrado.'--'.$nombreTurno.'--'.$numStudents.'--'.$nombreMat;
                    $arrClass[] = array('id'=>$idGrupo,'grupo'=>$nombreGrupo,'escolar'=>$nombreEscolar,'grado'=>$nombreGrado,'turno'=>$nombreTurno,'numStudents'=>$numStudents,'mat'=>$nombreMat);
                }
            }else{
                $ban = false;
                $msgErr .= 'Aún no tienes materias creadas.';
                break;
            }
            //$arrClass[] = array('id'=>$idGrupo,'grupo'=>$nombreGrupo,'escolar'=>$nombreEscolar,'grado'=>$nombreGrado,'turno'=>$nombreTurno,'numStudents'=>$numStudents,'mats'=>$arrMats);
        }
    }else{
        $ban = false;
        $msgErr .= 'Aún no has creado ninguna clase.';
    }
    
    if($ban){
        //print_r($arrClass);
        echo json_encode(array("error"=>0, "dataRes"=>$arrClass));
        //echo json_encode(array("error"=>0, "dataRes"=>"Holi"));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>