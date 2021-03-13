<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $exams = array();
    $msgErr = '';
    $ban = true;
    $idExam = $_GET['idExam']; 
    $idExamAsig = $_GET['idExamAsig']; 
    $idGrupo = $_GET['idGrupo']; 
    
    $arrIdsPregs = array();
    $arrValPregs = array();
    $arrStudents = array();
    
    //Obtenemos info del grupo
    $sqlGetInfoGroup = "SELECT $tGrupo.nombre as grupo, $tGrado.nombre as grado "
            . "FROM $tGrupo "
            . "INNER JOIN $tGrado ON $tGrado.id=$tGrupo.grado_id "
            . "WHERE $tGrupo.id='$idGrupo' ";
    $resGetInfoGroup = $con->query($sqlGetInfoGroup);
    $rowGetInfoGroup = $resGetInfoGroup->fetch_assoc();
    $nameGroup = $rowGetInfoGroup['grado'].' - '.$rowGetInfoGroup['grupo'];
    
    //Obtenemos info del examen
    $sqlGetInfoExa = "SELECT * FROM $tExaInf WHERE id='$idExam' ";
    $resGetInfoExa = $con->query($sqlGetInfoExa);
    $rowGetExaInfo = $resGetInfoExa->fetch_assoc();
    $nameExa = $rowGetExaInfo['nombre'];
    
    // Creamos Excel
	include ('../classes/PHPExcel/PHPExcel.php');
	$objPHPExcel = new PHPExcel();
	//Propiedades del Excel
	$objPHPExcel->
    getProperties()
        ->setCreator("Business Software Solutions")
        ->setLastModifiedBy("Business Software Solutions")
        ->setTitle("Detalles de la clase")
        ->setSubject("E. V. A.")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("Business Software Solutions")
        ->setCategory("E. V. A."); 
    // Título y nombre de las columnas
	$tituloReporte = "Reporte del Examen (".$nameExa.") del ".$nameGroup;
        $tituloColumnas = array('Nombre del alumno');
	/*$titulosColumnas = array('Nombre', 'Buenas', 'Malas', 'Sin Respuesta', 'Puntaje', 'Calificación');
	$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:E1');
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', $tituloReporte)
		->setCellValue('A3', $titulosColumnas[0])
		->setCellValue('B3', $titulosColumnas[1])
		->setCellValue('C3', $titulosColumnas[2])
		->setCellValue('D3', $titulosColumnas[3])
		->setCellValue('E3', $titulosColumnas[4])
		->setCellValue('F3', $titulosColumnas[5]);*/
    
    // Obtener número de preguntas
    // Obtener alumnos
    // Obtener detalles de las preguntas respondidas
    // Obtener números generales
    $sqlGetPregs = "SELECT id, nombre, valor_preg FROM $tExaPregs WHERE exa_info_id='$idExam' ";
    $resGetPregs = $con->query($sqlGetPregs);
    $valorExa = 0; $numPregs = 0;
    if($resGetPregs->num_rows > 0){
        $numPregs = $resGetPregs->num_rows;
        while($rowGetPregs = $resGetPregs->fetch_assoc()){
            $idPreg = $rowGetPregs['id'];
            $namePreg = $rowGetPregs['nombre'];
            $valorPreg = $rowGetPregs['valor_preg'];
            $valorExa += $valorPreg;
            $arrIdsPregs[] = $idPreg;
            $arrValPregs[] = $valorPreg;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen preguntas.<br>'.$con->error;
    }
    
    for($i = 1; $i <= $numPregs; $i++){
        $tituloColumnas[] = 'Preg '.$i;
    }
    $tituloColumnas[] =  'Buenas';
    $tituloColumnas[] = 'Malas';
    $tituloColumnas[] = 'Sin Respuesta';
    $tituloColumnas[] = 'Puntaje';
    $tituloColumnas[] = 'Calificación';
    $countColTit = $numPregs;
    $arrLetters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:'.$arrLetters[count($tituloColumnas)].'1');
    $objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', $tituloReporte);
    $countColTit = count($tituloColumnas);
    for($j = 0; $j < $countColTit; $j++){
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($arrLetters[$j].'3', $tituloColumnas[$j]);
    }
                    
    if($ban){
        $sqlGetStudents = "SELECT id, nombre FROM $tAlum WHERE grupo_id='$idGrupo' ";
        $resGetStudents = $con->query($sqlGetStudents);
        if($resGetStudents->num_rows > 0){
            $count = 4;
            $numAlums = $resGetStudents->num_rows;
            $buenasCount = 0; $malasCount = 0; $sinRespCount = 0; $valorExaAlumCount = 0; $califCount = 0;
            $buenasArr = array(); $malasArr = array(); $sinRespArr = array();
            for($z=0; $z<$numPregs; $z++){
                $buenasArr[$z] = 0;
                $malasArr[$z] = 0;
                $sinRespArr[$z] = 0;
            }
            while($rowGetStudents = $resGetStudents->fetch_assoc()){
                $idAlum = $rowGetStudents['id'];
                $nameAlum = $rowGetStudents['nombre'];
                $arrCalifPregs = array();
                foreach($arrIdsPregs as $idPregArr){
                    $sqlGetResp = "SELECT calificacion "
                        . "FROM $tExaResultPregs "
                        . "WHERE exa_info_id='$idExam' AND exa_info_asig_id='$idExamAsig' "
                        . "AND alumno_id='$idAlum' AND pregunta_id='$idPregArr' ";
                    //echo $sqlGetResp; 
                    $resGetResp = $con->query($sqlGetResp);
                    if($resGetResp->num_rows > 0){
                        $rowGetResp = $resGetResp->fetch_assoc();
                        $calif = $rowGetResp['calificacion'];
                        $arrCalifPregs[] = $calif;
                    }else{
                        $arrCalifPregs[] = 2;
                    }
                }
                $sqlGetResultInfo = "SELECT * FROM $tExaResultInfo "
                        . "WHERE exa_info_id='$idExam' AND exa_info_asig_id='$idExamAsig' AND alumno_id='$idAlum' ";
                $resGetResultInfo = $con->query($sqlGetResultInfo);
                $rowGetResultInfo = $resGetResultInfo->fetch_assoc();
                $buenas = $rowGetResultInfo['resp_buenas'];
                $malas = $rowGetResultInfo['resp_malas'];
                $sinResp = $numPregs - ($buenas + $malas);
                $valorExaAlum = $rowGetResultInfo['valor_exa_alum'];
                $calificacion = $rowGetResultInfo['calificacion'];

                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$count, $nameAlum);
                $countArrCalifPreg = count($arrCalifPregs);
                for($m = 0; $m < $countArrCalifPreg; $m++){
                    if($arrCalifPregs[$m] == 0){
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue($arrLetters[$m+1].''.$count, 'I');
                        $malasArr[$m] = $malasArr[$m] + 1;
                    }else if($arrCalifPregs[$m] == 1){
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue($arrLetters[$m+1].''.$count, 'C');
                        $buenasArr[$m] = $buenasArr[$m] + 1;
                    }else if($arrCalifPregs[$m] == 2){
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue($arrLetters[$m+1].''.$count, 'N');
                        $sinRespArr[$m] = $sinRespArr[$m] + 1;
                    }else{
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue($arrLetters[$m+1].''.$count, 'Error');
                    }
                }
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($arrLetters[$countArrCalifPreg+1].''.$count, $buenas)
                        ->setCellValue($arrLetters[$countArrCalifPreg+2].''.$count, $malas)
                        ->setCellValue($arrLetters[$countArrCalifPreg+3].''.$count, $sinResp)
                        ->setCellValue($arrLetters[$countArrCalifPreg+4].''.$count, $valorExaAlum)
                        ->setCellValue($arrLetters[$countArrCalifPreg+5].''.$count, $calificacion);
                $buenasCount += $buenas;
                $malasCount += $malas;
                $sinRespCount += $sinResp;
                $valorExaAlumCount += $valorExaAlum;
                $califCount += $calificacion;
                $count++;
            }
            $count++;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$count, 'Total de alumnos: '.$numAlums);
            $count++;
            $promB = (($buenasCount/$numAlums)*100)/$numPregs;
            $promM = (($malasCount/$numAlums)*100)/$numPregs;
            $promSR = (($sinRespCount/$numAlums)*100)/$numPregs;
            $promV = $valorExaAlumCount/$numAlums;
            $promC = $califCount/$numAlums;
            //echo $buenasCount.'--'.$malasCount.'--'.$valorExaAlumCount.'--'.$califCount.'--'.$numAlums.'<br>';
            //echo $promB.'--'.$promM.'--'.$promV.'--'.$promC;
            $count+=2;
            $objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$count, 'Correctas')
		->setCellValue('A'.($count+1), 'Incorrectas')
		->setCellValue('A'.($count+2), 'No contestadas');
            for($z=0; $z<$numPregs; $z++){
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($arrLetters[$z+1].''.$count, $buenasArr[$z]);
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($arrLetters[$z+1].''.($count+1),$malasArr[$z]);
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($arrLetters[$z+1].''.($count+2),$sinRespArr[$z]);
            }
            $count-=2;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$count, 'Promedios: ')
                    ->setCellValue($arrLetters[$numPregs+1].''.$count, $promB.' %')
                    ->setCellValue($arrLetters[$numPregs+2].''.$count, $promM.' %')
                    ->setCellValue($arrLetters[$numPregs+3].''.$count, $promSR.' %')
                    ->setCellValue($arrLetters[$numPregs+4].''.$count, $promV)
                    ->setCellValue($arrLetters[$numPregs+5].''.$count, $promC);
            
        }else{
            $ban = false;
            $msgErr .= 'No hay alumnos en éste grupo.';
        }
    }
    
     
    
    //Estilos para la hoja de Excel
	$estiloTituloReporte = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array(
                    'argb' => 'FF220835')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
 
        $estiloTituloColumnas = array(
            'font' => array(
                'name'  => 'Arial',
                'bold'  => true,
                'color' => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' => array(
                'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
            'rotation'   => 90,
                'startcolor' => array(
                    'rgb' => 'c47cf2'
                ),
                'endcolor' => array(
                    'argb' => 'FF431a5d'
                )
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
            'alignment' =>  array(
                'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'      => TRUE
            )
        );
 
        $estiloInformacion = new PHPExcel_Style();
        $estiloInformacion->applyFromArray( array(
            'font' => array(
                'name'  => 'Arial',
                'color' => array(
                    'rgb' => '000000'
                )
            ),
            'fill' => array(
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array(
                    'argb' => 'FFd9b7f4')
            ),
            'borders' => array(
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                'color' => array(
                        'rgb' => '3a2a47'
                    )
                )
            )
        ));
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$arrLetters[$countColTit].'1')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('A3:'.$arrLetters[$countColTit].'3')->applyFromArray($estiloTituloColumnas);
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:".$arrLetters[$countColTit]."".($count-1));
        
        $objPHPExcel->getActiveSheet()->getStyle($arrLetters[$numPregs+1].''.$count)->getNumberFormat()->setFormatCode('#.##0');
        $objPHPExcel->getActiveSheet()->getStyle($arrLetters[$numPregs+2].''.$count)->getNumberFormat()->setFormatCode('#.##0');
        $objPHPExcel->getActiveSheet()->getStyle($arrLetters[$numPregs+3].''.$count)->getNumberFormat()->setFormatCode('#.##0');
        $objPHPExcel->getActiveSheet()->getStyle($arrLetters[$numPregs+4].''.$count)->getNumberFormat()->setFormatCode('#.##0');
        $objPHPExcel->getActiveSheet()->getStyle($arrLetters[$numPregs+5].''.$count)->getNumberFormat()->setFormatCode('#.##0');
	//Asignación de columnas
	for($m = 'A'; $m <= $arrLetters[$countColTit]; $m++){
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($m)->setAutoSize(TRUE);
	}


	if($msgErr != ''){
		echo $msgErr;
	}else{
            //echo $table;
            // Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Reporte');
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
            // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="reporte_examen.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
	}
	
        
    /*if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$arrStudents));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }*/

?>