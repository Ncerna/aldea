<script type="text/javascript" src="../js/notasperiodo.js?rev=<?php echo time();?>"></script>


<?php

if (!empty($_GET['idgrado'])){
$idgrado = htmlspecialchars($_GET['idgrado'],ENT_QUOTES,'UTF-8');
$idcurso = htmlspecialchars($_GET['idcurso'],ENT_QUOTES,'UTF-8');
$idsecion = htmlspecialchars($_GET['idsecion'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_GET['idyear'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_GET['idnivel'],ENT_QUOTES,'UTF-8');
$nombreNivel = htmlspecialchars($_GET['nombreNivel'],ENT_QUOTES,'UTF-8');

include_once '../../modelo/modelo_notas.php';
  $MU  = new  Nota();

  $tiposevaluacion = $MU->Listar_Notas_Periodo($idyear);
  $alumnos = $MU->getRatingByDegreAndLevelAndSectionAndCourseAndYear($idgrado,$idnivel,$idyear,$idsecion,$idcurso);
$notas_por_alumno = [];
// Agrupar las notas acumuladas por alumno
if (isset($alumnos) && is_array($alumnos)) {

foreach ($alumnos as $alumno) {
    $alumno_id = $alumno['alumno_id'];
    
    if (!isset($notas_por_alumno[$alumno_id])) {
        $notas_por_alumno[$alumno_id] = [];
    }
    $notas_por_alumno[$alumno_id][] = $alumno;
}


}
}

?>

<div class="col-md-12" >
  <div class="box box-warning ">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title">REPORTE DE NOTAS POR (BIMES./SEMEST./PER.)</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
       <style type="text/css">#btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }</style>
     <div class="row">
       <div class="col-xs-12">
        <div class="col-md-3">
          <label for="">Grados</label>
          <select class="js-example-basic-single" name="state" id="rep_cbm_grado" style="width:100%; "onchange="ShowSelectedCursos();" >
            
          </select><br><br>
        </div>
        <div class="col-md-3">
          <label for="">Materi</label>
      
        <select class="js-example-basic-single" name="state" id="couses_degree"  style="width:100%;"> </select><br><br>
        </div>
        <div class="col-md-3">
          <label for="">Nivel</label>
       <input type="text" name="" id="txt_nivelId" hidden >
       <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled value=" <?php echo !isset($nombreNivel)?? '' ; ?> ">
        </div>
        <div class="col-md-3">
           <label for="">Seccion</label>
           <div class="alin_global">
          <input type="text" name="" class="form-control" id="text_seccion" disabled  value=" <?php echo  !isset($idsecion)?? '' ; ?> ">&nbsp;
           <button onclick="Consultar_Parametros();" class="btn-sm" id="btn_bucar_data"> <em class="fa fa-search" ></em> </button>
         </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>



 <?php if(!empty($alumnos)) {?>

<div class="col-md-12" >
  <div class="box box-warning ">
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-xs-6 clasbtn_exportar">
         <div class="input-group" id="btn-place" ></div>
       </div>
       <div class="col-xs-6 pull-right">
          <input type="text" class="global_filter form-control pull-right" id="global_filter"  autocomplete="false" style="border-radius: 5px;" >

      </div>
    </div>
    <br>
    

<table class="table table-striped" id="tbl-reporNota" style="width: 100%">
    <thead>
        <tr>
            <th>N°</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Curso</th>
            <?php foreach ($tiposevaluacion as $val): ?>
                <th><?= $val['ordenTipo_periodo'].'°_'.$val['tipo_nombre'] ?></th>
            <?php endforeach; ?>
            <th>Promedio</th> <!-- Nueva columna para el promedio -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($notas_por_alumno as $alumno_id => $notas_alumno): ?>
            <?php $alumno = $notas_alumno[0]; // Tomar cualquier entrada del alumno, ya que todas tienen los mismos datos personales ?>
            <tr>
                <td align='center'><?= $alumno['alumno_id'] ?></td>
                <td align='center'><?= $alumno['apellidos'] ?></td>
                <td align='center'><?= $alumno['alumnonombre'] ?></td>
                <td align='center'><?= $alumno['nonbrecurso'] ?></td>
                <?php 
                $total_notas = 0; // Inicializar el total de notas
                foreach ($tiposevaluacion as $val): ?>
                    <?php
                    // Buscar la nota acumulada correspondiente para este tipo de evaluación y este alumno
                    $nota = 0; // Inicializar la nota como 0 por defecto
                    foreach ($notas_alumno as $nota_alumno) {
                        if ($nota_alumno['ordentio'] == $val['ordenTipo_periodo']) {
                            $nota = $nota_alumno['notaacum'];
                            break; // No necesitamos seguir buscando una vez que encontramos la nota para este período
                        }
                    }
                    $total_notas += $nota; // Sumar la nota al total
                    ?>
                    <td align='center'>
                        <label class='form-control' style='<?= ($nota > 10.5) ? "color: blue;" : "color: red;" ?>'> <?= $nota ?>
                       </label>
                    </td>
                <?php endforeach; ?>
                <!-- Calcular y mostrar el promedio -->
                <td align='center'><label class='form-control'>
                    <?= count($tiposevaluacion) > 0 ? round($total_notas / count($tiposevaluacion), 2) : 0 ?></label>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


  </div>
</div>
</div>

<?php }?>


<script type="text/javascript">

  $(document).ready(function() {
     $("#refres_add").hide();
    $('.js-example-basic-single').select2();
    listar_Combo_Grados_report();
    initializeDataTable();

  } );
 function initializeDataTable() {
    var table = $("#tbl-reporNota").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "responsive": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    var filterElement = document.getElementById("tbl-reporNota_filter");
    if (filterElement != null) {
        filterElement.style.display = "none";
    }

    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });

    $('#btn-place').html(table.buttons().container());
}
function filterGlobal() {
  $('#tbl-reporNota').DataTable().search($('#global_filter').val(), ).draw();
}

</script>


