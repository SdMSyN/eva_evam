<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $id = $_POST['inputIdUser']; //idProfesor
    $nivel = $_POST['inputNivel'];
    $grado = $_POST['inputGrado'];
    $grupo = $_POST['inputGrupo'];
    $turno = $_POST['inputTurno'];
    $mat = $_POST['inputMat'];
    $file = $_FILES['inputFile']['name'];
    //echo $id."--".$nivel."--".$grado."--".$grupo."--".$turno."--".$tmpMat."--".$countArray;
    
    //Procesamos Excel
    $destinoCsv = '../'.$csvUploads.'/'.$file;
    $csv = @move_uploaded_file($_FILES["inputFile"]["tmp_name"], $destinoCsv);
    $msgErr = ''; $cad = '';
    $ban = true;
    $sustituye = array("\r\n", "\n\r", "\n", "\r");
    // Validamos archivo CSV (estructura)
    if($csv){
        $csvFile = file($destinoCsv);
        $i = 0;
        foreach($csvFile as $linea_num => $linea){
            $i++;
            $linea = utf8_encode($linea);
            $datos = explode(",", $linea);
            $contador = count($datos);
            //Número de campos menor
            if($contador < 3){
                $msgErr .= 'Tu archivo tiene menos columnas de las requeridas.'.$i;
                $ban = false;
                break;
            }
            //Se excede el número de campos
            if($contador > 3){
                $msgErr .= 'Tu archivo tiene más columnas de las requeridas.'.$i;
                $ban = false;
                break;
            }
            //Validamos solo letras en los campos
            $nombre = str_replace($sustituye, "", $datos[2]);
            if(!preg_match('/^[a-zA-Z ]+$/', $datos[0]) || !preg_match('/^[a-zA-Z ]+$/', $datos[1]) || !preg_match('/^[a-zA-Z ]+$/', $nombre)){
                $msgErr .= 'Los nombres y apellidos solo pueden contener letras (sin acentos), registro: '.$i.'--'.$datos[0].$datos[1].$nombre;
                $ban = false;
                break;
            }
            //if(preg_match('/^[a-zA-Z ]+$/', $datos[2])) echo "solo letras".$datos[2];
            //else echo "hay algo más";
            //$cad .= $datos[0].'--'.$datos[1].'--'.$datos[2].'--'.$datos[3].'<br>';
        }
    }else{
        $msgErr .= "Error al subir el archivo CSV.";
        $ban = false;
    }
    
    
    if($ban){
        //creamos el grupo
        $sqlInsertGroup = "INSERT INTO $tGrupo (nombre, escolar_id, grado_id, turno_id, profesor_id, created, updated) "
                . "VALUES ('$grupo', '$nivel', '$grado', '$turno', '$id', '$dateNow', '$dateNow') ";
        if($con->query($sqlInsertGroup) === TRUE){
            $idGroup = $con->insert_id;
            $csvFile = file($destinoCsv);
            $j = 0;
            //Insertamos materia
            $sqlInsertMat = "INSERT INTO $tMat (nombre, grupo_id) VALUES ('$mat', '$idGroup')";
            if($con->query($sqlInsertMat) === TRUE){
                foreach($csvFile as $linea_num => $linea){
                    //if($j == 0) continue;
                    $j++;
                    $linea = utf8_encode($linea);
                    $datos = explode(",", $linea);
                    if($j == 1) continue;
                    else{
                        //si no existe el alumno
                        //Obtenemos número de registros
                        $sqlGetNumAlum = "SELECT id FROM $tAlum ";
                        $resGetNumAlum = $con->query($sqlGetNumAlum);
                        $getNumAlum = $resGetNumAlum->num_rows;
                        //Creamos clave usuario y contraseña
                        $nombre2 = str_replace($sustituye, "", $datos[2]);
                        $nombre = $datos[0].' '.$datos[1].' '.$nombre2;
                        $apTmp = str_replace(' ', '', $datos[0]);
                        $clave = strtolower($datos[2]{0}).strtolower($apTmp).strtolower($datos[1]{0}).$getNumAlum;
                        $clave2 = generar_clave(10);
                        //Insertamos informacion del alumno
                        $sqlInsertInfoAlum = "INSERT INTO $tInfo (created, updated) VALUES ('$dateNow', '$dateNow') ";
                        if($con->query($sqlInsertInfoAlum) === TRUE){
                            $idInfo = $con->insert_id;
                            //Insertamos alumno
                            $sqlInsertAlum = "INSERT INTO $tAlum "
                                . "(nombre, user, pass, informacion_id, grupo_id, created, updated) "
                                . "VALUES ('$nombre', '$clave', '$clave2', '$idInfo', '$idGroup', '$dateNow', '$dateNow') ";
                            if($con->query($sqlInsertAlum) === TRUE){
                                continue;
                            }else{
                                $msgErr .= 'Error al insertar alumno.'.$j;
                                $ban = false;
                                break;
                            }
                        }else{
                            $msgErr .= 'Error al insertar información del alumno.'.$j;
                            $ban = false;
                            break;
                        }
                    }//end else j
                }//end foreach
            }else{
                $msgErr .= 'Error al crear materia.';
                $ban = false;
            }
        }else{
            $msgErr .= 'Error al crear grupo.';
            $ban = false;
        }
    }else{
        $msgErr .= "Hubo un error al validar CSV.";
        $ban = false;
    }
    
    
    if($ban){
        $cad .= 'Grupo añadido/actualizado con éxito';
        echo json_encode(array("error"=>0, "msgErr"=>$cad));
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