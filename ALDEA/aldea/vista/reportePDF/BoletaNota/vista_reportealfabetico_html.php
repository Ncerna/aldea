
<?php 
ob_start();

$idalumno = htmlspecialchars($_GET["idalumno"],ENT_QUOTES,'UTF-8');
$id_year = htmlspecialchars($_GET["id_year"],ENT_QUOTES,'UTF-8');
$idgrado = htmlspecialchars($_GET["idgrado"],ENT_QUOTES,'UTF-8');



require '../conexion_temporal.php';

//DATOS DEL ALUMNO
$alumno = $conn->prepare("select idalumno,apellidos,alumnonombre,codigo,Id_grado,gradonombre,nombreNivell,matricula.seccion from matricula

  inner join  niveles on niveles.idniveles = matricula.Id_nivls
  inner join  alumno on alumno.idalumno = matricula.Id_alumno
  inner join  grado on grado.idgrado = matricula.Id_grado 
  where Id_alumno ='$idalumno' and matricula.year_id='$id_year'");
$alumno->execute();
$alumno = $alumno->fetch();

$grado=$alumno['Id_grado'];

       ///TIPO DE EVALUACION DEL AÑO orden.idtipo,nombre tipo

$tipoEv = $conn->prepare("select ordenTipo_periodo,tipo_periodo, tipo_nombre from periodo 
  inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
  where year_id='$id_year '");
$tipoEv->execute();
$tipoEv = $tipoEv->fetchAll();

///////
$long =$tipoEv[0]['tipo_periodo'];


//CURSOS DEL GRADO
$cursos = $conn->prepare("select curso_id,nonbrecurso from grado_curso
  inner join curso on curso.idcurso=grado_curso.curso_id
  where grado_id='$grado'   and yearEscolar='$id_year' ");
$cursos->execute();
$cursos = $cursos->fetchAll();

//Datos  INSTITUCION
$colegio = $conn->prepare("SELECT idColegio, nameColegio,  emailColegio, ubicacion, logoColegio, escudoPais,  ugel FROM colegio");

$colegio->execute();
$colegio = $colegio->fetch();

$escudoImagen = "../../../imagenes/".$colegio['escudoPais'];
$escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));
$logoImagen = "../../../imagenes/".$colegio['logoColegio'];
$logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));

include 'Rowtable_alfabetico.php';


include_once '../../../modelo/modelo_boletaNota.php';
$MU  = new  Boletin_Notas();


?>

<!DOCTYPE html>
<html>
<head>
  <title>report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../../plantilla/Dompdf/boostra4/bootstrap.min.css" integrity="" crossorigin="anonymous">
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
    <style>
    @media print {
      #imprimirBtn {
        display: none;
      }
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
      <h5>LIBRETA DE INFORMACION DEL ESTUDIANTE -<?php echo date('Y')?></h5>
      
      <table border="1" class="table table-bordered">

        <tr>
          <td>UGEL</th>
            <td colspan="4"><?php echo $colegio['ugel']?? '' ?></td>
          </tr>
          <tr>
            <td colspan="4">I.E</td>
            <td ><?php echo $colegio['nameColegio']?? '' ?></td>
          </tr>
          <tr>
            <td rowspan="2">NIVEL</td>
            <td rowspan="2"><?php echo $alumno['nombreNivell'] ?></td>
            <td style="background-color:#86888D;">GRADO</td>
            <td colspan="2"><?php echo $alumno['gradonombre'] ?></td>
          </tr>
          <tr>
            <td colspan="2">SECCION</td>
            <td colspan="1"><?php echo $alumno['seccion'] ?></td>
          </tr>
          <tr>
            <td colspan="4">CODIGO ESTUDIANTE</td>
            <td ><?php echo $alumno['codigo'] ?></td>
          </tr>
          <tr>
            <td colspan="4">APELLIDOS Y NOMBRES</td>
            <td ><?php echo $alumno['apellidos'].','.$alumno['alumnonombre'] ?></td>
          </tr>
        </table>

      </div>
    </div>
    <br>
    <br><br>
    
    <div class="container" style=" ">
      <div class="row">
       <div class="col-md-12">
         <div class="table-responsive text-left" >
<button id="imprimirBtn" onclick="imprimirDocumento()">Imprimir</button>
          <table border="1"  class="table table-bordered">
            <thead>
              <tr>
                <th rowspan="2" style="width: 10px;text-align: center; font-size:12px;">AREAS</th>
                <th rowspan="2" style="width: 120px;text-align: center ; font-size:12px;">CRITERIOS DE EVALUACION</th>
                <th colspan="<?= $long ?>" style="width:80px;text-align: center ; font-size:12px;">NF/BIM/SEM/TRIM</th>
                <th rowspan="2" style="width:10px;text-align: center ; font-size:12px;">CAL.FINAL</th>
                <th rowspan="2" style="width:10px;text-align: center ; font-size:12px;">EVALU.RECUPERACION</th>
                

              </tr>
              <tr>
                <?php foreach ($tipoEv as $tipo):?>
                  <th style="width:10px;text-align: center"><?php echo $tipo['ordenTipo_periodo']."°" .$tipo['tipo_nombre'] ?></th>  
                <?php endforeach;?>

              </tr>
            </thead>
            <tbody>

             <?php foreach ($cursos as $curso):?>
              <tr>
               <!--CONSULTA  DE CRITERIOS DEL CURSO-->
               <?php  $criterio = $MU->listars_CriteriosCursoID($curso['curso_id'],$id_year,$idgrado);?>
               <!--CONSULTA  DE NOTAS DEL CRITERIO-->
                  <?php // $notas = $MU->Notas_Criterios_CursoID($curso['curso_id']);

                  $notas = $conn->prepare("select id_Criterio,calificacions,id_curso from  notasalfabetico where idalumno='$idalumno' and di_year='$id_year' and id_curso=".$curso['curso_id']);
                  $notas->execute();
                  $notas = $notas->fetchAll();


                  ?>

                  <td rowspan="<?= count($criterio)+1; ?>" style="width: 10px;text-align: center"><?php echo $curso['nonbrecurso']?></td>
                  <?php echo(get_include_contents($criterio,count($criterio),$notas,count($tipoEv),$long));?>


                </tr>
                <?php $criterio=''; endforeach;?>

              </tbody>


            </table>

          </div>

        </div>
      </div>
    </div>

  </div>
 <script>
    function imprimirDocumento() {
      window.print();
    }
  </script>

  

</body>

</html>

<?php 

$html=ob_get_clean();
echo $html;


?>