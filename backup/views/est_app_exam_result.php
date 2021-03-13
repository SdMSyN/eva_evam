<?php
    include ('header.php');
    include('../config/variables.php');
    include('../config/conexion.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
<!-- <link href="../assets/css/login.css" rel="stylesheet"> -->
</head>
    <body onload="notBack()">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Menú</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" target="_blank"><img src="../assets/obj/logoeva1.png" class="img-rounded"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <!-- añadimos el menú variable de acuerdo al perfil -->
                    <ul class="nav navbar-nav">
                        <?php include('../controllers/menu.php'); ?>
                    </ul>
                    <!-- Mensaje de bienvenida -->
                    <p class="nav navbar-nav navbar-right">
                        <?php
                            $cadWelcome="";
                            if(isset($_SESSION['sessU'])  AND $_SESSION['sessU'] == "true"){
                                $cadWelcome.= "Bienvenido ";
                                $cadWelcome.= $_SESSION['userName'];
                                $cadWelcome.='  <a href="../controllers/proc_destroy_login.php">Salir</a>   ';
                            }else{
                                $cadWelcome.='&nbsp;&nbsp;<a href="index.php">Iniciar Sesión</a>';
                                $cadWelcome .= '&nbsp;&nbsp; <a href="sign_up.php">Registrarse</a>';
                            }
                            echo '   '.$cadWelcome;
                        ?>
                    </p>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
<?php
    //include ('navbar.php');
    if (!isset($_SESSION['sessU'])){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 3){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }
    else {
        
        $idPerfil = $_SESSION['perfil'];
        $idUser = $_SESSION['userId'];
        $idExam = $_GET['idExam'];
        $idExamAsig = $_GET['idExamAsig'];
        
        //Obtenemos fecha de finalización del examen
        $sqlGetFechaFin = "SELECT fin FROM $tExaAsig WHERE id='$idExamAsig' ";
        $resGetFechaFin = $con->query($sqlGetFechaFin);
        $rowGetFechaFin = $resGetFechaFin->fetch_assoc();
        $fechaFin = $rowGetFechaFin['fin'];
        $buttonViewDetailsResult = '';
        //if($dateNow > $fechaFin){
            $buttonViewDetailsResult = '<a href="est_view_exam_details.php?idExam='.$idExam.'&idExamAsig='.$idExamAsig.'&idUser='.$idUser.'" '
                    . 'class="btn btn-success">Comprobar examen</a>';
        //}else{
            //$buttonViewDetailsResult = '<a href="#" '
                    //. 'class="btn btn-success" disabled>Comprobar examen</a>';
        //}
        //echo $idExamAsig;
?>

    <div class="container">
        <div class="row text-center">
            <h1>Resultado de tu examen</h1>
        </div>
        <!-- <div class="row">
            <div class="col-sm-12 text-center">
                <img src="../assets/obj/graduada.png" class="img-circle " >
            </div>
        </div> -->
        
        <div class="row">
            <div class="col-sm-6" id="resultLeft">
                <table class="table table-striped text-right"> 
                    <tr><td>Número de preguntas</td></tr>
                    <tr><td>Preguntas contestadas</td></tr>
                    <tr><td>Respuestas correctas</td></tr>
                    <tr><td>Respuestas incorrectas</td></tr>
                    <tr><td>Valor del examen</td></tr>
                    <tr><td>Valor obtenido</td></tr>
                    <tr><td>Porcentaje</td></tr>
                    <tr><td>Calificación Final</td></tr>
                </table>
            </div>
            <div class="col-sm-6" id="resultRight">
                <table class="table table-striped text-left" id="resultRightTable"></table>
            </div>
        </div>
        <div class="row">
            <?= $buttonViewDetailsResult; ?>
        </div>
        
    </div>

    <script type="text/javascript">
        function notBack(){
            window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button" //chrome
            window.onhashchange=function(){window.location.hash="no-back-button";}
        }
    </script>
    
    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            $.ajax({
                method: "POST",
                url: "../controllers/est_app_exam_result.php?idUser=<?=$idUser;?>&idExam=<?=$idExam;?>&idExamAsig=<?=$idExamAsig;?>",
                success: function(data){
                   //alert(data);
                   console.log(data);
                   var msg = jQuery.parseJSON(data);
                   if(msg.error == 0){
                        var newRow = '';
                            newRow += '<tr><td>'+msg.dataRes[0].numPregs+'</td></tr>';
                            newRow += '<tr><td>'+msg.dataRes[0].numPregsResp+'</td></tr>';
                            newRow += '<tr><td>'+msg.dataRes[0].numCorr+' <span class="glyphicon glyphicon-ok"></span></td></tr>';
                            newRow += '<tr><td>'+msg.dataRes[0].numInco+' <span class="glyphicon glyphicon-remove"></span></td></tr>';
                            newRow += '<tr><td>'+msg.dataRes[0].valorExa+'</td></tr>';
                            newRow += '<tr><td>'+msg.dataRes[0].valorAlum+'</td></tr>';
                            newRow += '<tr><td>'+msg.dataRes[0].porc+' <b>%</b></td></tr>';
                            newRow += '<tr><td>'+msg.dataRes[0].calif+'</td></tr>';
                        $("#resultRight #resultRightTable").html(newRow);
                   }else{
                       var newRow = '<tr><td></td><td>'+msg.msgErr+'</td></tr>';
                        $("#resultRight #resultRightTable").html(newRow);
                   }
                }
            })
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
