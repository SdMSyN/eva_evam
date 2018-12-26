<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $grupos = array();
    $msgErr = '';
    $ban = false;
    
    $idProf = $_GET['idProf'];
    
    $sqlGetGrupos = "SELECT $tGrupo.id as id, $tGrupo.nombre as nombre, "
            . "$tTurn.nombre as turno, $tGrado.nombre as grado, "
            . "$tBMat.nombre as nameMat, $tGMatProfs.id as idGMatProf "
            . "FROM $tGMatProfs "
            . "INNER JOIN $tGrupo ON $tGrupo.id=$tGMatProfs.grupo_info_id "
            . "INNER JOIN $tGrado ON $tGrado.id=$tGrupo.nivel_grado_id "
            . "INNER JOIN $tTurn ON $tTurn.id=$tGrupo.nivel_turno_id "
            . "INNER JOIN $tBMat ON $tBMat.id = $tGMatProfs.banco_materia_id "
            . "WHERE $tGMatProfs.usuario_profesor_id='$idProf' ";
    
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetGrupos .= " ORDER BY ".$vorder;
    }
                
    $resGetGrupos = $con->query($sqlGetGrupos);
    if($resGetGrupos->num_rows > 0){
        while($rowGetGrupo = $resGetGrupos->fetch_assoc()){
            $idGMatProf = $rowGetGrupo['idGMatProf'];
            $sqlGetNumAlumsGrupo = "SELECT COUNT(id) as numAlums "
                    . "FROM $tGMatAlums "
                    . "WHERE grupo_materia_profesor_id = '$idGMatProf' ";
            $resGetNumAlumsGrupo = $con->query($sqlGetNumAlumsGrupo);
            $rowGetNumAlumsGrupo = $resGetNumAlumsGrupo->fetch_assoc();
            $numAlums = $rowGetNumAlumsGrupo['numAlums'];
            $id = $rowGetGrupo['id'];
            $name = $rowGetGrupo['nombre'];
            $grado = $rowGetGrupo['grado'];
            $turno = $rowGetGrupo['turno'];
            $nameMat = $rowGetGrupo['nameMat'];
            $grupos[] = array('id'=>$id, 'nombre'=>$name, 'grado'=>$grado, 
                'turno'=>$turno, 'materia'=>$nameMat, 'numAlums'=>$numAlums);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen grupos   （┬┬＿┬┬） '.$con->error;
    }
    
    //Obtener total alumnos del profesor
    $sqlGetTotalAlums = "SELECT COUNT(id) as totalAlum FROM $tAlum WHERE profesor_id = '$idProf' AND activo = '1' ";
    $resGetTotalAlum = $con->query($sqlGetTotalAlums);
    $rowGetTotalAlum = $resGetTotalAlum->fetch_assoc();
    $totalAlum = $rowGetTotalAlum['totalAlum'];
    
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$grupos, "totalAlum"=>$totalAlum));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>