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
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>No tienes permiso para entrar a esta sección. ━━[○･｀Д´･○]━━ </h2></div></div>';
    }else if($_SESSION['perfil'] != 2){
        echo '<div class="row"><div class="col-sm-12 text-center"><h2>¿Estás tratando de acceder? No es tu perfil o(´^｀)o </h2></div></div>';
    }
    else {
        
        $idPerfil = $_SESSION['perfil'];
        $idUser = $_SESSION['userId'];
        
        $idExam = $_GET['idExam'];
        
        //Obtenemos información del examen
        $sqlGetExaInfo = "SELECT * FROM $tExaInf WHERE id='$idExam' ";
        $resGetExaInfo = $con->query($sqlGetExaInfo);
        $rowGetExaInfo = $resGetExaInfo->fetch_assoc();
        $idMateria = $rowGetExaInfo['banco_materia_id'];
        $nameExa = $rowGetExaInfo['nombre'];
        
        //Obtenemos los niveles escolares
        $sqlGetNiveles = "SELECT id, nombre FROM $tNivEsc";
        $resGetNiveles = $con->query($sqlGetNiveles);
        $optNiv = '<option></option>';
        while($rowGetNiveles = $resGetNiveles->fetch_assoc()){
            $optNiv .= '<option value="'.$rowGetNiveles['id'].'">'.$rowGetNiveles['nombre'].'</option>';
        }
        
        
?>

    <div class="container">
        <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        
        <div class="row">
            <form id="frm_filtro" method="post" action="" class="form-horizontal">
                <input type="hidden" name="inputMateria" value="<?=$idMateria;?>" >  
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputNiveles">Niveles</label>
                            <div class="col-sm-8">
                                <select id="inputNiveles" name="inputNiveles" class="form-control">
                                    <?=$optNiv;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputAreas">Áreas</label>
                            <div class="col-sm-8">
                                <select id="inputAreas" name="inputAreas" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputMaterias">Materías</label>
                            <div class="col-sm-8">
                                <select id="inputMaterias" name="inputMaterias" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputTemas">Temas</label>
                            <div class="col-sm-8">
                                <select id="inputTemas" name="inputTemas" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
                <div class="col-sm-offset-5 col-sm-7">
                    <button type="button" id="btnfiltrar" class="btn btn-success">Filtrar <span class="glyphicon glyphicon-filter"></span></button>
                    <a href="javascript:;" id="btncancel" class="btn btn-default">Todos</a>
                </div>
            </form>
        </div>
        
        <form id="formAddPreg">
            <div class="row text-center"><br>
                <button class="btn btn-primary" type="submit">Añadir a cuestionario: <?= $nameExa; ?></button>
                <input type="hidden" name="inputIdExam" value="<?=$idExam;?>" >
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="data">
                    <caption>Preguntas de tu materia</caption>
                    <thead>
                        <tr>
                            <th><label for="checkTodos"><input type="checkbox" id="checkTodos" ></label></th>
                            <th><span title="id">Id</span></th>
                            <th><span title="nombre">Pregunta</span></th>
                            <th><span title="valor_preg">Valor pregunta</span></th>
                            <th><span title="tipo_resp">Tipo de respuesta</span></th>
                            <th><span title="creado_por_id">Creador</span></th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
            </div>
        </form>
        
        <!-- Modal para ver preguntas  -->
        <div class="modal fade" id="modalViewPreg" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Pregunta:</h4>
                        <p class="msgModal"></p>
                    </div>
                    <div class="modal-body">
                        <div class="row textPreg"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        $(document).ready(function(){
            //filtrar();
            function filtrar(){
               $.ajax({
                   type: "POST",
                   data: $("#frm_filtro").serialize()+ordenar,
                   url: "../controllers/prof_read_banco_pregs.php?idExam="+<?=$idExam;?>+"&idUser="+<?=$idUser;?>,
                   success: function(msg){
                       //alert(msg);
                       console.log(msg);
                       var msg = jQuery.parseJSON(msg);
                       if(msg.error == 0){
                           $("#data tbody").html("");
                           $.each(msg.dataRes, function(i, item){
                               var newRow = '<tr>'
                                    +'<td><input type="checkbox" id="checkIdPreg" '
                                        +'name="checkIdPreg[]" value="'+msg.dataRes[i].id+'" ></td>'
                                    +'<td>'+msg.dataRes[i].id+'</td>'   
                                    +'<td>'+msg.dataRes[i].nombre+'</td>'   
                                    +'<td>'+msg.dataRes[i].valorPreg+'</td>';
                                if(msg.dataRes[i].tipoResp == 1) newRow += '<td>Opción Multiple</td>';
                                else if(msg.dataRes[i].tipoResp == 2) newRow += '<td>Multiopción Multirespuesta</td>';
                                else if(msg.dataRes[i].tipoResp == 3) newRow += '<td>Respuesta abierta</td>';
                                else if(msg.dataRes[i].tipoResp == 4) newRow += '<td>Respuesta exacta</td>';
                                else newRow += '<td></td>';
                                    
                                    newRow += '<td>'+msg.dataRes[i].creadorNombre+'</td>'
                                    +'<td><button type="button" class="btn btn-default" id="viewPreg" value="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalViewPreg"><span class="glyphicon glyphicon-eye-open"></span></button></td>' 
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
           
           //Ordenar por formulario
            $("#btnfiltrar").click(function(){ 
                filtrar();
            });
        
            // boton cancelar
            $("#btncancel").click(function(){ 
                //$("#frm_filtro #calle").find("option[value='0']").attr("selected",true);
                $("#frm_filtro #inputNiveles").val('');
                $("#frm_filtro #inputAreas").val('');
                $("#frm_filtro #inputMaterias").val('');
                $("#frm_filtro #inputTemas").val('');
                filtrar() 
            });
                
            //Obtener las áreas a partir del nivel escolar
            $("#inputNiveles").on("change", function(){
                $.ajax({
                    url:"../controllers/get_materias.php?idNivel="+$("#inputNiveles").val()+"&idGrado=0",
                    type: "POST",
                    success: function(opciones){
                        console.log(opciones);
                        var msg = jQuery.parseJSON(opciones);
                        if(msg.error == 0){
                            $("#inputTemas").html("");
                            $("#inputMaterias").html("");
                            $("#inputAreas").html('<option></option>');
                            $.each(msg.dataRes, function(i, item){
                                var newOpt = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].nombre+'</option>';
                                $(newOpt).appendTo("#inputAreas");
                            });
                        }else{
                            $("#inputTema").html("");
                            $("#inputSubtema").html("");
                            $("#inputAreas").html("<option>"+msg.msgErr+"</option>");
                        }
                    }
                })
            });
            
            //Obtener las materias a partir de las áreas
            $("#inputAreas").on("change", function(){
                $.ajax({
                    url:"../controllers/get_bloques.php?idMateria="+$("#inputAreas").val(),
                    type: "POST",
                    success: function(opciones){
                        console.log(opciones);
                        var msg = jQuery.parseJSON(opciones);
                        if(msg.error == 0){
                            $("#inputTemas").html("");
                            $("#inputMaterias").html('<option></option>');
                            $.each(msg.dataRes, function(i, item){
                                var newOpt = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].nombre+'</option>';
                                $(newOpt).appendTo("#inputMaterias");
                            });
                        }else{
                            $("#inputTemas").html("");
                            $("#inputMaterias").html("<option>"+msg.msgErr+"</option>");
                        }
                    }
                })
            });

            //Obtener los temas a partir de la materia
            $("#inputMaterias").on("change", function(){
                $.ajax({
                    url:"../controllers/get_temas.php?id="+$("#inputMaterias").val(),
                    type: "POST",
                    success: function(opciones){
                        console.log(opciones);
                        var msg = jQuery.parseJSON(opciones);
                        if(msg.error == 0){
                            $("#inputTemas").html('<option></option>');
                            $.each(msg.dataRes, function(i, item){
                                var newOpt = '<option value="'+msg.dataRes[i].id+'">'+msg.dataRes[i].nombre+'</option>';
                                $(newOpt).appendTo("#inputTemas");
                            });
                        }else{
                            $("#inputTemas").html("<option>"+msg.msgErr+"</option>");
                        }
                    }
                })
            });
            
            //Marcar/desmarcar Todos checkbox
            $("#checkTodos").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });

            $('#formAddPreg').validate({
                rules: {
                    'checkIdPreg[]': {required: true}
                },
                messages: {
                    'checkIdPreg[]': "Tu examen no puede ir vacio."
                },
                tooltip_options: {
                    'checkIdPreg[]': {trigger: "focus", placement: "bottom"}
                },
                submitHandler: function(form){
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/prof_create_exa_preguntas.php",
                        data: $('form#formAddPreg').serialize(),
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function () {
                                  location.href =  'prof_read_exams.php';
                                }, 1500);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" ><p>'+msg.msgErr+'</p>');
                                setTimeout(function () {
                                  $('#loading').hide();
                                }, 1500);
                            }
                        }, error: function(){
                            alert("Error al añadir pregunta(s)");
                        }
                    });
                }
            }); 
            
            //Cargar pregunta
            $("#data").on("click", "#viewPreg", function(){
                var idPreg = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../controllers/admin_read_banco_pregunta.php?idPreg="+idPreg,
                    success: function(msg){
                        var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            var newRow = '';
                            $("#modalViewPreg .modal-body .textPreg").html("");
                            $.each(msg.dataPregs, function(i, item){
                                var newPreg = '<div class="row"><div class="col-sm-12 text-center">'
                                        +'<p class="text-center">'+msg.dataPregs[i].nombre+'</p>'
                                    +'</div></div>';
                                if(msg.dataPregs[i].archivo != null){ 
                                    var splitFile = msg.dataPregs[i].archivo;
                                    var extFile = splitFile.split(".");
                                    //console.log(splitFile+'--'+extFile[1]);
                                    if(extFile[1] == "mp3"){
                                        newPreg += '<div class="row">'
                                            +'<audio src="../<?=$filesExams;?>/'+msg.dataPregs[i].archivo+'" preload="auto" controls class="center-block"></audio>'
                                            +'</div>';
                                    }else{
                                        newPreg += '<div class="row">'
                                            +'<img src="../<?=$filesExams;?>/'+msg.dataPregs[i].archivo+'" class="img-responsive center-block" width="60%">'
                                            +'</div>';
                                    }
                                }
                                $(newPreg).appendTo("#modalViewPreg .modal-body .textPreg");
                                $.each(msg.dataPregs[i].resps, function(j, item2){
                                    var newResp = '';
                                    if(msg.dataPregs[i].resps[j].tipoR == 1){
                                        newResp += '<div class="col-sm-6 text-center">';
                                        console.log(msg.dataPregs[i].resps[j].archivo);
                                        if(msg.dataPregs[i].resps[j].archivo != null){
                                            newResp += '<img src="../<?=$filesExams;?>/'+msg.dataPregs[i].resps[j].archivo+'" class="img-responsive center-block" >';
                                        }
                                        newResp += '<label>'+msg.dataPregs[i].resps[j].nombre+'</label>';
                                        newResp += (msg.dataPregs[i].resps[j].respCorr == 1) ? '<input type="radio" class="form-control" name="radio[]" id="radio" value="'+msg.dataPregs[i].resps[j].id+'" checked disabled>' : '<input type="radio" class="form-control" name="radio[]" id="radio" value="'+msg.dataPregs[i].resps[j].id+'" disabled>';
                                        newResp += '</div>';
                                    }else if(msg.dataPregs[i].resps[j].tipoR == 2){
                                        newResp += '<div class="col-sm-6 text-center">';
                                        if(msg.dataPregs[i].resps[j].archivo != null){
                                            newResp += '<img src="../<?=$filesExams;?>/'+msg.dataPregs[i].resps[j].archivo+'" class="img-responsive center-block" >';
                                        }
                                        newResp += '<label>'+msg.dataPregs[i].resps[j].nombre+'</label>';
                                        newResp += (msg.dataPregs[i].resps[j].respCorr == 1) ? '<input type="checkbox" class="form-control" name="check[]" id="check" value="'+msg.dataPregs[i].resps[j].id+'" checked disabled>' : '<input type="checkbox" class="form-control" name="check[]" id="check" value="'+msg.dataPregs[i].resps[j].id+'" disabled>';
                                        newResp += '</div>';
                                    }else if(msg.dataPregs[i].resps[j].tipoR == 3){
                                        newResp += '<div class="col-sm-12">';
                                            //newResp += (msg.dataPregs[i].resps[j].respCorr == 1) ? '<input type="text" class="form-control" name="text[]" id="text" value="'+msg.dataPregs[i].resp[j].palabra+'">' : '<input type="text" class="form-control" name="text[]" id="text" >';
                                            newResp += '<input type="text" class="form-control" name="text[]" id="text" value="'+msg.dataPregs[i].resps[j].palabra+'" disabled>';
                                        newResp += '</div>';
                                    }else if(msg.dataPregs[i].resps[j].tipoR == 4){
                                        newResp += '<div class="col-sm-12">';
                                            //newResp += (msg.dataPregs[i].resps[j].respCorr == 1) ? '<input type="text" class="form-control" name="text[]" id="text" value="'+msg.dataPregs[i].resp[j].palabra+'">' : '<input type="text" class="form-control" name="text[]" id="text" >';
                                            newResp += '<input type="text" class="form-control" name="text[]" id="text" value="'+msg.dataPregs[i].resps[j].palabra+'" disabled>';
                                        newResp += '</div>';
                                    }else{
                                        newResp += '<div class="row">Tipo de respuesta inexistente.</div>';
                                    }
                                    //newResp += '</div><!-- end row -->';
                                    $(newResp).appendTo("#modalViewPreg .modal-body .textPreg");
                                })
                           });
                        }else{
                            var newRow = msg.msgErr;
                            $(newRow).appendTo("#modalViewPreg .modal-body .textPreg");
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