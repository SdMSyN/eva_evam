<?php
    include ('../config/conexion.php');
    include('../config/variables.php');

    $msgErr = '';
    $ban = true;
    $arrPaq = array();
    
    $sqlGetPaqs = "SELECT * FROM $tPaq  ";
    //echo $sqlGetClass;

    $resGetPaqs = $con->query($sqlGetPaqs);
    if($resGetPaqs->num_rows > 0){
        while($rowGetPaq = $resGetPaqs->fetch_assoc()){
            $idPaq = $rowGetPaq['id'];
            $nombre = $rowGetPaq['nombre'];
            $arrPaq[] = array('id'=>$idPaq,'nombre'=>$nombre);
        }
    }else{
        $ban = false;
        $msgErr .= 'No existe el paquete.';
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrPaq));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>