<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $exams = array();
    $msgErr = '';
    $ban = true;
    $idProf = $_POST['idProf']; 
    
    $sqlGetExasInfo = "SELECT $tExaAsig.id as idExaAsig, $tExaAsig.created as createdAsig, "
            . "$tGrado.nombre as grado, $tGrupo.nombre as grupo, $tExaAsig.grupo_id as idGrupo, "
            . "$tExaInf.nombre as nameExa, $tExaInf.created as createdExa, $tExaAsig.exa_info_id as idExa, "
            . "(SELECT count(*) FROM $tExaPregs WHERE exa_info_id=$tExaInf.id) as numPregs, "
            . "(SELECT count(*) FROM $tAlum WHERE grupo_id=$tExaAsig.grupo_id) as numAlums, "
            . "(SELECT count(*) FROM $tExaResultInfo WHERE exa_info_asig_id=$tExaAsig.id) as numEvals "
            . "FROM $tExaAsig "
            . "INNER JOIN $tGrado ON $tGrado.id=$tExaAsig.grado_id "
            . "INNER JOIN $tGrupo ON $tGrupo.id=$tExaAsig.grupo_id "
            . "INNER JOIN $tExaInf ON $tExaInf.id=$tExaAsig.exa_info_id "
            . "WHERE $tExaAsig.profesor_id='$idProf' ";
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetExasInfo .= " ORDER BY ".$vorder;
    }
    $resGetExasInfo = $con->query($sqlGetExasInfo);
    if($resGetExasInfo->num_rows > 0){
        while($rowGetExasInfo = $resGetExasInfo->fetch_assoc()){
            $idExaAsig = $rowGetExasInfo['idExaAsig'];
            $createdExaAsig = $rowGetExasInfo['createdAsig'];
            $grado = $rowGetExasInfo['grado'];
            $grupo = $rowGetExasInfo['grupo'];
            $idGrupo = $rowGetExasInfo['idGrupo'];
            $idExa = $rowGetExasInfo['idExa'];
            $nameExa = $rowGetExasInfo['nameExa'];
            $createdExa = $rowGetExasInfo['createdExa'];
            $numPregs = $rowGetExasInfo['numPregs'];
            $numAlums = $rowGetExasInfo['numAlums'];
            $numEvals = $rowGetExasInfo['numEvals'];
            
            $exams[] = array("idExamAsig"=>$idExaAsig, "created"=>$createdExaAsig, 
                "grado"=>$grado, "grupo"=>$grupo, "idGrupo"=>$idGrupo, 
                "idExa"=>$idExa, "nameExa"=>$nameExa, "createdExa"=>$createdExa, 
                "numPregs"=>$numPregs, "numAlums"=>$numAlums, "numEvals"=>$numEvals);
        }
    }else{
        $ban = false;
        $msgErr .= 'No hay datos.';
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$exams));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>