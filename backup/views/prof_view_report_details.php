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
        $idExam = $_GET['idExam'];
        $idExamAsig = $_GET['idExamAsig'];
        $idGrupo = $_GET['idGrupo'];
        
?>

    <div class="container">
         <div class="row">
            <div id="loading">
                <img src="../assets/obj/loading.gif" height="300" width="400">
            </div>
        </div>
        <br>
        <div class="row text-center">
            <h3>Número de preguntas: <span id="numPregs"></span> 
                <br>Valor del examen: <span id="valorExa"></span></h3>
        </div>
        <div class="row text-right">
            <!-- <button type="button" class="btn btn-default excel"><img src="../assets/obj/excel_2007.png" class="img-responsive" ></button>-->
            <a href="../controllers/prof_get_details_exam_excel.php?idExam=<?=$idExam;?>&idExamAsig=<?=$idExamAsig;?>&idGrupo=<?=$idGrupo;?>" class="btn btn-default excel"><img src="../assets/obj/excel_2007.png" class="img-responsive" ></a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="data">
                <caption>Detalles del examen: </caption>
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6"><div id="chart_pie_div" ></div></div>
            <div class="col-sm-6"><div id="chart_colum_div" ></div></div>
        </div>
    </div>

    <!-- gráficas -->
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" async>
      function drawChartsGogole(){
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawAnthonyChart);
      }
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Aprobados', apr],
          ['Reprobados', rep]
        ]);
        // Set chart options
        var options = {'title':'Porcentaje de aprobación',
                       'width':400,
                       'height':300,
                       'is3D':true
                   };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_pie_div'));
        chart.draw(data, options);
      }
      
      // Callback that draws the pie chart for Anthony's pizza.
      function drawAnthonyChart() {

        var data = google.visualization.arrayToDataTable([
            ["Element", "Alumnos", { role: "style" } ],
            ["0 - 3.9", r1, "#FF0000"],
            ["4 - 5.9", r2, "#FF8000"],
            ["6 - 7.9", r3, "#FFFF00"],
            ["8 - 10", r4, "#40FF00"]
          ]);

          /*var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);*/

          var options = {
            title: "Rango de calificaciones",
            width: 400,
            height: 300,
            bar: {groupWidth: "65%"},
            legend: { position: "none" },
          };

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_colum_div'));
        chart.draw(data, options);
      }
      
    </script>
    
    <script type="text/javascript">
        $('#loading').hide();
        var ordenar = '';
        var r1 = 0, r2=0, r3=0, r4=0, apr=0, rep=0;
        //$(document).ready(function(){
            
            filtrar();
            //setTimeout(drawChartsGogole(), 9000);
           function filtrar(){
               $.ajax({
                   type: "POST",
                   data: {idExam: <?=$idExam;?>, idExamAsig: <?=$idExamAsig;?>, idGrupo: <?=$idGrupo;?>, ordenar: ordenar}, 
                   url: "../controllers/prof_get_details_exam.php",
                   success: function(msg){
                       //$("#data tbody").html(msg);
                       console.log(msg);
                       var msg = jQuery.parseJSON(msg);
                        if(msg.error == 0){
                            $("#numPregs").html(msg.dataRes[0].numPregs);
                            $("#valorExa").html(msg.dataRes[0].valorExa);
                           var newRowHead = '<tr><td>Nombre</td>';
                           /*$.each(msg.dataRes[0].resp, function(i, item){
                               newRowHead += '<td>Preg. '+(i+1)+' ('+msg.dataRes[0].resp[i].valorPreg+')</td>';
                           })*/
                           newRowHead += '<td>Buenas</td>'   
                                +'<td>Malas</td>'   
                                //+'<td>Sin responder</td>'   
                                +'<td>Puntaje</td>'   
                                +'<td>Calificación</td>' 
                                +'</tr>';
                           $(newRowHead).appendTo("#data thead");
                           
                           var newRow = '';
                           var buenas = 0; var malas = 0; var sinResp = 0; var valor = 0; var calif = 0; var numAlu = 0;
                           
                           var pregsB = []; var pregsM = [];
                           for(var m=0; m<msg.dataRes[0].resp.length; m++){
                               pregsB[m] = 0;
                               pregsM[m] = 0;
                            }
                           $.each(msg.dataRes, function(j ,item2){
                               newRow += '<tr><td>'+msg.dataRes[j].nameAlum+'</td>';
                               var tmpNull = 0;
                               /*$.each(msg.dataRes[j].resp, function(k, item3){
                                   if(msg.dataRes[j].resp[k].calif == 0){ 
                                       newRow += '<td><span class="glyphicon glyphicon-remove"></span></td>';
                                       var sumTmp = pregsM[k]+1;
                                       pregsM[k] = sumTmp;
                                   }
                                   else if(msg.dataRes[j].resp[k].calif == 1){ 
                                       newRow += '<td><span class="glyphicon glyphicon-ok"></span></td>';
                                       var sumTmp = pregsB[k]+1;
                                       pregsB[k] = sumTmp;
                                   }
                                   else{ 
                                       newRow += '<td><span class="glyphicon glyphicon-ban-circle"></span></td>';
                                       tmpNull++;
                                   }
                               })*/
                               newRow += (msg.dataRes[j].buenas != null) ? '<td>'+msg.dataRes[j].buenas+'</td>' : '<td>0</td>';
                                newRow += (msg.dataRes[j].malas != null) ? '<td>'+msg.dataRes[j].malas+'</td>' : '<td>0</td>';
                                //newRow += '<td>'+tmpNull+'</td>';
                                newRow += (msg.dataRes[j].valor != null) ? '<td>'+msg.dataRes[j].valor+'</td>' : '<td></td>';
                                newRow += (msg.dataRes[j].calificacion != null) ? '<td>'+msg.dataRes[j].calificacion+'</td>' : '<td></td>';
                               newRow += '</tr>';
                               buenas += (msg.dataRes[j].buenas != null) ? parseInt(msg.dataRes[j].buenas) : 0;
                               malas += (msg.dataRes[j].malas != null) ? parseInt(msg.dataRes[j].malas) : 0;
                               //sinResp += parseInt(tmpNull);
                               valor += (msg.dataRes[j].valor != null) ? parseInt(msg.dataRes[j].valor) : 0;
                               calif += (msg.dataRes[j].calificacion != null) ? parseFloat(msg.dataRes[j].calificacion) : 0;
                               var califTmp = parseInt(msg.dataRes[j].calificacion);
                               switch (true){
                                   case (califTmp <= 3.9):
                                       r1++;
                                       rep++;
                                       break;
                                   case (califTmp >= 4 && califTmp <= 5.9):
                                       r2++;
                                       rep++;
                                       break;
                                   case (califTmp >= 6 && califTmp <= 7.9):
                                       r3++;
                                       apr++;
                                       break;
                                   case (califTmp >= 8 && califTmp <= 10):
                                       r4++;
                                       apr++;
                                       break;
                                   default:
                                       break;
                                }
                                numAlu++;
                           })
                           /*var cadPregs = '';
                           $.each(pregsB, function(l ,item3){
                               cadPregs += '<td>'+pregsB[l]+'<span class="glyphicon glyphicon-ok"></span>'
                                       +' - '+pregsM[l]+'<span class="glyphicon glyphicon-remove"></span></td>';
                            })*/
                           newRow += '<tr><td><b>Totales</b> ('+numAlu+')</td>'
                                //+cadPregs
                                +'<td>'+buenas+'</td>'   
                                +'<td>'+malas+'</td>'   
                                //+'<td>'+sinResp+'</td>'   
                                +'<td></td>'   
                                +'<td></td>'   
                                +'</tr>';
                            newRow += '<tr><td><b>Promedio Grupal</b></td>'
                                +'<td>'+(((buenas/numAlu)*100)/msg.dataRes[0].numPregs).toFixed(3)+'</td>'    
                                +'<td>'+(((malas/numAlu)*100)/msg.dataRes[0].numPregs).toFixed(3)+'</td>'    
                                //+'<td>'+(((sinResp/numAlu)*100)/msg.dataRes[0].numPregs).toFixed(3)+'</td>'    
                                +'<td></td>'    
                                +'<td>'+(calif/numAlu).toFixed(2)+'</td>'    
                                +'</tr>';
                           $(newRow).appendTo("#data tbody");
                           
                        }else{
                            var newRow = '<tr><td colspan="2">'+msg.msgErr+'</td></tr>';
                           $("#data tbody").html(newRow);
                        }
                        setTimeout(drawChartsGogole(), 2000);
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
            
            
        //});
    </script>
    
    
    
<?php
    }//end if-else
    include ('footer.php');
?>
