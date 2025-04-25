<?php 
ob_start();
$escudoImagen = "../../imagenes/escudoperu.png";
$escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));
$logoImagen = "../../imagenes/logocole.png";
$logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));

require 'conexion_temporal.php';
$idalumno=1;

//DATOS DEL ALUMNO

    $alumno = $conn->prepare("select idalumno, apellidop, alumnonombre,gradonombre,codigo  from alumno
   inner join  grado on grado.idgrado = alumno.grado  where idalumno = ".$idalumno);
    $alumno->execute();
    $alumno = $alumno->fetch();

    ///TIPO DE EVALUACION DEL AÑO

   $tipoEv = $conn->prepare("select tipo_periodo, fech_inicio, fech_final  from periodo   where year_id='1'");
    $tipoEv->execute();
    $tipoEv = $tipoEv->fetchAll();


//CURSOS DEL GRADO
    $cursos = $conn->prepare("select curso_id,nonbrecurso from grado_curso
  inner join curso on curso.idcurso=grado_curso.curso_id
   where grado_id='1' ");
 $cursos->execute();
 $cursos = $cursos->fetchAll();



 foreach ($cursos as $curso){
  $output[] = $curso['curso_id'];
 }

 include 'Rowtable.php';


  include_once '../../modelo/modelo_boletaNota.php';
    $MU  = new  Boletin_Notas();

 //$criterio = $MU->listars_CriteriosCursoID(1);  


 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <title>Libreta de Notas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../Plantilla/Dompdf/boostra4/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
</head>


<body class="app sidebar-mini">

  <div class="wrap">
    <!--Updated on 10/8/2016; fixed center alignment percentage-->
  </div>


  <div class="wrap">
    <!--Updated on 10/8/2016; fixed center alignment percentage-->

    <style type="text/css">
      .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
        border: 1px solid #0a0a0a !important;
        font-size:10px;
        padding: .10rem;
        text-align: center;


      }

      .container-fluid {
        position: relative;
        width: 700px;
        height: 200px;
        margin-top: -80px;
      }

      [class^="box-3"] {
        width: 150px;
        height: 60px;
        font-weight: bold;
        text-align: center;
      }

      [class^="box-4"] {
        width: 150px;
        height: 60px;
        font-weight: bold;
        text-align: center;
      }
      [class^="box-5"] {
        width: 400px;
        height: 50px;
        font-weight: bold;

        text-align: center;
      }


      .box-3 {
        position: absolute;
        bottom: 0;
        left: 0;
      }

      .box-4 {
        position: absolute;
        bottom: 0;
        right: 0;
      }

      .box-5 {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
      }

    </style>


    <div class="container-fluid">

     <div class="box-3">
       <img src="<?php echo $escudoBase64 ?>" width="100">
     </div>
     <div class="box-4">
       <img src="<?php echo $logoBase64 ?>" width="100">
     </div>
     <div class="box-5">
      <h5>LIBRETA DE INFORMACION DEL ESTUDIANTE -2022</h5>
      
      <table border="1" class="table table-bordered">
        
        <tr>
          <td>UGEL</th>
            <td colspan="4">UGEL LEONCIO PRADO</td>
          </tr>
          <tr>
            <td colspan="4">I.E</td>
            <td >ANTONIO RAYMONDI</td>
          </tr>
          <tr>
            <td rowspan="2">NIVEL</td>
            <td rowspan="2">SECUN</td>
            <td>GRADO</td>
            <td colspan="2"><?php echo $alumno['gradonombre'] ?></td>
          </tr>
          <tr>
            <td colspan="2">SECCION</td>
            <td colspan="1">B</td>
          </tr>
          <tr>
            <td colspan="4">CODIGO ESTUDIANTE:</td>
            <td ><?php echo $alumno['codigo'] ?></td>
          </tr>
          <tr>
            <td colspan="4">APELLIDOS Y NOMBRES</td>
            <td ><?php echo $alumno['apellidop'].','.$alumno['alumnonombre'] ?></td>
          </tr>
        </table>

      </div>
    </div>

    <br>
    <br>
    <div class="container" style=" ">
      <div class="row">
       <div class="col-xs-12">
         <div class="table-responsive text-left" >

          <table border="1"  class="table table-bordered">
           
            <thead>
              <tr>
                <th rowspan="2" style="width: 10px;text-align: center; font-size:12px;">AREAS</th>
                <th rowspan="2" style="width: 120px;text-align: center ; font-size:12px;">CRITERIOS DE EVALUACION</th>
                <th colspan="4" style="width:80px;text-align: center ; font-size:12px;">BIM/SEM/TRIM</th>
                <th rowspan="2" style="width:10px;text-align: center ; font-size:12px;">CAL.FINAL</th>
                <th rowspan="2" style="width:10px;text-align: center ; font-size:12px;">EVALU.RECUPERACION</th>
              </tr>
              <tr>

                <?php foreach ($tipoEv as $tipo):?>
                      <th style="width:10px;text-align: center"><?php echo $tipo['tipo_periodo'] ?></th>  
                  <?php endforeach;?>
              
              </tr>
            </thead>
           
            <tbody>

               <?php foreach ($cursos as $curso):?>
              <tr>
                   <!--CONSULTA  DE CRITERIOS DEL CURSO-->
                  <?php  $criterio = $MU->listars_CriteriosCursoID($curso['curso_id']);?>
                   <!--CONSULTA  DE NOTAS DEL CRITERIO-->
                  <?php // $notas = $MU->Notas_Criterios_CursoID($curso['curso_id']);

                  $notas = $conn->prepare("select id_Criterio,calificacions,id_curso from  libretanotas where id_curso=".$curso['curso_id']);
                  $notas->execute();
                  $notas = $notas->fetchAll();


                  ?>

                <td rowspan="<?= count($criterio)+1; ?>" style="width: 10px;text-align: center"><?php echo $curso['nonbrecurso']?></td>
                <?php echo(get_include_contents($criterio,count($criterio),$notas,count($tipoEv)));?>
                

             </tr>
              <?php $criterio=''; endforeach;?>

         </tbody>
       </table>


     </div>

   </div>
 </div>
</div>


<!-- 

    <div class="" style=" ">
      <div class="row">
       <div class="col-xs-12">
         <div class="table-responsive text-left" >

          <table border="1"  class="table table-bordered">
           
            <thead>
              <tr>
                <th rowspan="2" style="width: 10px;text-align: center; font-size:12px;">AREAS</th>
                <th rowspan="2" style="width: 120px;text-align: center ; font-size:12px;">CRITERIOS DE EVALUACION</th>
                <th colspan="4" style="width:80px;text-align: center ; font-size:12px;">BIM/SEM/TRIM</th>
                <th rowspan="2" style="width:10px;text-align: center ; font-size:12px;">CAL.FINAL</th>
                <th rowspan="2" style="width:10px;text-align: center ; font-size:12px;">EVALU.RECUPERACION</th>
              </tr>
              <tr>
                
                <th style="width:10px;text-align: center">1</th>
                <th style="width:10px;text-align: center">2</th>
                <th style="width:10px;text-align: center">3</th>
                <th style="width:10px;text-align: center">4</th>
              
              </tr>
            </thead>
            <tbody>
              <tr>
                <td rowspan="3" style="width: 10px;text-align: center">COMUNICACION INTEGRAL</td>
                <td>Comprencion lectora</td>
                <td >A</td>
                <td >A</td>
                <td >A</td>
                <td >A</td>
                <td rowspan="3" style="text-align: center" >9</td>
                <td rowspan="3" style="text-align: center" >SI</td>
              </tr>
              <tr>
               <td>Trabajo grupal-liderazgo</td>
               <td >A</td>
               <td >A</td>
               <td >A</td>
               <td >A</td>

             </tr>
             <tr>
               <td><strong>Ponderado Acumulado</strong></td>
               <td >15</td>
               <td >14</td>
               <td >10</td>
               <td >19</td>

             </tr>
             <tr>
              <td rowspan="2" style="width: 10px;text-align: center">LOGICO MATEMATICO</td>
              <td>Evaluacion Actitunidal</td>
              <td >A</td>
              <td >A</td>
              <td >A</td>
              <td >A</td>
              <td rowspan="2" style="text-align: center" >12</td>
              <td rowspan="2" style="text-align: center" >No</td>
            </tr>
            <tr>
             <td>Capacidad de resolver problemas</td>
             <td >A</td>
             <td >A</td>
             <td >A</td>
             <td >A</td>
           </tr>
         </tbody>
       </table>


     </div>

   </div>
 </div>
</div>

-->




</div>

<br>

</body>
</html>


<?php 

$html=ob_get_clean();
echo $html;
//$pdf->SetFont('Arial','B',10);
/*

require_once '../../Plantilla/Dompdf/autoload.inc.php';
Use Dompdf\Dompdf;
$dompdf=new Dompdf();

$options = $dompdf->getOptions();
$dompdf = new Dompdf(array('enable_remote' => true));
$dompdf->setOptions($options);

$dompdf ->loadHtml($html);
$dompdf ->setPaper('letter');

//$dompdf ->setPaper('A4','landscape');

$dompdf ->render();

$dompdf ->stream("Repotre_.pdf" ,array('Attachment' => false ));

*/
 ?>


