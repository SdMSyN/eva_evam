<?php
	
    date_default_timezone_set('America/Mexico_City');
    $host="localhost";
    $user="ideeduc_adan";
    $pass="Txg7+!!Axg7";
    $db="ideeduc_eva";
    $con=mysqli_connect($host, $user, $pass, $db);
    if($con->connect_error){
            die("Connection failed: ".$con->connect_error);
    }
    //echo 'Hola';

    //Tablas Usuarios
//    $tAdm = "usuarios_admins";
//    $tEsc = "usuarios_escuelas";
        $tProf = "usuarios_profesores";
        $tAlum = "usuarios_alumnos";
//    $tTut = "usuarios_tutores";
        $tInfo = "usuarios_informacion";
//
//    //Tablas Niveles
        $tTurn = "nivel_turnos";
        $tNivEsc = "nivel_escolaridades";
        $tGrado = "nivel_grados";
        $tGrupo = "nivel_grupos";
//    
//    //Tablas de Banco
        $tMat = "materias";
//    $tBloq = "banco_bloques";
//    $tTema = "banco_temas";
//    $tSubTema = "banco_subtemas";
//
//    //Tablas Clases
//    $tAlumMat = "alumno_materias";
//    
//    //Tablas de Examenes
        $tExaInf = "exa_info";
        $tExaAsig = "exa_info_asignacion";
        $tExaPregs = "exa_preguntas";
        $tExaResps = "exa_respuestas";
//    $tExaSubPregs = "exa_subpreguntas"; 
//    $tExaSubReps = "exa_subrespuestas"; 
        $tExaTmp = "exa_respuestas_alumno_tmp";
        $tExaTime = "exa_tiempos_alumno";
        $tExaResultInfo = "exa_result_info"; 
        $tExaResultPregs = "exa_result_preguntas";
        
?>