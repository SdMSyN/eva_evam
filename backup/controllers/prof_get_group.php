<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $grupo = array();
    $msgErr = '';
    $ban = true;
    
    $idProf = $_POST['idProf'];
    $idGrado = $_POST['idGrado'];
    //$idProf = 2;
    $cad = '';
    $sqlGetGroup = "SELECT id, nombre FROM $tGrupo WHERE grado_id='$idGrado' AND profesor_id='$idProf' ";
    //echo $sqlGetGroup.'<br>';
    $resGetGroup = $con->query($sqlGetGroup);
    if($resGetGroup->num_rows > 0){
        while($rowGetGrupo = $resGetGroup->fetch_assoc()){
            $id = $rowGetGrupo['id'];
            $name = $rowGetGrupo['nombre'];
            $grupo[] = array('id'=>$id, 'nombre'=>$name);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No hay grupos creados   （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$grupo));
        //echo json_encode(array("error"=>0, "dataRes"=>"Holi"));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

    
?>