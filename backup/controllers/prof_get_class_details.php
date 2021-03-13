<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    $idGroup = $_POST['idGrupo'];

    $msgErr = '';
    $ban = true;
    $arrAlumno = array();
    
    $sqlGetClass = "SELECT * FROM $tAlum WHERE grupo_id='$idGroup'  ";
    //echo $sqlGetClass;
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetClass .= " ORDER BY ".$vorder;
    }
    $resGetClass = $con->query($sqlGetClass);
    if($resGetClass->num_rows > 0){
        while($rowGetClass = $resGetClass->fetch_assoc()){
            $idAlumno = $rowGetClass['id'];
            $nombre = $rowGetClass['nombre'];
            $user = $rowGetClass['user'];
            $pass = $rowGetClass['pass'];
            $arrAlumno[] = array('id'=>$idAlumno,'nombre'=>$nombre,'user'=>$user,'pass'=>$pass);
        }
    }else{
        $ban = false;
        $msgErr .= 'No tienes alumnos.';
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrAlumno));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>