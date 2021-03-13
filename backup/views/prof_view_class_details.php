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
        $idGroup = $_GET['idGrupo'];
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
                    Añadir Alumno
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
                        <th><span title="escolar">Nombre</span></th>
                        <th><span title="turno">Usuario</span></th>
                        <th><span title="grado">Contraseña</span></th>
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
                                <input type="hidden" name="inputIdUser" id="inputIdUser" >
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
                            <!-- <div class="form-group">
                                <label for="inputUser">Usuario: </label>
                                <input class="form-control" id="inputUser" name="inputUser"></select>
                            </div>
                            <div class="form-group">
                                <label for="inputPass">Contraseña: </label>
                                <input type="text" class="form-control" id="inputPass" name="inputPass" >
                            </div> -->
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
                   data: {idGrupo: <?=$idGroup;?>, ordenar: ordenar}, 
                   url: "../controllers/prof_get_class_details.php",
                   success: function(msg){
                       $("#data tbody").html(msg);
                       var msg = jQuery.parseJSON(msg);
                       //console.log(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                                var newRow = '<tr>'
                                         +'<td>'+msg.dataRes[i].id+'</td>'
                                         +'<td>'+msg.dataRes[i].nombre+'</td>'
                                         +'<td>'+msg.dataRes[i].user+'</td>'
                                         +'<td>'+msg.dataRes[i].pass+'</td>'
                                         +'<td><button type="button" class="btn btn-warning" id="update" value="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalUpd"><span class="glyphicon glyphicon-refresh"></span></a></td>'
                                         +'<td><button type="button" class="btn btn-danger" id="delete" value="'+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-remove"></span></a></td>'
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
            
            $("#data").on("click", "#delete", function(){
                var idAlum = $(this).val();
                //alert("Hola: "+idAlum);
                if(confirm("¿Seguro que deseas eliminar ea este estudiante?")){
                    $.ajax({
                         method: "POST",
                         url: "../controllers/prof_delete_alumno.php?idAlum="+idAlum,
                         success: function(data){
                            alert(data);
                            console.log(data);
                            var msg = jQuery.parseJSON(data);
                            if(msg.error == 0){
                                $('#loader').empty();
                                $('#loader').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                $('#loader').append('<p>'+msg.dataRes+'</p>');
                                setTimeout(function () {
                                  location.href = 'prof_view_class_details.php?idGrupo=<?=$idGroup;?>';
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
            
            $("#data").on("click", "#update", function(){
                var idAlum = $(this).val();
                //alert("Hola: "+idAlum);
                $.ajax({
                    type: "POST",
                    url: "../controllers/prof_get_alumno.php",
                    data: {idAlum: idAlum},
                    success: function(response){
                        var msg = jQuery.parseJSON(response);
                        console.log(response);
                        $("#modalUpd .modal-body #inputIdUser").val(msg.dataRes[0].id);
                        $("#modalUpd .modal-body #inputName").val(msg.dataRes[0].nombre);
                    }
                })
            });
            
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
                        url: "../controllers/prof_upd_alumno.php",
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
                                  location.href = 'prof_view_class_details.php?idGrupo=<?=$idGroup;?>';
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
            
            
            //añadir nuevo grupo
           $('#formAdd').validate({
                rules: {
                    inputName: {required: true},
                    inputAP: {required: true},
                    inputAM: {required: true}
                },
                messages: {
                    inputName: "Nombre obligatorio",
                    inputAP: "Nombre obligatorio",
                    inputAM: "Nombre obligatorio"
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
                        url: "../controllers/prof_add_alumno.php",
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
                                  location.href =  'prof_view_class_details.php?idGrupo=<?=$idGroup;?>';
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
