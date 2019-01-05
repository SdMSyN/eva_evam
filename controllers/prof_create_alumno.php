<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idUser = $_POST['inputIdProf'];
    $idGrupo = $_POST['inputIdGrupo'];
    $name = $_POST['inputName'];
    $ap = $_POST['inputAP'];
    $am = $_POST['inputAM'];

    $ban = true;
    $msgErr = '';
    
    //Obtenemos número de registros
    $sqlGetNumAlums = "SELECT id FROM $tAlum ";
    $resGetNumAlums = $con->query($sqlGetNumAlums);
    $getNumAlums = $resGetNumAlums->num_rows;
    //Creamos clave usuario y contraseña
    $nombre = $ap.' '.$am.' '.$name;
    $apTmp = str_replace(' ', '', $ap);
    $cad1 = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $name);
    $cad2 = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $apTmp);
    $cad3 = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $am);
    $clave = strtolower($cad1{0}).strtolower($cad2).strtolower($cad3{0}).$getNumAlums;
    $clave2 = generar_clave(5);
    //Insertamos informacion del alumno
    $sqlInsertInfoAlum = "INSERT INTO $tInfo (foto_perfil, creado, actualizado) "
            . "VALUES ('$fotoPerfil', '$dateNow', '$dateNow') ";
    if($con->query($sqlInsertInfoAlum) === TRUE){
        $idInfo = $con->insert_id;
        //Insertamos alumno
        $sqlInsertAlum = "INSERT INTO $tAlum "
            . "(nombre, user, pass, clave, informacion_id, profesor_id, creado, actualizado, activo) "
            . "VALUES "
            . "('$nombre', '$clave', '$clave2', '$clave', '$idInfo', '$idUser', '$dateNow', '$dateNow', '1') ";
        if($con->query($sqlInsertAlum) === TRUE){
            $idAlum = $con->insert_id;
            //Insertamos información del tutor
            $sqlInsertInfoTutor = "INSERT INTO $tInfo (foto_perfil, creado, actualizado) "
                . "VALUES ('$fotoPerfil', '$dateNow', '$dateNow') ";
            if($con->query($sqlInsertInfoTutor) === TRUE){
                $idInfoTut = $con->insert_id;
                $claveT = $clave.'t';
                $clave2T = generar_clave(5);
                $sqlInsertTutor = "INSERT INTO $tTut "
                    . "(nombre, user, pass, clave, alumno_id, informacion_id, creado, actualizado) "
                    . "VALUES "
                    . "('$nombre', '$claveT', '$clave2T', '$claveT', '$idAlum', '$idInfoTut', '$dateNow', '$dateNow')";
                if($con->query($sqlInsertTutor) === TRUE){
                    //Insertamos grupo alumno
                    $sqlInsertAlumGrupo = "INSERT INTO $tGrupoAlums (grupo_id, alumno_id, creado) "
                            . "VALUES ('$idGrupo', '$idAlum', '$dateNow')";
                    if($con->query($sqlInsertAlumGrupo) === TRUE){
                        $sqlGetMatsGrupo = "SELECT id FROM $tGMatProfs WHERE grupo_info_id='$idGrupo' ";
                        $resGetMatsGrupo = $con->query($sqlGetMatsGrupo);
                        if($resGetMatsGrupo->num_rows > 0){
                            while($rowGetMatGrupo = $resGetMatsGrupo->fetch_assoc()){
                                $idMatProf = $rowGetMatGrupo['id'];
                                $sqlInsertMatAlum = "INSERT INTO $tGMatAlums (grupo_materia_profesor_id, usuario_alumno_id, creado) "
                                        . "VALUES ('$idMatProf', '$idAlum', '$dateNow') ";
                                if($con->query($sqlInsertMatAlum) === TRUE){
                                    $ban = true;
                                }else{
                                    $msgErr .= 'Error al insertar materia del alumno.'.$con->error;
                                    $ban = false;
                                    break;
                                }
                            }
                        }
                    }else{
                        $msgErr .= 'Error al insertar alumno dentro del grupo'.$con->error;
                        $ban = false;
                    }
                    //fin anterior
                }else{
                    $msgErr .= 'Error al insertar Tutor'.$con->error;
                    $ban = false;
                }
            }else{
                $msgErr .= 'Error al insertar información del tutor'.$con->error;
                $ban = false;
            }     
        }else{
            $msgErr .= 'Error al insertar alumno.'.$con->error;
            $ban = false;
        }
    }else{
        $msgErr .= 'Error al insertar información del alumno.'.$con->error;
        $ban = false;
    }
    
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>0));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
    
    //Función para generar password usuario
    // http://www.leonpurpura.com/tutoriales/generar-claves-aleatorias.html
    function generar_clave($longitud){ 
       $cadena="[^A-Z0-9]"; 
       return substr(preg_replace($cadena, "", md5(rand())) . 
       preg_replace($cadena, "", md5(rand())) . 
       preg_replace($cadena, "", md5(rand())), 
       0, $longitud); 
    } 
    
?>