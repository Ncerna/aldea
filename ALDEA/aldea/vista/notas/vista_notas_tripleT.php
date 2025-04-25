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

  $resul = $MU->getAssignedCourses($idgrado, $idyear, $idsecion);
   $assignedCourses = $resul['status'] == true ? $resul['data'] : [];
 

function isCourseAssigned($idCurso, $assignedCourses) {
    // Usar array_filter para verificar si el curso está en la lista de cursos asignados
    $filteredCourses = array_filter($assignedCourses, function($course) use ($idCurso) {
        return $course[0] == $idCurso; 
    });
    // Si se encuentra el curso, el array filtrado no estará vacío
    return !empty($filteredCourses);
}

/*if (isCourseAssigned($idCursoToCheck, $assignedCourses)) {
    echo "Course with ID $idCursoToCheck is assigned.";
} else {
    SELECT * FROM diseno_demo.ponderados  where alumno_id = 1 AND ordentio IN (1, 2, 3);
    echo "Course with ID $idCursoToCheck is not assigned.";
}*/


//reportes para notas
$datos_alumnos = array();
foreach ($alumnos as $alumno) {
    $alumno_id = $alumno['alumno_id'];
    $nombre_completo = $alumno['apellidos'] . ' ' . $alumno['alumnonombre'];
    $curso = $alumno['nonbrecurso'];
    $periodo = $alumno['ordentio'];
    $nota = $alumno['notaacum'];
    $susty = isset($alumno['susty']) ? $alumno['susty'] : '';

    // Crear una entrada para el alumno si no existe
    if (!isset($datos_alumnos[$alumno_id])) {
        $datos_alumnos[$alumno_id] = array(
            'nombre' => $nombre_completo,
            'cursos' => array()
        );
    }

    // Crear una entrada para el curso si no existe
    if (!isset($datos_alumnos[$alumno_id]['cursos'][$curso])) {
        $datos_alumnos[$alumno_id]['cursos'][$curso] = array(
            'notas' => array_fill(1, count($tiposevaluacion), ''), // Inicializar notas vacías
            'susty' => array_fill(1, count($tiposevaluacion), '')  // Inicializar susty vacíos
        );
    }

    // Asignar la nota y susty al período correspondiente
    if (isset($datos_alumnos[$alumno_id]['cursos'][$curso]['notas'][$periodo])) {
        $datos_alumnos[$alumno_id]['cursos'][$curso]['notas'][$periodo] = $nota;
    }

    if (isset($datos_alumnos[$alumno_id]['cursos'][$curso]['susty'][$periodo])) {
        $datos_alumnos[$alumno_id]['cursos'][$curso]['susty'][$periodo] = $susty;
    }
}



// Obtener los nombres únicos de los cursos
//$cursos_unicos = array_unique(array_column($alumnos, 'nonbrecurso'));

$cursos_unicos2 = array_map(function($alumno) {
  return [ 'nombre' => $alumno['nonbrecurso'],'curso_id' => $alumno['curso_id'] ];}, $alumnos);

// Usar array_reduce para obtener un array único
$cursos_unicos = array_reduce($cursos_unicos2, function($carry, $item) {
  $key = $item['curso_id']; // O usar 'nombre' si prefieres
  if (!isset($carry[$key])) {  $carry[$key] = $item; }
  return $carry;
}, []);

// Ahora solo mantendrás los valores únicos
$cursos_unicos = array_values($cursos_unicos);



//fin de reportes para notas


}

function calcularPromedio($curso, $notas, $assignedCourses) {
  // Verificar si el curso está asignado
  if (!isCourseAssigned($curso['curso_id'], $assignedCourses)) {
      return 0; // Si no está asignado, retornar 0
  }

  // Filtrar las notas que no están vacías
  $notas_validas = array_filter($notas);

  // Calcular el promedio solo si hay notas válidas
  if (!empty($notas_validas)) {
      return array_sum($notas_validas) / count($notas_validas);
  }

  return 0; // Retornar 0 si no hay notas válidas
}

// En tu código donde calculas el promedio

function mostrarNotaSusty($curso, $notas, $sustys, $assignedCourses) {
  foreach ($notas as $periodo => $nota) {
      // Verificar si el curso está asignado usando la función isCourseAssigned
      if (isCourseAssigned($curso['curso_id'], $assignedCourses)) {
          // Si está asignado, comparar el valor de nota y susty
          $susty = $sustys[$periodo];
          $valor_final = max($nota, $susty); // Escoger el mayor entre la nota y susty
          //echo '<td>' . (empty($nota) ? '0' : $valor_final . ' (' . $susty . ')') . '</td>';
          echo '<td>' . (empty($nota) ? '0' : $valor_final ). '</td>';
      } else {
          // Si el curso no está asignado, devolver 'S/P'
          echo '<td>S/P</td>';
      }
  }
}



?>

<div class="col-md-12" >
  <div class="box box-warning ">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h2 class = "box-title">NOTAS EN ESCALA DE TRIPLE T</h2>

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
 .table-responsive {
        max-height: 380px; /* Altura máxima para el scroll */
        overflow-y: auto; /* Habilitar el scroll vertical */
       
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    th.sticky {
        position: sticky;
        top: 0; /* Fija el encabezado en la parte superior */
        z-index: 10; /* Asegura que esté por encima del contenido */
    }
    td.sticky {
        position: sticky;
        left: 0; /* Fija la columna de ALUMNOS a la izquierda */
        background-color: #f9f9f9; /* Color de fondo para la columna fija */
        z-index: 5; /* Asegura que esté por encima del contenido */
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
                    <th class="sticky" rowspan="2">ALUMNOS - <?php echo $nameDegre; ?></th>
                    <?php foreach ($cursos_unicos as $curso): ?>
                        <?php $num_columnas = count($tiposevaluacion) + 1; ?>
                        <th colspan="<?php echo $num_columnas; ?>"><?php echo $curso['nombre']; ?></th>
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
                        <td class="sticky"><?php echo $alumno['nombre']; ?></td> <!-- Cambiado a td -->
                        <?php foreach ($cursos_unicos as $curso): ?>
                            <?php 
                                // Llamada a la función que muestra las notas y valores susty
                                mostrarNotaSusty(
                                    $curso, 
                                    $alumno['cursos'][$curso['nombre']]['notas'], 
                                    $alumno['cursos'][$curso['nombre']]['susty'], 
                                    $assignedCourses // Aquí pasas los cursos asignados
                                ); 
                            ?>
                            <td>
                                <?php 
                                // Calcular el promedio del curso usando la nueva función
                                $promedio_curso = calcularPromedio($curso, $alumno['cursos'][$curso['nombre']]['notas'], $assignedCourses);
                                ?>
                                <label style='<?php echo ($promedio_curso > 10.5) ? "color: blue;" : "color: red;" ?>'>
                                    <?php echo round($promedio_curso); ?>
                                </label>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<style>
   
</style>
<br>

<?php } else { ?>

<?php } ?>

<script>

 $(document).ready(function () {

    $("#refres_add").hide();
    $('.js-example-basic-single').select2();
    getDegreesAndCouses();


})



          
</script>


