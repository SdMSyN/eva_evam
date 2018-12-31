<?php
    include ('../config/conexion.php');
    include ('../config/variables.php');
    
    $ban = false; 
    $msgErr = '';
    
    $idGrupo = $_GET['idGrupo'];
    $sqlGetGrupo = "SELECT $tGrupo.id as id, $tGrupo.nombre as nombre, "
            . "$tTurn.nombre as turno, $tGrado.nombre as grado "
            . "FROM $tGrupo "
            . "INNER JOIN $tGrado ON $tGrado.id=$tGrupo.nivel_grado_id "
            . "INNER JOIN $tTurn ON $tTurn.id=$tGrupo.nivel_turno_id "
            . "WHERE $tGrupo.id = '$idGrupo' ";
    $resGetGrupo = $con->query($sqlGetGrupo);
    $rowGetGrupo = $resGetGrupo->fetch_assoc();

    require ('../classes/fpdf/fpdf.php');
    class PDF extends FPDF{
        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',9);
            $this->Cell(0,10,utf8_decode('Plataforma EVAM, desarrollado por Software de México: Soluciones y Negocios S.A.S. de C.V. | http://solucionesynegocios.com.mx'),'T',0,'C');
        }

        function Header(){}
    }//Fin class PDF
    $pdf = new PDF();
    $pdf->AddPage('P', 'Letter');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,7,utf8_decode("Grado:"),1,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,7,utf8_decode($rowGetGrupo['grado']),1,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,7,utf8_decode("Grupo:"),1,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(60,7,utf8_decode($rowGetGrupo['nombre']),1,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,7,utf8_decode("Turno:"),1,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40,7,utf8_decode($rowGetGrupo['turno']),1,1,'L');
    $pdf->Ln(7);

    $sqlGetClass = "SELECT $tGrupoAlums.id as id, $tGrupoAlums.alumno_id as idAlum, "
            . "$tTut.id as idTut, $tTut.nombre as nombre, "
            . "$tTut.user as user, $tTut.pass as pass "
            . "FROM $tGrupoAlums "
            . "INNER JOIN $tAlum ON $tAlum.id=$tGrupoAlums.alumno_id "
            . "INNER JOIN $tTut ON $tTut.alumno_id=$tAlum.id "
            . "WHERE $tGrupoAlums.grupo_id='$idGrupo' AND $tAlum.activo=1  ";
    $resGetClass = $con->query($sqlGetClass);
    if($resGetClass->num_rows > 0){
        while($rowGetClass = $resGetClass->fetch_assoc()){
            $idAlumno = $rowGetClass['idTut'];
            $nombre = $rowGetClass['nombre'];
            $user = $rowGetClass['user'];
            $pass = $rowGetClass['pass'];
            $pdf->Cell(55,7,utf8_decode("http://evam.ide-educativo.com"),1,0,'L');
            $pdf->Cell(65,7,utf8_decode($nombre),1,0,'L');
            $pdf->Cell(45,7,utf8_decode($user),1,0,'L');
            $pdf->Cell(25,7,utf8_decode($pass),1,1,'L');
        }
    }else{
        $ban = false;
        $msgErr .= 'No tienes alumnos en éste grupo.';
        $pdf->Cell(190, 7, utf8_decode($msgErr), 1, 0, 'C');
    }
    
    $pdf->Output();
    
?>
