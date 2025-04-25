<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../login/index.php');
}

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>SAEP | Home</title>
  <link rel="shortcut icon" href="../plantilla/dist/img/favi1.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../plantilla/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plantilla/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons 
    <link rel="stylesheet" href="../plantilla/bower_components/Ionicons/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../plantilla/dist/css/AdminLTE.min.css">
    <!-- color de la navegacion navV navH -->
    <link rel="stylesheet" href="../plantilla/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plantilla/plugins/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../plantilla/dist/css/checkbox.css">

    <!--booton imprimir-->
    <link rel="stylesheet" href="../plantilla/plugins/select2/select2.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>


  <style>
    .swal2-popup{
      font-size:1.0.5em !important;
    }

     body {
        overflow-y: auto; /* Agrega scroll vertical si es necesario */
        /* Altura máxima de la sección de contenido */
      }
     
  </style>
  <body id="body" class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

      <?php 
      include ('menu/navV.php');
      include ('menu/navH.php');
      ?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
          <div class="row" id="contenido_principal">
            <div class="col-md-12">
              <div class="box box-warning ">


                <div class="box-header with-border">
                  <h3 class="box-title">BIENVENIDO AL CONTENIDO PRINCIPAL</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  CONTENIDO PRINCIPAL
                  <div id="Notificaciones_year"></div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <center><div class="loader" hidden>
             <img src="../login/vendor/abc.gif" alt="" style="width: 100px;height:100px;" >
           </div></center>
         </div>
       </div>
       <!-- /modal del index -->


       <!-- /.content-wrapper -->
       <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <a href="https://www.facebook.com/PITTA100.100"><i class="fa fa-facebook-square fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
          <a href="https://wa.me/595983455074"><i class="fa fa-whatsapp fa-2x" style="color: green"></i></a>&nbsp;&nbsp;&nbsp;
          <b>Version 1.0</b> 
        </div>
        <strong>Desallollador  <a href="https://www.pitta100.com">Victor Pitta</a>.</strong> Fundador de la empresa <strong style="color:#333333">Tech</strong><strong style="color:#FF3D7F;">Pitta-Company</strong> .
      </footer>

      <!-- Control Sidebar -->

      <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->


 <!-- jQuery 3 -->
 <script src="../plantilla/bower_components/jquery/dist/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="../plantilla/bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
   var idioma_espanol = {
     select: {
       rows: "%d fila seleccionada"
     },
     "sProcessing":     "<span class='fa-stack fa-lg'>\n\
     <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
     </span>&emsp;Procesando....",
     "sLengthMenu":     "Mostrar _MENU_ registros",
     "sZeroRecords":    "No se encontraron resultados",
     "sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
     "sInfo":           "Registros del (_START_ al _END_) total de _TOTAL_ registros",
     "sInfoEmpty":      "Registros del (0 al 0) total de 0 registros",
     "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
     "sInfoPostFix":    "",
     "sSearch":         "Buscar:",
     "sUrl":            "",
     "sInfoThousands":  ",",
     "sLoadingRecords": "<b>No se encontron Ningun Registro</b>",
     "oPaginate": {
       "sFirst":    "Primero",
       "sLast":     "Último",
       "sNext":     "Siguiente",
       "sPrevious": "Anterior"
     },
     "oAria": {
       "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
       "sSortDescending": ": Activar para ordenar la columna de manera descendente"
     }
   }
   function cargar_contenido(contenedor,contenido){
    $("#refres_add").show();
    checkScreenWidth();
    $("#"+contenedor).load(contenido);
   // $("html").animate({ scrollTop: $("#" + contenedor).offset().top }, "slow");
     $("html, body").animate({ scrollTop: 0 }, "slow");
  }
 
</script>

<!-- Bootstrap 3.3.7 -->
<script src="../plantilla/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



<!-- Slimscroll -->

<!-- FastClick -->

<!-- AdminLTE App -->
<script src="../plantilla/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->

<script src="../plantilla/plugins/DataTables/datatables.min.js"></script>

<!-- imprimir--> 
<script src="../plantilla/plugins/DataTables//pdfmake-0.1.36/vfs_fonts.js"></script>

<script src="../plantilla/plugins/select2/select2.min.js"></script>
<script src="../plantilla/plugins/sweetalert2/sweetalert2.js"></script>

<script src="../login/dist/cryptojs-aes-format.js"></script>
<script src="../login/dist/cryptojs-aes.min.js"></script>
<script src="../js/config.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
   listar_combo_AnioActiveWiev();

 } );
  function search_SidebarMain() {
    let input = document.getElementById('searchbar').value;
    input=input.toLowerCase();
    let x = document.getElementsByClassName('treeview');
    for (i = 0; i < x.length; i++) { 

      if (!x[i].innerHTML.includes(input)) {
        x[i].style.display="none";
      }
      else {
        x[i].style.display="list-item";   

      }
    }



  }

 function checkScreenWidth() {
    var screenWidth = window.innerWidth;
    var bodyElement = document.getElementById("body");

    // Eliminar la clase sidebar-open si está presente
    bodyElement.classList.remove("sidebar-open");

    // Si el ancho de la pantalla es menor o igual a 768px (tamaño de pantalla de un celular típico), agregar la clase sidebar-collapse
    if (screenWidth <= 768) {
        bodyElement.classList.add("sidebar-collapse");
    } else {
        // Si el ancho de la pantalla es mayor a 768px, quitar la clase sidebar-collapse
        bodyElement.classList.remove("sidebar-collapse");
    }
}

    //COMBO DE AÑO ESCOLAR
    function listar_combo_AnioActiveWiev() {
     $("#nombreYearactivo").html("<i class='fa fa-spin fa-refresh'></i>");
     $.ajax({
      "url": "../controlador/configuracion/configuracion_extrae_AnioActivo.php",
      type: 'POST'
    }).done(function(resp) {
      var data = JSON.parse(resp);
      if(data.length>0){
        $("#YearActualActivo").val(data[0]['id_year']);
        $("#nombreYearactivo").html(data[0]['yearScolar']);
        $("#tex_YearActual_").val(data[0]['yearScolar']);
      }
      else{
        var html = '';
        html += "<div class='' style='border-color: #f5c6cb; ' >";
        html += "<div  class='alert  sm' role='alert' style='color: #721c24; background-color: #f8d7da;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
        html += "No se encontró ninguan año academico Aperturado ";
        html += "<strong> ! ACTIVO </strong> para este año !!";
        html += " </div>";
        html += "</div>";

        $("#Notificaciones_year").html(html);

      }  

    })
  }

</script>

</body>
</html>
