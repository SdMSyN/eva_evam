<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $exams = array();
    $msgErr = '';
    $ban = true;
    $idExam = $_POST['idExam']; 
    $idExamAsig = $_POST['idExamAsig']; 
    $idGrupo = $_POST['idGrupo']; 
    
    $arrIdsPregs = array();
    $arrValPregs = array();
    $arrStudents = array();
    // Obtener número de preguntas
    // Obtener alumnos
    // Obtener detalles de las preguntas respondidas
    // Obtener números generales
    $sqlGetPregs = "SELECT id, nombre, valor_preg FROM $tExaPregs WHERE exa_info_id='$idExam' ";
    $resGetPregs = $con->query($sqlGetPregs);
    $valorExa = 0; $numPregs = 0;
    if($resGetPregs->num_rows > 0){
        $numPregs = $resGetPregs->num_rows;
        while($rowGetPregs = $resGetPregs->fetch_assoc()){
            $idPreg = $rowGetPregs['id'];
            $namePreg = $rowGetPregs['nombre'];
            $valorPreg = $rowGetPregs['valor_preg'];
            $valorExa += $valorPreg;
            $arrIdsPregs[] = $idPreg;
            $arrValPregs[] = $valorPreg;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen preguntas.<br>'.$con->error;
    }
    
    if($ban){
        $sqlGetStudents = "SELECT id, nombre FROM $tAlum WHERE grupo_id='$idGrupo' ";
        $resGetStudents = $con->query($sqlGetStudents);
        if($resGetStudents->num_rows > 0){
            while($rowGetStudents = $resGetStudents->fetch_assoc()){
                $idAlum = $rowGetStudents['id'];
                $nameAlum = $rowGetStudents['nombre'];
                $arrCalifPregs = array();
                $k=0;
                foreach($arrIdsPregs as $idPregArr){
                    $sqlGetResp = "SELECT calificacion "
                        . "FROM $tExaResultPregs "
                        . "WHERE exa_info_id='$idExam' AND exa_info_asig_id='$idExamAsig' "
                        . "AND alumno_id='$idAlum' AND pregunta_id='$idPregArr' ";
                    //echo $sqlGetResp; 
                    $resGetResp = $con->query($sqlGetResp);
                    if($resGetResp->num_rows > 0){
                        $rowGetResp = $resGetResp->fetch_assoc();
                        $calif = $rowGetResp['calificacion'];
                        $arrCalifPregs[] = array("calif"=>$calif, "valorPreg"=>$arrValPregs[$k]);
                        $k++;
                    }else{
                        $arrCalifPregs[] = array("calif"=>null, "valorPreg"=>$arrValPregs[$k]);
                        $k++;
                    }
                }
                $sqlGetResultInfo = "SELECT * FROM $tExaResultInfo "
                        . "WHERE exa_info_id='$idExam' AND exa_info_asig_id='$idExamAsig' AND alumno_id='$idAlum' ";
                $resGetResultInfo = $con->query($sqlGetResultInfo);
                $rowGetResultInfo = $resGetResultInfo->fetch_assoc();
                $buenas = $rowGetResultInfo['resp_buenas'];
                $malas = $rowGetResultInfo['resp_malas'];
                $valorExaAlum = $rowGetResultInfo['valor_exa_alum'];
                $calificacion = $rowGetResultInfo['calificacion'];
                
                $arrStudents[] = array("idAlum"=>$idAlum, "nameAlum"=>$nameAlum, 
                    "valorExa"=>$valorExa, "numPregs"=>$numPregs,
                    "resp"=>$arrCalifPregs, "buenas"=>$buenas, "malas"=>$malas, 
                    "valor"=>$valorExaAlum, "calificacion"=>$calificacion);
            }
        }else{
            $ban = false;
            $msgErr .= 'No hay alumnos en éste grupo.';
        }
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrStudents));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>