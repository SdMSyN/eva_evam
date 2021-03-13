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
        
        //Obtener niveles
        $sqlGetNiveles = "SELECT * FROM $tNivEsc ";
        $resGetNiveles = $con->query($sqlGetNiveles);
        $optNivel = '<option></option>';
        if($resGetNiveles->num_rows > 0){
            while($rowGetNivel = $resGetNiveles->fetch_assoc()){
                $optNivel .= '<option value="'.$rowGetNivel['id'].'">'.$rowGetNivel['nombre'].'</option>';
            }
        }else{
            $optNivel .= '<option>No hay niveles</option>';
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
                    Importar nuevo grupo
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <caption>Tus clases</caption>
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="escolar">Nivel</span></th>
                        <th><span title="turno">Turno</span></th>
                        <th><span title="grado">Grado</span></th>
                        <th><span title="nombre">Grupo</span></th>
                        <th><span title="#">Materia</span></th>
                        <th># de alumnos</th>
                        <th>Ver Grupo</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
        <!-- Modal para añadir clase -->
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Añadir nuevo grupo</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAdd" name="formAdd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="inputIdUser" value="<?= $idUser; ?>" >
                                <label for="inputNivel">Nivel: </label>
                                <select class="form-control" id="inputNivel" name="inputNivel"><?=$optNivel;?></select>
                            </div>
                            <div class="form-group">
                                <label for="inputGrado">Grado: </label>
                                <select class="form-control" id="inputGrado" name="inputGrado"></select>
                            </div>
                            <div class="form-group">
                                <label for="inputGrupo">Grupo: </label>
                                <input type="text" class="form-control" id="inputGrupo" name="inputGrupo" >
                            </div>
                            <div class="form-group">
                                <label for="inputTurno">Turno: </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inputTurno" id="inputTurno" value="1"> Matutino
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inputTurno" id="inputTurno" value="2"> Vespertino
                                </label>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="inputMat">Materia: </label>
                                <input type="text" class="form-control" id="inputMat" name="inputMat" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="inputFile">Archivo CSV 
                                    <a href="#" data-toggle="tooltip" title="Archivo Excel en formato CSV (archivo separado por comas), 3 campos: Apellido paterno, Apellido Materno y Nombre(s)"><span class="glyphicon glyphicon-question-sign"></span></a>
                                    <a href="../uploads/plantilla.csv" data-toggle="tooltip" title="Descargar formato"><span class="glyphicon glyphicon-download-alt"></span></a>
                                    : </label>
                                <input type="file" class="form-control" id="inputFile" name="inputFile" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
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
                   data: {idProf: <?=$idUser;?>, ordenar: ordenar}, 
                   url: "../controllers/prof_get_class.php",
                   success: function(msg){
                       $("#data tbody").html(msg);
                       console.log(msg);
                       var msg = jQuery.parseJSON(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                                var newRow = '<tr>'
                                         +'<td>'+msg.dataRes[i].id+'</td>'
                                         +'<td>'+msg.dataRes[i].escolar+'</td>'
                                         +'<td>'+msg.dataRes[i].turno+'</td>'
                                         +'<td>'+msg.dataRes[i].grado+'</td>'
                                         +'<td>'+msg.dataRes[i].grupo+'</td>';
                                //$.each(msg.dataRes[i].mats, function(j, item2){
                                         newRow += '<td>'+msg.dataRes[i].mat+'</td>';
                                //});
                                    newRow += '<td>'+msg.dataRes[i].numStudents+'</td>'
                                            +'<td><a href="prof_view_class_details.php?idGrupo='+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-eye-open"></span></a></td>'
                                            +'</tr>';
                                $(newRow).appendTo("#data tbody");
                            });
                       }else{
                           var newRow = '<tr><td colspan="7">'+msg.msgErr+'</td></tr>';
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
            
            //Selec dinamico obtenemos grados
            $("#inputNivel").change(function(){
                $.ajax({
                    url:"../controllers/get_grados.php",
                    type: "POST",
                    data:"idNivel="+$("#inputNivel").val(),
                    success: function(opciones){
                        var msg = jQuery.parseJSON(opciones);
                        if(msg.error == 0){
                            $("#modalAdd #inputGrado").html("");
                            $("#modalAdd #inputGrado").html('<option></option>');
                            $.each(msg.dataRes, function(i, item){
                                var newOpt = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].nombre+'</option>';
                                $(newOpt).appendTo("#modalAdd #inputGrado");
                            });
                        }else{
                            $("#modalAdd #inputGrado").html("");
                            $("#modalAdd #inputGrado").html("<option>"+msg.msgErr+"</option>");
                        }
                    }
                })
            });
            
            //añadir nuevo grupo
           $('#formAdd').validate({
                rules: {
                    inputNivel: {required: true},
                    inputGrado: {required: true},
                    inputGrupo: {required: true},
                    inputTurno: {required: true},
                    inputMat: {required: true},
                    inputFile: {required: true, extension: "csv"}
                },
                messages: {
                    inputNivel: "Nivel obligatorio",
                    inputGrado: "Grado obligatorio",
                    inputGrupo: "¿De qué grupo es?",
                    inputTurno: "¿Cuál es el turno?",
                    inputMat: "Es obligatorio el nombre de la materia",
                    inputFile: { 
                        required: "Se requiere un archivo",
                        extension: "Solo se permite archivos *.csv (archivo separado por comas de Excel)"
                    }
                },
                tooltip_options: {
                    inputNivel: {trigger: "focus", placement: "bottom"},
                    inputGrado: {trigger: "focus", placement: "bottom"},
                    inputGrupo: {trigger: "focus", placement: "bottom"},
                    inputTurno: {trigger: "focus", placement: "bottom"},
                    inputFile: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/prof_add_group.php",
                        data: new FormData($("form#formAdd")[0]),
                        //data: $('form#formAdd').serialize(),
                        contentType: false,
                        processData: false,
                        success: function(msg){
                            console.log(msg);
                            //alert(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#77DD77"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href = 'prof_view_class.php';
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
                        }, error: function(){
                            alert("Error al crear/actualizar grupo");
                        }
                    });
                }
            }); // end añadir nuevo grupo
            
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>
