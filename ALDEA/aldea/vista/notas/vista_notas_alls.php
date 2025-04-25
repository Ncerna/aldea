<script type="text/javascript" src="../js/tripleT.js?rev=<?php echo time();?>"></script>

<?php

if (!empty($_GET['idgrado'])){
$idgrado = htmlspecialchars($_GET['idgrado'],ENT_QUOTES,'UTF-8');
//$idcurso = htmlspecialchars($_GET['idcurso'],ENT_QUOTES,'UTF-8');
$idsecion = htmlspecialchars($_GET['idsecion'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_GET['idyear'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_GET['idnivel'],ENT_QUOTES,'UTF-8');
$nombreNivel = htmlspecialchars($_GET['nombreNivel'],ENT_QUOTES,'UTF-8');
$nameDegre = htmlspecialchars($_GET['nameDegre'],ENT_QUOTES,'UTF-8');


include_once '../../modelo/modelo_notas.php';
  $MU  = new  Nota();

  $tiposevaluacion = $MU->Listar_Notas_Periodo($idyear);
  $alumnos = $MU->Listar_Alumnos_Ponderados($idgrado,$idnivel,$idyear,$idsecion);

/*$notas_por_alumno = [];
// Agrupar las notas acumuladas por alumno
if (isset($alumnos) && is_array($alumnos)) {

foreach ($alumnos as $alumno) {
    $alumno_id = $alumno['alumno_id'];
    
    if (!isset($notas_por_alumno[$alumno_id])) {
        $notas_por_alumno[$alumno_id] = [];
    }
    $notas_por_alumno[$alumno_id][] = $alumno;
}
}*/


//reportes para notas
$datos_alumnos = array();
foreach ($alumnos as $alumno) {
    $alumno_id = $alumno['alumno_id'];
    $nombre_completo = $alumno['apellidos'] . ' ' . $alumno['alumnonombre'];
    $curso = $alumno['nonbrecurso'];
    $periodo = $alumno['ordentio'];
    $nota = $alumno['notaacum'];

    // Crear una entrada para el alumno si no existe
    if (!isset($datos_alumnos[$alumno_id])) {
        $datos_alumnos[$alumno_id] = array(
            'nombre' => $nombre_completo,
            'cursos' => array()
        );
    }

    // Crear una entrada para el curso si no existe
    if (!isset($datos_alumnos[$alumno_id]['cursos'][$curso])) {
        $datos_alumnos[$alumno_id]['cursos'][$curso] = array_fill(1, count($tiposevaluacion), ''); // Inicializar con períodos vacíos
    }

    // Asignar la nota al período correspondiente
    $datos_alumnos[$alumno_id]['cursos'][$curso][$periodo] = $nota;
}

// Obtener los nombres únicos de los cursos
$cursos_unicos = array_unique(array_column($alumnos, 'nonbrecurso'));


//fin de reportes para notas


}

?>

<div class="col-md-12" >
  <div class="box box-warning ">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h2 class = "box-title">LIBRETA DE NOTAS DE LOS ESTUDIANTES</h2>

    </div>
    <!-- /.box-header -->
    <div class="box-body">
       <style type="text/css">#btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }</style>
     <div class="row">
       <div class="col-xs-12">
        <div class="col-md-4">
          <label for="">Grado</label>
          <select class="js-example-basic-single" name="state" id="rep_cbm_grado" style="width:100%; "onchange="SelectedCursos();" >
            
          </select><br><br>

        </div>
        <div class="col-md-4">
          <label for="">Nivel</label>
       <input type="text" name="" id="txt_nivelId" hidden >
       <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled value=" <?php echo !isset($nombreNivel)?? '' ; ?> ">
        </div>
        <div class="col-md-4">
           <label for="">Seccion</label>
           <div class="alin_global">
          <input type="text" name="" class="form-control" id="text_seccion" disabled  value=" <?php echo  !isset($idsecion)?? '' ; ?> ">&nbsp;
           <button onclick="getNotesCurrente();" class="btn-sm" id="btn_bucar_data"> <em class="fa fa-search" ></em> </button>
         </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

 <?php if(!empty($alumnos)) {?>

<style type="text/css">

 .styled-table {
 border-collapse: collapse;
 margin: 25px 0;
 font-size: 0.9em;
 font-family: sans-serif;
    }
.styled-table thead tr {
 color: #000;
   
}
.styled-table th, td {
 border: 1px solid #9f9898;
 padding: 8px;

    }
tr:hover {
 background-color: #ddd;
cursor: pointer;
}

  
</style>

<div class="col-md-12" >
  <div class="box box-warning ">
    <div class="box-body">

        <div class="row">
        <div class="col-xs-4">  
        </div>
        <div class="col-xs-4">  
        </div>
        <div class="col-xs-4">
            <button class="btn btn-success pull-right" onclick="printExcel(this)"><span class="glyphicon glyphicon-print"></span> Exportar a Excel</button> 
        </div>
    </div>
<div class="table-responsive">
        <table class="styled-table" id="tlb_export_excel" style="width: 100%"> 
            <thead>
                <tr>
                    <th rowspan="2">ALUMNOS - <?php echo $nameDegre; ?> </th>
                    <?php foreach ($cursos_unicos as $curso): ?>
                        <?php $num_columnas = count($tiposevaluacion) + 1; ?>
                        <th colspan="<?php echo $num_columnas; ?>" ><?php echo $curso; ?></th>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($cursos_unicos as $curso): ?>
                        <?php for ($i = 1; $i <= count($tiposevaluacion); $i++): ?>
                            <th><?= $i . '°_' . $tiposevaluacion[$i - 1]['tipo_nombre'] ?></th>
                        <?php endfor; ?>
                        <th>PROMEDIO</th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos_alumnos as $alumno): ?>
                    <tr>
                        <th><?php echo $alumno['nombre']; ?></th>
                        <?php foreach ($cursos_unicos as $curso): ?>
                            <?php foreach ($alumno['cursos'][$curso] as $nota): ?>
                                <td>
                                    <?php echo empty($nota) ? 0: $nota; ?>
                                </td>
                            <?php endforeach; ?>
                            <?php $promedio_curso = array_sum($alumno['cursos'][$curso]) / count($tiposevaluacion); ?>
                            <td>
                                <label  style='<?php echo ($promedio_curso > 10.5) ? "color: blue;" : "color: red;" ?>'>
                                    <?php echo round($promedio_curso); ?>
                                </label>
                             </td>


                           
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>
<br>

<?php } else { ?>

<?php } ?>

<script>

 $(document).ready(function () {

    $("#refres_add").hide();
    $('.js-example-basic-single').select2();
    getDegreesAndCouses();
});
          
</script>
