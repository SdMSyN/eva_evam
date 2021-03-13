<?php
    include ('header.php');
    include('../config/variables.php');
?>

<title><?=$tit;?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />
<link href="../assets/css/login.css" rel="stylesheet">
<?php
    include ('navbar.php');
?>

    <div class="container">
        <form class="form-signin" method="POST" id="formLogin">
            <h2 class="form-signin-heading">Iniciar Sesión</h2>
            <!--<div class="text-center"><img src="assets/obj/carousel_0.jpg" alt="" width="75%" class="img-rounded"/></div>-->
            <div class="row msg"></div>
            <label for="inputUser" class="sr-only">Usuario</label>
            <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Usuario" >
            <label for="inputPass" class="sr-only">Contraseña</label>
            <input type="password" id="inputPass" name="inputPass" class="form-control" placeholder="Contraseña" >
            <label for="inputPerfil"><input type="radio" id="inputPerfil" name="inputPerfil" value="2">Profesor</label>
            <label for="inputPerfil1"><input type="radio" id="inputPerfil1" name="inputPerfil" value="3">Alumno</label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
			<hr>
			<h3>Contacto</h3>
			<p><b>Celular/WhatsApp:</b> (+52) 246-195-36-23</p>
			<p><b>Facebook:</b> <a href="https://www.facebook.com/innovacionydesarrolloeducativo/?fref=ts" target="_blank">Innovación y desarrollo educativo</a></p>
			<!-- <p><b>Dirección:</b> <a href="https://goo.gl/maps/igpsSj7mBUE2" target="_blank">Calle 25 #102b La Loma Xicohténcatl</a></p> -->
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#formLogin').validate({
                rules: {
                    inputUser: {required: true},
                    inputPass: {required: true},
                    inputPerfil: {required: true}
                },
                messages: {
                    inputUser: "Usuario obligatorio",
                    inputPass: "Contraseña obligatoria",
                    inputPerfil: "Perfil obligatorio"
                },
                tooltip_options: {
                    inputUser: {trigger: "focus", placement: 'right'},
                    inputPerfil: {trigger: "focus", placement: 'right'},
                    inputPass: {trigger: "focus", placement: 'right'}
                },
                beforeSend: function(){
                    $('.msg').html('loading...');
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: "../controllers/login_user.php",
                        data: $('form#formLogin').serialize(),
                        success: function (msg) {
                            //alert(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                if(msg.perfil == 1) location.href="index_escuela.php";
                                else if(msg.perfil == 2) location.href="index_profesor.php";
                                else if(msg.perfil == 3) location.href="index_estudiante.php";
                                else if(msg.perfil == 10) location.href="index_admin.php";
                                else location.href="#";
                            }else{
                                $('.msg').css({color: "#FF0000"});
                                $('.msg').html(msg.msgErr);
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