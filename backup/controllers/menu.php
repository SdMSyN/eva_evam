<?php

    if(isset($_SESSION['sessU'])  AND $_SESSION['sessU'] == "true"){
        $cadMenuNavbar='';
        if($_SESSION['perfil'] == "1"){//Escuela
            $cadMenuNavbar .= '<li><a href="index_escuela.php">Menú Escuela</a></li>';
            $cadMenuNavbar .= '<li><a href="esc_add_group.php">Grupos</a></li>';
        } else if($_SESSION['perfil'] == "2"){//Profesor
            $cadMenuNavbar .= '<li><a href="index_profesor.php">Inicio Profesor</a></li>';
            $cadMenuNavbar .= '<li><a href="prof_view_class.php">Clases</a></li>';
            $cadMenuNavbar .= '<li><a href="prof_view_exams.php">Exámenes</a></li>';
            $cadMenuNavbar .= '<li><a href="prof_view_reports.php">Reportes</a></li>';
        } else if($_SESSION['perfil'] == "3"){//Alumno
            $cadMenuNavbar .= '<li><a href="index_estudiante.php">Menú Alumno</a></li>';
            $cadMenuNavbar .= '<li><a href="est_view_exams.php">Exámenes <span class="badge" id="numExas"></span></a></li>';
        } else if($_SESSION['perfil'] == "4"){//Tutor
            $cadMenuNavbar .= '<li><a href="#">Menu Tutor</a></li>';
        } else if($_SESSION['perfil'] == "10"){
            $cadMenuNavbar .= '<li><a href="index_admin.php">Menú Administrador</a></li>';
            $cadMenuNavbar .= '<li><a href="admin_add_banco_niveles.php">Bancos</a></li>';
        }else{
            $cadMenuNavbar .= '<li>¿Cómo llegaste hasta acá?</li>';
        }
        echo $cadMenuNavbar;
    }
	
?>