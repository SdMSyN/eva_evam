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
    }else if($_SESSION['perfil'] != 3){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }
    else {
        
        $idPerfil = $_SESSION['perfil'];
        $idUser = $_SESSION['userId'];
        unset ( $_SESSION['exaRand'] );
        
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
                <caption>Tus exámenes</caption>
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="nameExa">Nombre</span></th>
                        <th><span title="nameMat">Materia</span></th>
                        <th><span title="nameProf">Profesor</span></th>
                        <th><span title="inicio">Periodo</span></th>
                        <th><span title="numPregs">Preguntas</span></th>
                        <th>Resultado</th>
                        <th>Realizar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
        <!-- modal para ver indicaciones -->
        <div class="modal fade bs-example-modal-lg" id="modalViewInst" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Indicaciones</h4>
                        <p class="msgModal"></p>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
           $('[data-toggle="tooltip"]').tooltip();
            
            filtrar();
            function filtrar(){
               $.ajax({
                   type: "POST",
                   data: ordenar, 
                   url: "../controllers/est_get_exams.php?idUser="+<?=$idUser;?>,
                   success: function(msg){
                       //alert(msg);
                       console.log(msg);
                       $("#data tbody").html(msg);
                       var msg = jQuery.parseJSON(msg);
                       var countExa = 0;
                       if(msg.error == 0){
                           //alert(msg.dataRes[0].id);
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                               var newRow = '<tr>'
                                    +'<td>'+msg.dataRes[i].id+'</td>'   
                                    +'<td>'+msg.dataRes[i].nombre+'</td>'   
                                    +'<td>'+msg.dataRes[i].materia+'</td>'   
                                    +'<td>'+msg.dataRes[i].prof+'</td>';   
                                newRow += '<td>('+msg.dataRes[i].inicio+' - '+msg.dataRes[i].fin+') ';
                                newRow += (msg.dataRes[i].disp == true) ? '[Disponible] </td>' : '[No disponible] </td>';
                                newRow += '<td>'+msg.dataRes[i].numPregs+'</td>';
                                newRow += (msg.dataRes[i].calif == null) ? '<td></td>' : '<td>'+msg.dataRes[i].calif+'</td>';
                                if(msg.dataRes[i].calif == null ){
                                    if(msg.dataRes[i].disp == true){
                                        //enviamos primero a modal previa
                                        //newRow += '<td><a href="est_app_exam.php?idExam='+msg.dataRes[i].idExam+'&idExamAsig='+msg.dataRes[i].id+'" class="btn"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        newRow += '<td><button type="button" class="btn btn-default" data-id-exam="'+msg.dataRes[i].idExam+'" data-id-exam-asig="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalViewInst"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        countExa++;
                                    }else
                                        newRow += '<td>Se te paso la fecha</td>';
                                }else{
                                    newRow += '<td><a href="est_app_exam_result.php?idExam='+msg.dataRes[i].idExam+'&idExamAsig='+msg.dataRes[i].id+'&idUser=<?=$idUser;?>">Ver resultados</a></td>';
                                }    
                                //newRow += (msg.dataRes[i].calif == null && msg.dataRes[i].disp == true) ? '<td><a href="est_app_exam.php?idExam='+msg.dataRes[i].idExam+'" class="btn"><span class="glyphicon glyphicon-pencil"></span></a></td>' : '<td>Ya no puedes</td>';
                                newRow += '</tr>';
                                $(newRow).appendTo("#data tbody");
                           });
                       }else{
                           var newRow = '<tr><td></td><td>'+msg.msgErr+'</td></tr>';
                           $("#data tbody").html(newRow);
                       }
                       $("#numExas").html(countExa);
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
            
            $('#modalViewInst').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var idExam = button.data('id-exam');
                var idExamAsig = button.data('id-exam-asig');
                console.log(idExam+"--"+idExamAsig);
                $.ajax({
                    type: "POST",
                    url: "../controllers/prof_get_asignaciones.php?idExam="+idExam+"&idExamAsig="+idExamAsig,
                    success: function(msg){
                        //alert(msg);
                        var msg = jQuery.parseJSON(msg);
                        var infoAsig = '<h1>Instrucciones</h1>';
                        if(msg.error == 0){
                            //msg.dataRes[0].
                            //Información
                            infoAsig += '<p>Estas por iniciar el examen de la materia de '+msg.dataRes[0].materia+' ';
                            infoAsig += 'acargo del profesor '+msg.dataRes[0].prof+'. ';
                            infoAsig += 'Tienes un límite de tiempo de '+msg.dataRes[0].tiempo+'</p>';
                            //Indicaciones
                            infoAsig += '<p>El examen solo será evaluado hasta que des clic en el botón de "Terminar examen" '
                                    +'si concluye tu tiempo y no diste clic en dicho botón será como si no hubieras respondido nada. '
                                    +'Así que ten cuídado y gestiona bien tu tiempo.';
                                    +'</p>';
                            infoAsig += '<p>Mucha suerte y que la fuerza este contigo.</p>';
                            infoAsig += '<a href="est_app_exam.php?idExam='+idExam+'&idExamAsig='+idExamAsig+'" class="btn btn-primary">Iniciar examen</a>';
                            $("#modalViewInst .modal-body").html(infoAsig);
                        }else{
                            var newRow = '<div class="row">'+msg.msgErr+'</div>';
                            $("#modalViewInst .modal-body").html(newRow);
                        }
                    }
                });
            });
            
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>