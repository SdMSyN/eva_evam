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
        $idGroup = $_GET['idGrupo'];
        
        //Obtenemos informacion del grupo
        $sqlGetGrupoInfo = "SELECT $tGrupo.nombre as grupo, $tGrado.nombre as grado "
                . "FROM $tGrupo INNER JOIN $tGrado ON $tGrado.id=$tGrupo.nivel_grado_id "
                . "WHERE $tGrupo.id='$idGroup' ";
        $resGetGrupoInfo = $con->query($sqlGetGrupoInfo);
        $rowGetGrupoInfo = $resGetGrupoInfo->fetch_assoc();
        $nombreGrupo = $rowGetGrupoInfo['grado'].' - '.$rowGetGrupoInfo['grupo'];
        
?>

    <div class="container">
        <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <div class="row placeholder text-center">
            <div class="col-sm-12 placeholder">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd" id="buttonAdd">
                    Añadir Alumno
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalSearchAlum" id="buttonSearch">
                    Buscar y Añadir Alumno
                    <span class="glyphicon glyphicon-search"></span>
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <caption>Grupo "<?=$nombreGrupo;?>"</caption>
                <thead>
                    <tr>
                        <th><span title="id">Id</span></th>
                        <th><span title="idAlum">IdAlum</span></th>
                        <th><span title="nombre">Nombre</span></th>
                        <th><span title="user">Usuario</span></th>
                        <th><span title="pass">Contraseña</span></th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
        <!-- Modal para actualizar datos  -->
        <div class="modal fade" id="modalUpd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Actualizar alumno</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formUpd" name="formUpd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="inputIdUser" id="inputIdUser" >
                                <label for="inputName">Nombre: </label>
                                <input class="form-control" id="inputName" name="inputName" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal para añadir alumno -->
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Añadir nuevo alumno</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formAdd" name="formAdd">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="inputIdGrupo" value="<?= $idGroup; ?>" >
                                <input type="hidden" name="inputIdProf" value="<?= $idUser; ?>" >
                                <label for="inputAP">Apellido Paterno: </label>
                                <input class="form-control" id="inputAP" name="inputAP">
                            </div>
                            <div class="form-group">
                                <label for="inputAM">Apellido Materno: </label>
                                <input class="form-control" id="inputAM" name="inputAM">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Nombre: </label>
                                <input class="form-control" id="inputName" name="inputName">
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
        
        <!-- Modal para buscar alumno  -->
        <div class="modal fade" id="modalSearchAlum" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Buscar y añadir alumno</h4>
                        <p class="msgModal"></p>
                    </div>
                    <div class="modal-body">
                        <form id="formSearch" name="formSearch">
                            <div class="form-group">
                                <label for="inputSearchUser">Alumno: </label>
                                <input type="text" class="form-control typeahead searchStudent" id="searchStudent" name="searchStudent" >
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary addStudentSearch">Añadir</button> 
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
        
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            //Obtenemos número de alumnos que tiene el profesor
            $.ajax({
                type: "POST",
                url: "../controllers/prof_read_grupos.php?idProf="+<?=$idUser;?>,
                success: function(msg){
                    console.log(msg);
                    var msg = jQuery.parseJSON(msg);
                    if(msg.error == 0){
                        var totalAlum = parseInt(msg.totalAlum);
                        console.log(totalAlum);
                        if(totalAlum >= <?= $cantAlum; ?>){
                            console.log("mayor");
                            $("#buttonAdd").attr("disabled", true);
                            $("#buttonSearch").attr("disabled", true);
                        }else{
                            console.log("menor");
                            $("#buttonAdd").attr("disabled", false);
                            $("#buttonSearch").attr("disabled", false);
                        }
                    }else{
                        var newRow = '<tr><td></td><td>'+msg.msgErr+'</td></tr>';
                        $("#data tbody").html(newRow);
                    }
                }
            });
            
           filtrar();
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: ordenar, 
                   url: "../controllers/esc_read_grupo_alumno_details.php?idGrupo=<?=$idGroup;?>",
                   success: function(msg){
                       $("#data tbody").html(msg);
                       var msg = jQuery.parseJSON(msg);
                       //console.log(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                                var newRow = '<tr>'
                                         +'<td>'+msg.dataRes[i].id+'</td>'
                                         +'<td>'+msg.dataRes[i].idAlumno+'</td>'
                                         +'<td>'+msg.dataRes[i].nombre+'</td>'
                                         +'<td>'+msg.dataRes[i].user+'</td>'
                                         +'<td>'+msg.dataRes[i].pass+'</td>'
                                         +'<td><button type="button" class="btn btn-warning" id="update" value="'+msg.dataRes[i].idAlumno+'" data-toggle="modal" data-target="#modalUpd"><span class="glyphicon glyphicon-refresh"></span></button></td>'
                                         +'<td><button type="button" class="btn btn-danger" id="delete" value="'+msg.dataRes[i].idAlumno+'"><span class="glyphicon glyphicon-remove"></span></button></td>'
                                    +'</tr>';
                                $(newRow).appendTo("#data tbody");
                            });
                       }else{
                           var newRow = '<tr><td colspan="4">'+msg.msgErr+'</td></tr>';
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
            
            //Al hacer clic en actualizar
            $("#data").on("click", "#update", function(){
                var idAlum = $(this).val();
                console.log("Hola: "+idAlum);
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_alumno.php",
                    data: {idAlum: idAlum},
                    success: function(response){
                        var msg = jQuery.parseJSON(response);
                        console.log(response);
                        $("#modalUpd .modal-body #inputIdUser").val(msg.dataRes[0].id);
                        $("#modalUpd .modal-body #inputName").val(msg.dataRes[0].nombre);
                    }
                })
            });
            
            //Actualizar información del alumno
            $('#formUpd').validate({
                rules:{
                    inputName: {required: true}
                },
                messages: {
                    inputName: "Nombre obligatorio"
                },
                tooltip_options: {
                    inputName: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/update_alumno.php",
                        data: $('form#formUpd').serialize(),
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#77DD77"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href = 'prof_read_grupo_alumno.php?idGrupo=<?=$idGroup;?>';
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
                            alert("Error al actualizar alumno.");
                        }
                    });
                }
            })
            
            //Eliminar alumno
            $("#data").on("click", "#delete", function(){
                var idAlum = $(this).val();
                if(confirm("¿Seguro que deseas eliminar a este estudiante?")){
                    $('#loading').show();
                    $.ajax({
                         method: "POST",
                         url: "../controllers/esc_delete_alumno.php?idGrupo=<?=$idGroup;?>&idAlum="+idAlum,
                         success: function(data){
                            alert(data);
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('#loading').append('<p>'+msg.dataRes+'</p>');
                                setTimeout(function () {
                                  location.href = 'prof_read_grupo_alumno.php?idGrupo=<?=$idGroup;?>';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
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
            
            //añadir nuevo alumno
            $('#formAdd').validate({
                rules: {
                    inputName: {required: true},
                    inputAP: {required: true},
                    inputAM: {required: true}
                },
                messages: {
                    inputName: "Nombre obligatorio",
                    inputAP: "Apellido paterno obligatorio",
                    inputAM: "Apellido materno obligatorio"
                },
                tooltip_options: {
                    inputName: {trigger: "focus", placement: "bottom"},
                    inputAP: {trigger: "focus", placement: "bottom"},
                    inputAM: {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/prof_create_alumno.php",
                        data: $('form#formAdd').serialize(),
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('.msgModal').css({color: "#77DD77"});
                                $('.msgModal').html(msg.msgErr);
                                setTimeout(function () {
                                  location.href =  'prof_read_grupo_alumno.php?idGrupo=<?=$idGroup;?>';
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
                            alert("Error al añadir alumno nuevo");
                        }
                    });
                }
            }); // end añadir nuevo alumno
            
            //Buscar alumnos
            $('input.typeahead').typeahead({
                name: 'searchStudent',
                remote: '../controllers/prof_search_alumno.php?query=%QUERY&idGrupo=<?= $idGroup; ?>',
                limit: 5
            });
            
            //Añadir alumno
            $("#modalSearchAlum").on("click", ".addStudentSearch", function(){
                var queryStudent = $("#modalSearchAlum #searchStudent").val();
                console.log(queryStudent);
                $.ajax({
                    type: "POST",
                    url: "../controllers/searchStudentQuery.php",
                    data: {queryStudent: queryStudent, idGrupo: <?= $idGroup; ?>},
                    success: function(msg){
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            $('.msgModal').css({color: "#FF0000"});
                            $('.msgModal').html(msg.msgErr);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }else{
                            $('#loading').empty();
                            $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                            $('.msgModal').css({color: "#FF0000"});
                            $('.msgModal').html(msg.msgErr);
                            setTimeout(function () {
                              $('.msgModal').hide();
                            }, 2000);
                        }
                    }
                })
            })
            
        });
    </script>
    
<?php
    }//end if-else
    include ('footer.php');
?>