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
        
        $optH = '';
        for($i = 0; $i < 6; $i++){
            $optH .= '<option value="'.$i.'">'.$i.'</option>';
        }
        
        $optM = '';
        for($i = 0; $i < 60; $i++){
            $optM .= '<option value="'.$i.'">'.$i.'</option>';
        }
?>

    <div class="container">
        <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>

        <div class="row placeholder text-center">
            <div class="col-sm-12 placeholder">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd">
                    Crear nuevo Examen
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </div>
        <br>
        
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <caption>Tus exámenes</caption>
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="materia">Materia</span></th>
                        <th><span title="nombre">Nombre</span></th>
                        <th><span title="created">Creado</span></th>
                        <th><span title="numPregs"># preguntas</span></th>
                        <th>Añadir pregunta</th>
                        <th>Ver preguntas</th>
                        <th>Ver examen</th>
                        <th>Asignar</th>
                        <th>Ver asignaciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- modal para añadir exa_info -->
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Crear nuevo examen</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAdd" name="formAdd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="inputIdUser" value="<?= $idUser; ?>" >
                                <label for="inputName">Nombre: </label>
                                <input type="text" class="form-control" id="inputName" name="inputName" >
                            </div>
                            <div class="form-group">
                                <label for="inputMat">Materia: </label>
                                <select class="form-control" id="inputMat" name="inputMat"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- modal para asignar examen -->
        <div class="modal fade" id="modalAddAsig" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Asignar examen</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAddAsig" name="formAddAsig">
                        <div class="modal-body">
                            <input type="hidden" id="inputIdExam" name="inputIdExam">
                            <input type="hidden" id="inputIdProfe" name="inputIdProfe" value="<?=$idUser;?>">
                            
                            <div class="form-group">
                                <label for="inputGrado">Grado: </label>
                                <select class="form-control" id="inputGrado" name="inputGrado" ></select>
                            </div>
                            <div class="form-group">
                                <label for="inputGrupo">Grupo: </label>
                                <select class="form-control" id="inputGrupo" name="inputGrupo" ></select>
                            </div>
                            <div class="form-group">
                                <label for="inputMat">Materia: </label>
                                <select class="form-control" id="inputMat" name="inputMat" ></select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="inputBeginF">Fecha de inicio: </label>
                                        <input type="date" class="form-control" id="inputBeginF" name="inputBeginF" >
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputBeginH">Hora de inicio: </label>
                                        <input type="time" class="form-control" id="inputBeginH" name="inputBeginH" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="inputEndF">Fecha de fin: </label>
                                        <input type="date" class="form-control" id="inputEndF" name="inputEndF" >
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputEndH">Hora de fin: </label>
                                        <input type="time" class="form-control" id="inputEndH" name="inputEndH" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="inputH">¿Cuántas horas durará el examen?: </label>
                                        <select class="form-control" id="inputH" name="inputH" ><?=$optH;?></select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputM">¿Cuántos minutos durará el examen?: </label>
                                        <select class="form-control" id="inputM" name="inputM" ><?=$optM;?></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAle">¿Aleatorio?: </label>
                                <input type="checkbox" class="form-control" id="inputAle" name="inputAle" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- modal para ver asignaciones -->
        <div class="modal fade bs-example-modal-lg" id="modalViewAsig" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Asignaciones</h4>
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
            //obtenemos las materias del profesor
            $.ajax({
                type: "POST",
                data: {idProf: <?=$idUser;?>}, 
                url: "../controllers/prof_get_subjects.php",
                success: function(msg){
                    var msg = jQuery.parseJSON(msg);
                    if(msg.error == 0){
                        $("#modalAdd #inputMat").html("<option></option>");
                        $.each(msg.dataRes, function(i, item){
                            var newRow = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].mat+'</option>';
                            $(newRow).appendTo("#modalAdd #inputMat");
                        });
                    }else{
                        var newRow = '<option></option>';
                        $("#modalAdd #inputMat").html(newRow);
                    }
                }
            });
            
            filtrar();
            function filtrar(){
               $.ajax({
                   type: "POST",
                   data: ordenar, 
                   url: "../controllers/get_exams_info.php?idProf="+<?=$idUser;?>,
                   success: function(msg){
                       //alert(msg);
                       console.log(msg);
                       var msg = jQuery.parseJSON(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                               var newRow = '<tr>'
                                    +'<td>'+msg.dataRes[i].id+'</td>'   
                                    +'<td>'+msg.dataRes[i].materia+'</td>'   
                                    +'<td>'+msg.dataRes[i].nombre+'</td>'   
                                    +'<td>'+msg.dataRes[i].creado+'</td>' 
                                    +'<td>'+msg.dataRes[i].numPregs+'</td>'
                                    +'<td><a href="prof_add_preg.php?idExam='+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-plus-sign"></span><span class="glyphicon glyphicon-question-sign"></span></a></td>'
                                    +'<td></td>'
                                    +'<td><a href="prof_prev_exam.php?idExam='+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-eye-open"></span></a></td>'
                                    +'<td><button type="button" class="btn btn-default" data-whatever="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalAddAsig"><span class="glyphicon glyphicon-gift"></span></button></td>'
                                    +'<td><button type="button" class="btn btn-default" data-whatever="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalViewAsig"><span class="glyphicon glyphicon-eye-open"></span></button></td>'
                                    +'</tr>';
                                $(newRow).appendTo("#data tbody");
                           });
                       }else{
                           var newRow = '<tr><td></td><td>'+msg.msgErr+'</td></tr>';
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
            
            //añadir nuevo
            $('#formAdd').validate({
                rules: {
                    inputName: {required: true},
                    inputMat: {required: true}
                },
                messages: {
                    inputName: "Nombre del examen obligatorio",
                    inputMat: "Selecciona una materia"
                },
                tooltip_options: {
                    inputName: {trigger: "focus", placement: "bottom"},
                    inputMat: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/prof_add_exa_info.php",
                        data: $('form#formAdd').serialize(),
                        success: function(msg){
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#77DD77"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href = 'prof_view_exams.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#FF0000"});
                                $('.msgModal').html(msg.msgErr);
                            }
                        }, error: function(){
                            $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" >');
                            alert("Error al crear nuevo examen");
                        }
                    });
                }
            }); // end añadir nuevo examen
            
            //Colocar id examen en modal
            /* http://getbootstrap.com/javascript/#modals-related-target */
            $('#modalAddAsig').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var recipient = button.data('whatever') 
                var modal = $(this)
                modal.find('.modal-body #inputIdExam').val(recipient);
                //obtenemos grupo_id
                //con método onChange obtenemos 
                $.ajax({
                    type: "POST",
                    data: {idProf: <?=$idUser;?>},
                    url: "../controllers/prof_get_grade.php",
                    success: function(msg){
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            $("#modalAddAsig #inputGrado").html("<option></option>");
                            $("#modalAddAsig #inputGrupo").html("<option></option>");
                            $("#modalAddAsig #inputMat").html("<option></option>");
                            $("#modalAddAsig #inputBeginH").val("00:01");
                            $("#modalAddAsig #inputEndH").val("23:59");
                            $.each(msg.dataRes, function(i, item){
                                var newRow = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].nombre+'</option>';
                                $(newRow).appendTo("#modalAddAsig #inputGrado");
                            });
                        }else{
                            var newRow = '<option>'+msg.msgErr+'</option>';
                            $("#modalAddAsig #inputGrado").html(newRow);
                        }
                    }
                });
            });
            
            //Selec dinamico obtenemos grupos
            $("#inputGrado").change(function(){
                var idGrado = $("#modalAddAsig #inputGrado").val();
                $.ajax({
                    type: "POST",
                    data: {idProf: <?=$idUser;?>, idGrado: idGrado},
                    url: "../controllers/prof_get_group.php",
                    success: function(msg){
                        //alert(msg);
                        var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            $("#modalAddAsig #inputGrupo").html("<option></option>");
                            $("#modalAddAsig #inputMat").html("<option></option>");
                            $.each(msg.dataRes, function(i, item){
                                var newRow = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].nombre+'</option>';
                                $(newRow).appendTo("#modalAddAsig #inputGrupo");
                            });
                        }else{
                            var newRow = '<option>'+msg.msgErr+'</option>';
                            $("#modalAddAsig #inputGrupo").html(newRow);
                        }
                    }
                });
            });
            
            //Selec dinamico obtenemos materias
            $("#inputGrupo").change(function(){
                var idGrupo = $("#modalAddAsig #inputGrupo").val();
                $.ajax({
                    type: "POST",
                    data: {idGrupo: idGrupo},
                    url: "../controllers/prof_get_subjects_by_group.php",
                    success: function(msg){
                        //alert(msg);
                        var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            $("#modalAddAsig #inputMat").html("<option></option>");
                            $.each(msg.dataRes, function(i, item){
                                var newRow = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].nombre+'</option>';
                                $(newRow).appendTo("#modalAddAsig #inputMat");
                            });
                        }else{
                            var newRow = '<option>'+msg.msgErr+'</option>';
                            $("#modalAddAsig #inputMat").html(newRow);
                        }
                    }
                });
            });
            
            jQuery.validator.addMethod("dateRange", function() {
                var date1 = new Date($("#inputBeginF").val());
                var date2 = new Date($("#inputEndF").val());
                return (date1 <= date2);
            }, "Please check your dates. The start date must be before the end date.");
            //asignar nuevo examen
            $('#formAddAsig').validate({
                rules: {
                    inputGrado: {required: true},
                    inputGrupo: {required: true},
                    inputMat: {required: true},
                    inputBeginF: {required: true},
                    inputBeginH: {required: true},
                    inputEndF: {required: true, dateRange: true},
                    inputEndH: {required: true},
                    inputH: {required: true},
                    inputM: {required: true}
                },
                messages: {
                    inputGrado: "¿A qué grado pertece?",
                    inputGrupo: "¿No existen grupos?",
                    inputMat: "¿No das ninguna materia? Imposible",
                    inputBeginF: "Debes escoger que día aplicarán",
                    inputBeginH: "Por defecto te hemos puesto el inicio del día",
                    inputEndF:{ 
                        required: "¿Algún día debe de terminar, no crees?",
                        dateRange: "El fin no puede ser antes del inicio"
                    },
                    inputEndH: "La hora de finalización no puede ir vacía",
                    inputH: "Esto no puede ir vacio",
                    inputM: "Esto no puede ir vacio"
                },
                tooltip_options: {
                    inputGrado: {trigger: "focus", placement: "bottom"},
                    inputGrupo: {trigger: "focus", placement: "bottom"},
                    inputMat: {trigger: "focus", placement: "bottom"},
                    inputBeginF: {trigger: "focus", placement: "bottom"},
                    inputBeginH: {trigger: "focus", placement: "bottom"},
                    inputEndF: {trigger: "focus", placement: "bottom"},
                    inputEndH: {trigger: "focus", placement: "bottom"},
                    inputH: {trigger: "focus", placement: "bottom"},
                    inputM: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/prof_add_exa_asig.php",
                        data: $('form#formAddAsig').serialize(),
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#77DD77"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href = 'prof_view_exams.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 2000);
                            }
                        }, error: function(){
                            $('#loading').empty();
                            $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" >');
                            $('#loading').fadeOut(2000);
                            alert("Error al asignar examen");
                        }
                    });
                }
            }); // end asignar examen
            
            
            //función modal para ver asignaciones del examen
            $('#modalViewAsig').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var recipient = button.data('whatever') 
                //var modal = $(this)
                //var idExam = modal.find('.modal-body #inputIdExam').val(recipient);
                //alert(recipient);
                //obtenemos grupo_id
                //con método onChange obtenemos 
                $.ajax({
                    type: "POST",
                    url: "../controllers/prof_get_asignaciones.php?idExam="+recipient,
                    success: function(msg){
                        //alert(msg);
                        var msg = jQuery.parseJSON(msg);
                        var infoAsig = '<table class="table table-hover"><thead>';
                        infoAsig += '<tr><th>Grado</th><th>Grupo</th><th>Materia</th><th>Rango</th><th>Tiempo</th><th>Aleatorio</th><th>Asignado</th><th>Eliminar</th></tr><tbody>';
                        if(msg.error == 0){
                            $.each(msg.dataRes, function(i, item){
                                infoAsig += '<tr>';
                                    infoAsig += '<td>'+msg.dataRes[i].grado+'</td>';
                                    infoAsig += '<td>'+msg.dataRes[i].grupo+'</td>';
                                    infoAsig += '<td>'+msg.dataRes[i].materia+'</td>';
                                    infoAsig += '<td>('+msg.dataRes[i].inicio+') - ('+msg.dataRes[i].fin+')</td>';
                                    infoAsig += '<td>'+msg.dataRes[i].tiempo+'</td>';
                                    infoAsig += (msg.dataRes[i].aleatorio == 1) ? '<td>Si</td>' : '<td>No</td>';
                                    infoAsig += '<td>'+msg.dataRes[i].creado+'</td>';
                                    infoAsig += '<td><button class="btn btn-danger" id="delete" value="'+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-remove"></span></button></td>';
                                infoAsig += '</tr>';
                            });
                            infoAsig += '</tbody></table>';
                            $("#modalViewAsig .modal-body").html(infoAsig);
                        }else{
                            var newRow = '<div class="row">'+msg.msgErr+'</div>';
                            $("#modalViewAsig .modal-body").html(newRow);
                        }
                    }
                });
            });
            
            $("#modalViewAsig").on("click", "#delete", function(){
                var idAsig = $(this).val();
                //alert("Hola: "+idAsig);
                if(confirm("¿Seguro que deseas eliminar esta asignación?")){
                    $.ajax({
                         method: "POST",
                         url: "../controllers/prof_delete_asignacion.php?idAsig="+idAsig,
                         success: function(data){
                            //alert(data);
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loader').empty();
                                $('#loader').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('#loader').append('<p>'+msg.dataRes+'</p>');
                                setTimeout(function () {
                                  location.href = 'prof_view_exams.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                $('.msgModal').css({color: "#FF0000"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 1500);
                            }
                         }
                     })
                }else{
                    alert("Ten cuidado.");
                }
            });
            
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>