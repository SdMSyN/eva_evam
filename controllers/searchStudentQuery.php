<?php

include ('../config/conexion.php');
include ('../config/variables.php');
$descuento = array();
$query = $_POST['queryStudent'];
$idGrupo = $_POST['idGrupo'];
$ban = false;
$msgErr = '';

$sqlGetStudent = "SELECT id "
    . "FROM $tAlum "
    . "WHERE nombre LIKE '%$query%' ";

$resGetStudent = $con->query($sqlGetStudent);
if ($resGetStudent->num_rows > 0) {
    $rowGetStudent = $resGetStudent->fetch_assoc();
    $idAlum = $rowGetStudent['id'];
    $sqlSearchStudent = "SELECT id FROM $tGrupoAlums WHERE grupo_id = '$idGrupo' AND alumno_id = '$idAlum' ";
    $resSearchStudent = $con->query($sqlSearchStudent);
    if($resSearchStudent->num_rows > 0){
        $ban = false;
        $msgErr .= 'Error: El alumno ya existe en éste grupo.';
    }else{
        //Si no existe, insertamos.
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
    }
} else {
    $ban = false;
    $msgErr .= 'Error: No existe el alumno.';
}

if ($ban) {
    $msgErr = "Alumno añadido con éxito.";
    echo json_encode(array("error" => 0, "msgErr" => $msgErr));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql"=>$sqlSearchStudent));
}

?>