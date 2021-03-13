<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $estExam = array();
    $msgErr = '';
    $ban = true;
    $idEstudiante = $_GET['idUser'];
    
    //Buscamos el grupo del alumno en alumno_materias
    //obtenemos información de la asignación del examen

    $sqlGetGrupo = "SELECT grupo_id FROM $tAlum WHERE id='$idEstudiante' ";
    $resGetGrupo = $con->query($sqlGetGrupo);
    if($resGetGrupo->num_rows > 0){
        $rowGetGrupo = $resGetGrupo->fetch_assoc();
        $idGrupo = $rowGetGrupo['grupo_id'];
        $sqlGetExamInfo = "SELECT $tExaAsig.*, "
                . "DATE_FORMAT($tExaAsig.inicio, '%Y-%m-%d') as inicio, DATE_FORMAT($tExaAsig.fin, '%Y-%m-%d') as fin, "
                //. "$tExaAsig.inicio, $tExaAsig.fin, "
                . "$tExaInf.nombre as nameExa, "
                . "$tMat.nombre as nameMat, $tProf.nombre as nameProf, "
                . "(SELECT count(*) FROM $tExaPregs WHERE exa_info_id=$tExaAsig.exa_info_id) as numPregs "
                . "FROM $tExaAsig "
                . "INNER JOIN $tExaInf ON $tExaInf.id=$tExaAsig.exa_info_id "
                . "INNER JOIN $tMat ON $tMat.id=$tExaAsig.materia_id "
                . "INNER JOIN $tProf ON $tProf.id=$tExaAsig.profesor_id "
                . "WHERE $tExaAsig.grupo_id = '$idGrupo' ";
        //Ordenar ASC y DESC
        $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
        if($vorder != ''){
            $sqlGetExamInfo .= " ORDER BY ".$vorder;
        }
        
        $resGetExamInfo = $con->query($sqlGetExamInfo);
        if($resGetExamInfo->num_rows > 0){
            while($rowGetExamAsig = $resGetExamInfo->fetch_assoc()){
                $id = $rowGetExamAsig['id'];
                $idMateria = $rowGetExamAsig['nameMat'];
                $idProfesor = $rowGetExamAsig['nameProf'];
                $nameExam = $rowGetExamAsig['nameExa'];
                $numExam = $rowGetExamAsig['numPregs'];
                //$inicio = strtotime(date($rowGetExamAsig['inicio'],time()));
                $inicio = new DateTime($rowGetExamAsig['inicio']);
                $inicioTmp = $inicio->format('Y-m-d');
                //$fin = strtotime(date($rowGetExamAsig['fin'],time()));
                $fin = new DateTime($rowGetExamAsig['fin']);
                $finTmp = $fin->format('Y-m-d');
                $dateNowTmp = new DateTime($dateNow);
                $idExam = $rowGetExamAsig['exa_info_id'];
                //$tmp = $inicio.'--'.$dateNowTmp.'--'.$fin;
                $interval1 = $dateNowTmp->diff($inicio);
                $interval2 = $dateNowTmp->diff($fin);
                $tmp = $interval1->format('%R%a dias').'--'.$interval2->format('%R%a dias');
                $disponible = ( $interval1->format('%R%a dias') <= 0 && $interval2->format('%R%a dias') >= 0) ? true : false;
                
                $sqlGetExaResult = "SELECT calificacion FROM $tExaResultInfo "
                        . "WHERE exa_info_id='$idExam' AND exa_info_asig_id='$id' AND alumno_id='$idEstudiante' ";
                $resGetExaResult = $con->query($sqlGetExaResult);
                if($resGetExaResult->num_rows > 0){
                    $rowGetExaResult=$resGetExaResult->fetch_assoc();
                    $calif = $rowGetExaResult['calificacion'];
                }else{
                    $calif = null;
                }
                $estExam[] = array('id'=>$id, 'nombre'=>$nameExam, 'materia'=>$idMateria, 'prof'=>$idProfesor, 'inicio'=>$inicioTmp, 'fin'=>$finTmp, 'idExam'=>$idExam, 'numPregs'=>$numExam, 'calif'=>$calif, 'disp'=>$disponible, 'tmp'=>$tmp);
            }
        }else{
            $ban = false;
            $msgErr .= 'Error al buscar examen.<br>'.$con->error;
        }
        
    }else{
        $ban = false;
        $msgErr .= 'No hay examenes en tu grupo.<br>'.$con->error;
    }
    
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$estExam));
        //echo json_encode(array("error"=>0, "dataRes"=>"Holi"));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>