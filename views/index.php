<?php
    include ('header.php');
    include('../config/variables.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
<link href="../assets/css/login.css" rel="stylesheet">
</head>
    <body>
<?php
    include ('navbar.php');
?>

    <div class="container">
        <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <form class="form-signin" method="POST" id="formLogin">
            <h2 class="form-signin-heading">Iniciar Sesión</h2>
            <!--<div class="text-center"><img src="assets/obj/carousel_0.jpg" alt="" width="75%" class="img-rounded"/></div>-->
            <div class="row msg"></div>
            <label for="inputUser" class="sr-only">Usuario</label>
            <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Usuario" >
            <label for="inputPass" class="sr-only">Contraseña</label>
            <input type="password" id="inputPass" name="inputPass" class="form-control" placeholder="Contraseña" >
            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
            <button type="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#modalAdd" >Registrarse</button>
            <hr>
            <h3>Contacto</h3>
            <p><b>Celular/WhatsApp:</b> 246-195-36-23</p>
            <p><b>Facebook:</b> <a href="https://www.facebook.com/innovacionydesarrolloeducativo/?fref=ts" target="_blank">Innovación y desarrollo educativo</a></p>
            <p><b>Dirección:</b> <a href="https://goo.gl/maps/igpsSj7mBUE2" target="_blank">Calle 25 #102b La Loma Xicohténcatl</a></p>
        </form>
        
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labellebdy="myModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Registrarse</h4>
                        <p class="msgModal"></p>
                    </div>
                    <form id="formSignUp" name="formSignUp" >
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputPaq">Paquete<span class="obligatorio">*</span>: </label>
                                <select id="inputPaq" name="inputPaq" class="form-control"></select>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Nombre completo<span class="obligatorio">*</span>: </label>
                                <input class="form-control" id="inputName" name="inputName" placeholder="Paterno Materno Nombre">
                            </div>
                            <div class="form-group">
                                <label for="inputUser">Usuario<span class="obligatorio">*</span>: </label>
                                <input class="form-control" id="inputUser" name="inputUser" placeholder="Usuario2019">
                            </div>
                            <div class="form-group">
                                <label for="inputPass">Contraseña<span class="obligatorio">*</span>: </label>
                                <input type="password" class="form-control" id="inputPass" name="inputPass" placeholder="********">
                            </div>
                            <div class="form-group">
                                <label for="inputCel">Celular: </label>
                                <input class="form-control" id="inputCel" name="inputCel" placeholder="2461953623">
                            </div>
                            <div class="form-group">
                                <label for="inputMail">Correo<span class="obligatorio">*</span>: </label>
                                <input class="form-control" id="inputMail" name="inputMail" placeholder="contacto@ide-educativo.com">
                            </div>
                            <small><i><span class="glyphicon glyphicon-asterisk obligatorio"></span> Campos obligatorios</i></small><br>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#loading').hide();
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: "../controllers/get_paquetes.php",
                success: function(msg){
                    var msg = jQuery.parseJSON(msg);
                    if(msg.error == 0){
                        $.each(msg.dataRes, function (i, item) {
                            $("#modalAdd #inputPaq").append($('<option>', {
                                value: msg.dataRes[i].id,
                                text: msg.dataRes[i].nombre
                            }));
                        });
                    }else{
                        $("#modalAdd #inputPaq").append($('<option>', {
                            value: 0,
                            text: "No existen paquetes"
                        }));
                    }
                }, error: function(){
                    console.log("Error al cargar paquetes");
                }
            });
            
            $('#formLogin').validate({
                rules: {
                    inputUser: {required: true},
                    inputPass: {required: true}
                },
                messages: {
                    inputUser: "Usuario obligatorio",
                    inputPass: "Contraseña obligatoria"
                },
                tooltip_options: {
                    inputUser: {trigger: "focus", placement: 'right'},
                    inputPerfil: {trigger: "focus", placement: 'right'}
                },
                beforeSend: function(){
                    $('.msg').html('loading...');
                },
                submitHandler: function (form) {
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/login_user.php",
                        data: $('form#formLogin').serialize(),
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                if(msg.perfil == 2) location.href="index_profesor.php";
                                else if(msg.perfil == 3) location.href="index_estudiante.php";
                                else if(msg.perfil == 4) location.href="index_tutor.php";
                                else if(msg.perfil == 10) location.href="index_admin.php";
                                else location.href="#";
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" >'
                                        +'<h2>'+msg.msgErr+'</h2><h2>Verifica que tus datos sean correctos con tu institución.</h2></p>');
                                setTimeout(function (){
                                    $('#loading').hide();
                                },3000);
                            }
                        },
                        error: function () {
                            alert("Error al iniciar sesión de usuario");
                        }		
                    });
                }
            });
            
            $("#formSignUp").validate({
                rules: {
                    inputPaq: {required: true},
                    inputName: {required: true},
                    inputUser: {required: true},
                    inputPass: {required: true},
                    inputCel: {digits: true},
                    inputMail: {required: true, email: true}
                },
                messages: {
                    inputPaq: "Paquete obligatorio",
                    inputName: "Nombre obligatorio",
                    inputUser: "Usuario obligatorio",
                    inputPass: "Contraseña obligatoria",
                    inputCel: "Solo números",
                    inputMail: {
                        required: "Correo obligatorio",
                        email: "Formato de correo invalido"
                    }
                },
                tooltip_options: {
                    inputPaq: {trigger: "focus", placement: 'right'},
                    inputName: {trigger: "focus", placement: 'right'},
                    inputUser: {trigger: "focus", placement: 'right'},
                    inputPass: {trigger: "focus", placement: 'right'},
                    inputCel: {trigger: "focus", placement: 'right'},
                    inputMail: {trigger: "focus", placement: 'right'}
                },
                beforeSend: function(){
                    $('.msg').html('loading...');
                },
                submitHandler: function (form) {
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/create_profesor.php",
                        data: $('form#formSignUp').serialize(),
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/success_256.png" height="300" width="400" >');
                                setTimeout(function (){
                                    location.reload();
                                },2000);
                            }else{
                                $('#loading').empty();
                                $('#loading').append('<img src="../assets/obj/error.png" height="300" width="400" >'
                                        +'<h2>'+msg.msgErr+'</h2><h2>Verifica que tus datos sean correctos con tu institución.</h2></p>');
                                setTimeout(function (){
                                    $('#loading').hide();
                                },2000);
                            }
                        },
                        error: function () {
                            alert("Error al iniciar sesión de usuario");
                        }		
                    });
                }
            });
        });
    </script>
    
<?php
    include ('footer.php');
?>