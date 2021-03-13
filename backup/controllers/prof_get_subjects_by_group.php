<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    $idGrupo = $_POST['idGrupo'];

    $msgErr = '';
    $ban = true;
    $arrMats = array();
    
    $sqlGetClass = "SELECT id, nombre FROM $tMat WHERE grupo_id='$idGrupo' ";
    //echo $sqlGetClass;

    $resGetClass = $con->query($sqlGetClass);
    if($resGetClass->num_rows > 0){
        while($rowGetClass = $resGetClass->fetch_assoc()){
            $id = $rowGetClass['id'];
            $nombre = $rowGetClass['nombre'];
            $arrMats[] = array('id'=>$id,'nombre'=>$nombre);
        }
    }else{
        $ban = false;
        $msgErr .= 'No tienes materias.';
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrMats));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>