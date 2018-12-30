<?php
    include ('header.php');
    include('../config/variables.php');
    include('../config/conexion.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
</head>
    <body>
<?php
    include ('navbar.php');
    if (!isset($_SESSION['sessU'])){
        echo '<div class="row><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 2){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }else {
        $idUser = $_SESSION['userId'];
        $idPerfil = $_SESSION['perfil'];
        $cantAlum = $_SESSION['cantAlum'];

?>

    <div class="container">
        <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <div class="row text-center"><h1>Grupos</h1></div>
        <div class="row placeholder text-center">
            <div class="col-sm-12 placeholder">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd">
                    Crear nuevo grupo
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="grado">Grado</span></th>
                        <th><span title="nombre">Grupo</span></th>
                        <th><span title="turno">Turno</span></th>
                        <th><span title="materia">Materia</span></th>
                        <th><span title="numAlums">Núm. Alumnos</span></th>
                        <th>Ver alumnos</th>
                        <th>Ver tutores</th>
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
                        <h4 class="modal-title" id="exampleModalLabel">Crear nuevo grupo</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAdd" name="formAdd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="inputIdUser" value="<?= $idUser; ?>" >
                                <input type="hidden" name="inputCantAlums" value="<?= $cantAlum; ?>" >
                                <input type="hidden" name="inputAlums" id="inputAlums" >
                            </div>
                            <div class="form-group">
                                <label for="inputNivel">Nivel: </label>
                                <select class="form-control" id="inputNivel" name="inputNivel"></select>
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
                                <select class="form-control" id="inputMat" name="inputMat"></select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="inputFile">Archivo CSV 
                                    <a href="#" data-toggle="tooltip" title="Archivo Excel en formato CSV (archivo separado por comas), 3 o 4 campos: Apellido paterno, Apellido Materno, Nombre(s) y Usuario [opcional]">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    <a href="../uploads/plantillaGrupo.csv" data-toggle="tooltip" title="Descargar formato">
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                    </a>
                                : </label>
                                <input type="file" class="form-control" id="inputFile" name="inputFile" >
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
    </div>
      
    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
           filtrar();
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: ordenar, 
                   url: "../controllers/prof_read_grupos.php?idProf="+<?=$idUser;?>,
                   success: function(msg){
                       console.log(msg);
                       var msg = jQuery.parseJSON(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                               var newRow = '<tr>'
                                    +'<td>'+msg.dataRes[i].id+'</td>'   
                                    +'<td>'+msg.dataRes[i].grado+'</td>'   
                                    +'<td>'+msg.dataRes[i].nombre+'</td>' 
                                    +'<td>'+msg.dataRes[i].turno+'</td>' 
                                    +'<td>'+msg.dataRes[i].materia+'</td>' 
                                    +'<td>'+msg.dataRes[i].numAlums+'</td>' 
                                    +'<td><a href="prof_read_grupo_alumno.php?idGrupo='+msg.dataRes[i].id+'" class="btn btn-default"><span class="glyphicon glyphicon-list"></span></a></td>'
                                    +'<td><a href="esc_read_grupo_tutores.php?idGrupo='+msg.dataRes[i].id+'" class="btn btn-default"><span class="glyphicon glyphicon-list"></span></a></td>'
                                    +'</tr>';
                                $(newRow).appendTo("#data tbody");
                           });
                           var rowTotal = '<tr><td colspan="5" class="text-right"><b>Total:</b></td><td>'+msg.totalAlum+' de <?= $cantAlum; ?></td><td></td><td></td></tr>';
                           $(rowTotal).appendTo("#data tbody");
                           $("#modalAdd #inputAlums").val(msg.totalAlum);
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

            //Buscamos los diferentes niveles escolares
            $.ajax({
                type: "POST",
                url: "../controllers/get_niveles.php",
                success: function(msg){
                    var msg = jQuery.parseJSON(msg);
                    $("#modalAdd #inputNivel").append($('<option>', {
                        value: 0,
                        text: ""
                    }));
                    if(msg.error == 0){
                        $.each(msg.dataRes, function (i, item) {
                            $("#modalAdd #inputNivel").append($('<option>', {
                                value: msg.dataRes[i].id,
                                text: msg.dataRes[i].nombre
                            }));
                        });
                    }else{
                        $("#modalAdd #inputNivel").append($('<option>', {
                            value: 0,
                            text: msg.msgErr
                        }));
                    }
                }, error: function(){
                    console.log("Error al cargar niveles");
                }
            });
            
            //Declaramos nivel como variable global
            var idNivel = 0;
            //Obtenemos los grados en base al nivel seleccionado
            $("#inputNivel").on('change', function(){
                idNivel = $(this).val();
                console.log(idNivel);
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_grados.php?idNivel="+idNivel,
                    success: function(msg){
                        var msg = jQuery.parseJSON(msg);
                        $("#modalAdd #inputGrado").html("");
                        $("#modalAdd #inputGrado").append($('<option>', {
                            value: 0,
                            text: ""
                        }));
                        if(msg.error == 0){
                            $.each(msg.dataRes, function (i, item) {
                                $("#modalAdd #inputGrado").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                        }else{
                            $("#modalAdd #inputGrado").append($('<option>', {
                                value: 0,
                                text: msg.msgErr
                            }));
                        }
                    }, error: function(){
                        console.log("Error al cargar grados");
                    }
                });
            })
            
            //Obtenemos las materias en base al grado seleccionado
            $("#inputGrado").on('change', function(){
                var idGrado = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_materias.php?idNivel="+idNivel+"&idGrado="+idGrado,
                    success: function(msg){
                        var msg = jQuery.parseJSON(msg);
                        $("#modalAdd #inputMat").html("");
                        $("#modalAdd #inputMat").append($('<option>', {
                            value: 0,
                            text: ""
                        }));
                        if(msg.error == 0){
                            $.each(msg.dataRes, function (i, item) {
                                $("#modalAdd #inputMat").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                        }else{
                            $("#modalAdd #inputMat").append($('<option>', {
                                value: 0,
                                text: msg.msgErr
                            }));
                        }
                    }, error: function(){
                        console.log("Error al cargar materias");
                    }
                });
            })
            
            //añadir nuevo grupo
            $('#formAdd').validate({
                rules: {
                    inputNivel: {required: true},
                    inputGrado: {required: true},
                    inputGrupo: {required: true},
                    inputTurno: {required: true},
                    inputMat: {required: true},
                    inputFile: {extension: "csv"}
                },
                messages: {
                    inputNivel: "¿A qué nivel escolar pertenece?",
                    inputGrado: "Grado obligatorio",
                    inputGrupo: "¿De qué grupo es?",
                    inputTurno: "¿Cuál es el turno?",
                    inputMat: "Selecciona la materia que impartirás",
                    inputFile: "Solo se permite archivos *.csv (archivo separado por comas de Excel)"
                },
                tooltip_options: {
                    inputNivel: {trigger: "focus", placement: "bottom"},
                    inputGrado: {trigger: "focus", placement: "bottom"},
                    inputGrupo: {trigger: "focus", placement: "bottom"},
                    inputTurno: {trigger: "focus", placement: "bottom"},
                    inputMat: {trigger: "focus", placement: "bottom"},
                    inputFile: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/prof_create_grupo.php",
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
                                $('#formAdd .msgModal').css({color: "#77DD77"});
                                $('#formAdd .msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href = 'prof_read_grupos.php';
                                }, 2000);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                $('#formAdd .msgModal').css({color: "#FF0000"});
                                $('#formAdd .msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 2000);
                            }
                        }, error: function(){
                            alert("Error al crear grupo");
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