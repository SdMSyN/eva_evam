<?php
    include ('../config/conexion.php');
    include('../config/variables.php');
    $idExam = $_GET['idExam'];
    $idUser = $_GET['idUser'];

    $msgErr = '';
    $ban = true;
    $arrPregs = array();
    $idMat = $_POST['inputMateria'];
    
    $sqlGetPregs = "SELECT * FROM $tBPregs WHERE 1=1 ";

    /*$inName = $_POST['inputNombre'];
    $inTipoResp = $_POST['inputTypeResp'];
    $inCreador = $_POST['inputCreador'];*/
    $inNivs = isset($_POST['inputNiveles']) ? $_POST['inputNiveles'] : "";
    $inAreas = isset($_POST['inputAreas']) ? $_POST['inputAreas'] : "";
    $inMats = isset($_POST['inputMaterias']) ? $_POST['inputMaterias'] : "";
    $inTemas = isset($_POST['inputTemas']) ? $_POST['inputTemas'] : "";
    
    /*$sqlGetPregs .= ($inName != "") ? "AND nombre LIKE '%$inName%' " : "";
    $sqlGetPregs .= ($inTipoResp != "") ? "AND tipo_resp='$inTipoResp' " : "";
    $sqlGetPregs .= ($inCreador != "") ? "AND creado_por_id='$inCreador' " : "";
    $sqlGetPregs .= ($inBloque != "") ? "AND banco_bloque_id='$inBloque' " : "";*/
    //$sqlGetPregs .= ($inNivs != "") ? "AND banco_tema_id='$inNivs' " : "";
    $sqlGetPregs .= ($inAreas != "") ? "AND banco_materia_id='$inAreas' " : "";
    $sqlGetPregs .= ($inMats != "") ? "AND banco_bloque_id='$inMats' " : "";
    $sqlGetPregs .= ($inTemas != "") ? "AND banco_tema_id='$inTemas' " : "";
    
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetPregs .= " ORDER BY ".$vorder;
    }
    $sqlGetPregs .= " LIMIT 20";
    //echo $sqlGetPregs;
    $resGetPregs = $con->query($sqlGetPregs);
    if($resGetPregs->num_rows > 0){
        while($rowGetPregs = $resGetPregs->fetch_assoc()){
            $id = $rowGetPregs['id'];
            $nombre = $rowGetPregs['nombre'];
            $valorPreg = $rowGetPregs['valor_preg'];
            $tipoResp = $rowGetPregs['tipo_resp'];
            $creador = $rowGetPregs['creado_por_id'];
            $compartir = $rowGetPregs['compartir'];
            //if($creador != $idUser && $compartir == 0) continue;
            
            //Obtenemos el nombre de los profesores
            if($rowGetPregs['perfil_creador'] != 10){
                $sqlGetNameProf = "SELECT nombre FROM $tProf WHERE id='$creador' ";
                $resGetNameProf = $con->query($sqlGetNameProf);
                $rowGetNameProf = $resGetNameProf->fetch_assoc();
                $nameProf = $rowGetNameProf['nombre'];
            }else $nameProf = 'Error'.$con->error;
            
            $creadorNombre = ($rowGetPregs['perfil_creador'] == 10) ? 'Plataforma' : $nameProf;
            $arrPregs[] = array('id'=>$id, 'nombre'=>$nombre, 'valorPreg'=>$valorPreg, 
                'tipoResp'=>$tipoResp, 'creadorId'=>$creador, 'creadorNombre'=>$creadorNombre);
        }
    }else{
        $ban = false;
        $msgErr .= 'No existen preguntas.';
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrPregs));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }
?>