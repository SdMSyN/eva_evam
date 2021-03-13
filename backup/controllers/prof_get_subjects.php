<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    $idUser = $_POST['idProf'];

    $msgErr = '';
    $ban = true;
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

    $resGetClass = $con->query($sqlGetClass);
    if($resGetClass->num_rows > 0){
        while($rowGetClass = $resGetClass->fetch_assoc()){
            $idGrupo = $rowGetClass['id'];
            //Obtenemos materias
            $sqlGetMats = "SELECT id, nombre FROM $tMat WHERE grupo_id='$idGrupo' ";
            //echo $sqlGetMats;
            $resGetMats = $con->query($sqlGetMats);
            if($resGetMats->num_rows > 0){
                while($rowGetMats = $resGetMats->fetch_assoc()){
                    $idMat = $rowGetMats['id'];
                    $nombreMat = $rowGetMats['nombre'];
                    $arrMats[] = array('id'=>$idMat,'mat'=>$nombreMat);
                }
            }else{
                $ban = false;
                $msgErr .= 'Aún no tienes materias creadas.';
                break;
            }
        }
    }else{
        $ban = false;
        $msgErr .= 'Aún no has creado ninguna clase.';
    }
    
    if($ban){
        //print_r($arrClass);
        echo json_encode(array("error"=>0, "dataRes"=>$arrMats));
        //echo json_encode(array("error"=>0, "dataRes"=>"Holi"));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>