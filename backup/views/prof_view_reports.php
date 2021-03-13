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
<?php
    include ('navbar.php');
    if (!isset($_SESSION['sessU'])){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 2){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }
    else {
        
        $idPerfil = $_SESSION['perfil'];
        $idUser = $_SESSION['userId'];
        
?>

    <div class="container">
         <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <caption>Tus examenes asignados</caption>
                <thead>
                    <tr>
                        <th><span title="idExaAsig">Id</span></th>
                        <th><span title="nameExa">Nombre Examen</span></th>
                        <th><span title="createdExa">Fecha creación</span></th>
                        <th><span title="grado">Grado</span></th>
                        <th><span title="grupo">Grupo</span></th>
                        <th><span title="createdAsig">Fecha asignación</span></th>
                        <th><span title="numPregs"># de preguntas</span></th>
                        <th><span title="numAlums"># de alumnos</span></th>
                        <th><span title="numEvals"># de evaluados</span></th>
                        <th>Ver Estadisticas</th>
                        <th>Descargar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            
            filtrar();
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: {idProf: <?=$idUser;?>, ordenar: ordenar}, 
                   url: "../controllers/prof_get_info_exas.php",
                   success: function(msg){
                       //$("#data tbody").html(msg);
                       console.log(msg);
                       var msg = jQuery.parseJSON(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                                var newRow = '<tr>'
                                         +'<td>'+msg.dataRes[i].idExamAsig+'</td>'
                                         +'<td>'+msg.dataRes[i].nameExa+'</td>'
                                         +'<td>'+msg.dataRes[i].createdExa+'</td>'
                                         +'<td>'+msg.dataRes[i].grado+'</td>'
                                         +'<td>'+msg.dataRes[i].grupo+'</td>'
                                         +'<td>'+msg.dataRes[i].created+'</td>'
                                         +'<td>'+msg.dataRes[i].numPregs+'</td>'
                                         +'<td>'+msg.dataRes[i].numAlums+'</td>'
                                         +'<td>'+msg.dataRes[i].numEvals+'</td>'
                                         +'<td><a href="prof_view_report_details.php?idExam='+msg.dataRes[i].idExa+'&idExamAsig='+msg.dataRes[i].idExamAsig+'&idGrupo='+msg.dataRes[i].idGrupo+'"><span class="glyphicon glyphicon-stats"></span></a></td>'
                                         +'<td><a href="../controllers/prof_get_details_exam_excel.php?idExam='+msg.dataRes[i].idExa+'&idExamAsig='+msg.dataRes[i].idExamAsig+'&idGrupo='+msg.dataRes[i].idGrupo+'"><span class="glyphicon glyphicon-cloud-download"></span></a></td>'
                                    +'</tr>';
                                $(newRow).appendTo("#data tbody");
                            });
                       }else{
                           var newRow = '<tr><td colspan="9">'+msg.msgErr+'</td></tr>';
                           $("#data tbody").html(newRow);
                       }
                   }
               });
           }
            
            //Ordenar ASC y DESC header tabla
            $("#data th span").click(function(){
                if($(this).hasClass("desc")){
                    $("#data th span").removeClass("desc").removeClass("asc");
                    $(this).addClass("asc");
                    ordenar = "&orderby="+$(this).attr("title")+" asc";
                }else{
                    $("#data th span").removeClass("desc").removeClass("asc");
                    $(this).addClass("desc");
                    ordenar = "&orderby="+$(this).attr("title")+" desc";
                }
                filtrar();
            });
            
            
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
