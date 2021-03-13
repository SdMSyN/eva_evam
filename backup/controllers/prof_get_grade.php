<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $grupo = array();
    $msgErr = '';
    $ban = true;
    
    $idProf = $_POST['idProf'];
    //$idProf = 2;
    $cad = '';
    $sqlGetGroup = "SELECT DISTINCT $tGrupo.grado_id, $tGrupo.id, $tGrado.nombre "
            . "FROM $tGrupo "
            . "INNER JOIN $tGrado ON $tGrado.id=$tGrupo.grado_id "
            . "WHERE profesor_id='$idProf' ";
    //echo $sqlGetGroup.'<br>';
    $resGetGroup = $con->query($sqlGetGroup);
    if($resGetGroup->num_rows > 0){
        while($rowGetGrupo = $resGetGroup->fetch_assoc()){
            $id = $rowGetGrupo['grado_id'];
            $name = $rowGetGrupo['nombre'];
            $grupo[] = array('id'=>$id, 'nombre'=>$name);
        }
    }else{
        $ban = false;
        $msgErr = 'No hay grados creados   （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$grupo));
        //echo json_encode(array("error"=>0, "dataRes"=>"Holi"));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

    
?>