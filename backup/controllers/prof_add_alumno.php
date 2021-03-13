<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idGrupo = $_POST['inputIdGrupo'];
    $name = $_POST['inputName'];
    $ap = $_POST['inputAP'];
    $am = $_POST['inputAM'];
    //$user = $_POST['inputUser'];
    //$pass = $_POST['inputPass'];
    
    //Obtenemos número de registros
        $sqlGetNumAlum = "SELECT id FROM $tAlum ";
        $resGetNumAlum = $con->query($sqlGetNumAlum);
        $getNumAlum = $resGetNumAlum->num_rows;
        //Creamos clave usuario y contraseña
        $nombre = $ap.' '.$am.' '.$name;
        $apTmp = str_replace(' ', '', $ap);
        $clave = strtolower($am{0}).strtolower($apTmp).strtolower($name{0}).$getNumAlum;
        $clave2 = generar_clave(10);
    $msgErr = '';
    $ban = true;
    
    //Insertamos informacion del alumno
    $sqlInsertInfoAlum = "INSERT INTO $tInfo (created, updated) VALUES ('$dateNow', '$dateNow') ";
    if($con->query($sqlInsertInfoAlum) === TRUE){
        $idInfo = $con->insert_id;
        //Insertamos alumno
        $sqlInsertAlum = "INSERT INTO $tAlum "
            . "(nombre, user, pass, informacion_id, grupo_id, created, updated) "
            . "VALUES ('$nombre', '$clave', '$clave2', '$idInfo', '$idGrupo', '$dateNow', '$dateNow') ";
        if($con->query($sqlInsertAlum) === TRUE){
            $msgErr = 'Alumno creado con éxito.';
            $ban = true;
        }else{
            $msgErr .= 'Error al insertar alumno.'.$j;
            $ban = false;
        }
    }else{
        $msgErr .= 'Error al insertar información del alumno.'.$j;
        $ban = false;
    }

    if($ban){
        echo json_encode(array("error"=>0, "msgErr"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
    //Función para generar password usuario
    // http://www.leonpurpura.com/tutoriales/generar-claves-aleatorias.html
    function generar_clave($longitud){ 
       $cadena="[^A-Z0-9]"; 
       return substr(eregi_replace($cadena, "", md5(rand())) . 
       eregi_replace($cadena, "", md5(rand())) . 
       eregi_replace($cadena, "", md5(rand())), 
       0, $longitud); 
    } 
?>