<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $preguntas = array();
    $msgErr = '';
    $ban = false;
    $idSubtema = $_GET['id'];
    $idTema = $_GET['idTema'];
    $idBloque = $_GET['idBloque'];
    if($idTema != 0 && $idSubtema == 0)
        $sqlGetPreguntas = "SELECT * FROM $tBPregs WHERE banco_tema_id = '$idTema' ";
    else if($idSubtema != 0)
        $sqlGetPreguntas = "SELECT * FROM $tBPregs WHERE banco_subtema_id = '$idSubtema' ";
    else
        $sqlGetPreguntas = "SELECT * FROM $tBPregs WHERE banco_bloque_id='$idBloque' ";
    
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetPreguntas .= " ORDER BY ".$vorder;
    }
                
    $resGetPreguntas = $con->query($sqlGetPreguntas);
    if($resGetPreguntas->num_rows > 0){
        while($rowGetPreguntas = $resGetPreguntas->fetch_assoc()){
            //$cadRes .= '<option value="'.$rowGetMateria['id'].'">'.$rowGetMateria['nombre'].'</option>';
            $id = $rowGetPreguntas['id'];
            $name = $rowGetPreguntas['nombre'];
            $created = $rowGetPreguntas['creado'];
            $preguntas[] = array('id'=>$id, 'nombre'=>$name, 'creado'=>$created);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen preguntas en éste subtema  （┬┬＿┬┬） '.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$preguntas));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>