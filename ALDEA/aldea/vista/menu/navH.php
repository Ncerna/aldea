<aside class="main-sidebar" >


    <!-- sidebar: style can be found in sidebar.less  style="position: fixed;"  color logo #31AFB4   -->
    <section class="sidebar WhateverYourNavIs"  ><br>
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

          <?php 

          if (!empty($_SESSION['S_FILE_IMG'])) {
            echo "<img class='img-circle' alt='User Image' src='../imagenes/usuarios/".$_SESSION['S_FILE_IMG']."' alt='' style'width: 50px;height:50px'>";
           } 
           else{
           echo "<img class='img-circle' alt='User Image' src='../imagenes/images.png' alt='' style'width: 50px;height:50px'>";
           }
          
           ?>
          
           <?php //echo "<img class='img-circle' alt='User Image' src='../imagenes/usuarios/".$_SESSION['S_FILE_IMG']."' alt='' style'width: 50px;height:50px'>" ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['S_NOMBRE']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Las Cataratas Online</a>
        </div>
      </div>
      <!-- search form -->
      <form class="sidebar-form"  onsubmit="return false">
        <div class="input-group">
          <input type="text"  class="form-control" id="searchbar" autocomplete="false" onkeyup="search_SidebarMain()">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu " data-widget="tree" style=" ">
       <!-- <li class="header">MAIN NAVIGATION</li>-->

       <li class="treeview">
          <a>
            <i class="fa fa-bell-o"></i> <span style="cursor: pointer;">Publicación</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                   <li><a onclick="cargar_contenido('contenido_principal','events/events_lists.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i> Eventos</a></li>
              </ul>
          </a>
        </li>
       <?php 

       

        if ($_SESSION['S_ROL'] =='ADMINISTRADOR') {
          ?>

          <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_listar.php')">
            <i class="fa fa-user"></i> <span style="cursor: pointer;">Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li> 

        <style type="text/css">
          .treeview-menu li a:hover{
            background-color: #2fe3d7;
            border-radius: 5px;
          }
        </style>

        <li class="treeview">
          <a>
            <i class=" fa   fa-cog"></i> <span style="cursor: pointer;">Acad&eacute;mico</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                  <li><a onclick="cargar_contenido('contenido_principal','configuracion/config_yearscolar.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i> Año Escolar</a></li>
                  <!--<li><a onclick="cargar_contenido('contenido_principal','configuracion/vista_fase_periodo.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Fase & periodo</a></li>-->
                   
                   <li><a onclick="cargar_contenido('contenido_principal','configuracion/vista_fase_escolar.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Evaluaciones /Recuperaciones</a></li>
                   <li><a onclick="cargar_contenido('contenido_principal','configuracion/vista_periodoevaluacion.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Perio Evaluación</a></li>
                  
                 
              </ul>
          </a>
        </li>
              
         <li class="treeview">
          <a>
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Materia</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                   <li><a onclick="cargar_contenido('contenido_principal','curso/vista_listar_curso.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Cursos</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','curso/vista_cargaActividad_curso.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Evaluacion Acad&eacute;mico</a></li>
                  
              </ul>
          </a>
        </li>
          <li class="treeview">
          <a>
            <i class="glyphicon glyphicon-time"></i> <span style="cursor: pointer;">Horas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                <li><a onclick="cargar_contenido('contenido_principal','jornadas/vista_horas_academicos.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Horas Académicos</a></li>
                 <li><a onclick="cargar_contenido('contenido_principal','jornadas/vista_listar_horaio_clases25.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar horarios</a></li>
                 
                  
              </ul>
          </a>
        </li>

        <li class="treeview">
           <a>
            <i class="glyphicon glyphicon-education"></i> <span style="cursor: pointer;">Alumnos</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                   <li><a onclick="cargar_contenido('contenido_principal','matricula/vista_matricula.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Matr&iacute;cula</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','alumno/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar Alumnos</a></li>
                  
              </ul>
            </a>
        </li>

         <li class="treeview">
          <a>
            <i class="fa fa-lightbulb-o"></i> <span style="cursor: pointer;">Grados</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                   <li><a onclick="cargar_contenido('contenido_principal','grado/vista_listar_grado.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar grados</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','grado/vista_config_grados.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Configuracións</a></li>
                  
              </ul>
          </a>
        </li>

          <li class="treeview">
          <a><i class="fa fa-calendar-minus-o"></i> <span style="cursor: pointer;">Matricula/Mensualidad</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                   <li><a onclick="cargar_contenido('contenido_principal','pagos/vista_listar_pagos.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar Pagos</a></li>
                   <li><a onclick="cargar_contenido('contenido_principal','pagos/reporte_pagos_fehas.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Pagos Por fechas</a></li>
                  
                  
              </ul>
          </a>
        </li>

         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','payment/view_payment.php')">
            <i class="fa fa-list-alt"></i> <span style="cursor: pointer;">Pagos</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">new</span>
          </span>
          </a>
        </li> 
         <li class="treeview">
          <a>
            <i class="fa fa-pencil-square-o"></i> <span style="cursor: pointer;">Notas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
                   <li><a onclick="cargar_contenido('contenido_principal','notas/vista_registro_notas.php')" style="cursor: pointer;"><i class="fa fa-check-square-o"></i>Registro notas</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','notas/vista_reporte_notas.php')" style="cursor: pointer;"><i class="fa  fa-file-text-o"></i>Vizualizar notas</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','notas/vista_notas_periodos.php')" style="cursor: pointer;"><i class="fa  fa-book"></i>Notas intervalo</a></li>

                  <li><a onclick="cargar_contenido('contenido_principal','notas/vista_notas_alls.php')" style="cursor: pointer;"><i class="fa fa-print"></i>Notas acumulados</a></li>

                   <li><a onclick="cargar_contenido('contenido_principal','notas/vista_notas_pending.php')" style="cursor: pointer;"><i class="fa fa-hourglass-o"></i>Cursos pendientes</a></li>

                  <li><a onclick="cargar_contenido('contenido_principal','notas/vista_notas_tripleT.php')" style="cursor: pointer;"><i class="fa fa-th-large"></i>Triple T</a></li>
                  
              </ul>
          </a>
        </li>

         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','reportXls/reportlXls.php')">
            <i class="fa fa-file-excel-o"></i> <span style="cursor: pointer;">Reportes generales</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">xmls</span>
          </span>
          </a>
        </li> 

          <li class="treeview">
          <a >
             <i class="fa fa-users"></i> <span style="cursor: pointer;">Asistencias</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

          <ul class="treeview-menu">
              <li class="">
               <a  onclick="cargar_contenido('contenido_principal','asistencia/vista_asistencia.php')">
                <em class="fa fa-circle-o"></em>
                <span style="cursor: pointer;" >Asistencia</span>
                
               </a>
             </li>
              <li class="treeview">
               <a  onclick="cargar_contenido('contenido_principal','asistencia/asistencia_reportes.php')">
                <i class="fa fa-circle-o "></i>
                <span style="cursor: pointer;" >Reportes</span>
                
               </a>
             </li>
       
      </ul>
      </a>
      </li>

     <li class="treeview">
          <a >
             <i class="fa fa-male"></i> <span style="cursor: pointer;">Docentes</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

          <ul class="treeview-menu">
             <li class="">
               <a  onclick="cargar_contenido('contenido_principal','docente/vista_docente_listar.php')">
                <em class="fa fa-circle-o"></em>
                <span style="cursor: pointer;" >Docentes</span>
                
               </a>
             </li>
              <li class="">
               <a  onclick="cargar_contenido('contenido_principal','docente/vista_congif_docente.php')">
                <em class="fa fa-circle-o"></em>
                <span style="cursor: pointer;" >Asignar Grados</span>
                
               </a>
             </li>
       
      </ul>
      </a>
      </li>

       <li class="treeview">
          <a>
            <i class="fa  fa-suitcase"></i> <span style="cursor: pointer;">Boleta Notas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
               <li><a onclick="cargar_contenido('contenido_principal','boletin/vista_evaluar_criterio.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Criterio de Evaluación</a></li>

                    <li><a onclick="cargar_contenido('contenido_principal','boletin/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span class="pull-right-container">
                     <small class="label pull-right bg-yellow">123</small>
                     </span></a></li>

                     <li><a onclick="cargar_contenido('contenido_principal','boletin/vista_evaluacion_alfabetico.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span class="pull-right-container">
                     <small class="label pull-right bg-yellow">ABC</small>
                     </span></a></li>

                      <li><a onclick="cargar_contenido('contenido_principal','boletin/view_report_card.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Boleta<span class="pull-right-container">
                     </span></a></li>

                  
              </ul>
          </a>
        </li>

          <li class="treeview">
          <a onclick="cargar_contenido('contenido_principal','aula/vista_listar_aula.php')">
            <i class=" fa fa-flag"></i> <span style="cursor: pointer;">Aulas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','collaboration/view_list_collaboration.php')">
            <i class="fa fa-files-o"></i> <span style="cursor: pointer;">Colaboración</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">new</span>
          </span>
          </a>
        </li> 

         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','keys/view_list_students.php')">
            <i class="fa  fa-key"></i> <span style="cursor: pointer;">Llaves acceso</span>
            <span class="pull-right-container">
             
          </span>
          </a>
        </li>

          <li class="treeview">
          <a>
           <i class="fa  fa-cog"></i> <span style="cursor: pointer;">Configuración</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu" style="background: #020d12">
                   <li>
                   <a onclick="cargar_contenido('contenido_principal','colegio/vista_colegio_data.php')">
                    <i class=" fa fa-institution"></i> <span style="cursor: pointer;">Colegio</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>

                    </span>
                  </a>

                  </li>

                   <li>
                    <a onclick="cargar_contenido('contenido_principal','configuracion/tipos_evaluacion.php')">
                    <i class=" fa  fa-pencil-square-o"></i> <span style="cursor: pointer;">Tipos evaluacíon</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>

                    </span>
                  </a>
                  </li>
                  <li>
                    <a onclick="cargar_contenido('contenido_principal','configuracion/payment_plan.php')">
                    <i class=" fa  fa-cubes"></i> <span style="cursor: pointer;">Tipos cotas pagos</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>

                    </span>
                  </a>
                  </li>
                  <li>
                    <a onclick="cargar_contenido('contenido_principal','configuracion/view_generate_planPayment.php')">
                    <i class=" fa   fa-retweet"></i> <span style="cursor: pointer;">Generar cotas</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>

                    </span>
                  </a>
                  </li>
                  
              </ul>
          </a>
        </li>



         <li class="treeview">
          <a>
           <i class="fa fa-fw fa-dollar"></i> <span style="cursor: pointer;">Contabilidad</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu" style="background: #020d12">
                   <li><a onclick="cargar_contenido('contenido_principal','entry/view_list_entry.php')" style="cursor: pointer;"><i class="fa fa-arrow-circle-o-down "></i>Categorías ingreso</a></li>
                   <li><a onclick="cargar_contenido('contenido_principal','entry/view_list_entry_general.php')" style="cursor: pointer;"><i class="fa fa-arrow-circle-down"></i>Ingrso Geneal</a></li>

                   <hr style="margin: unset;border-top: 1px solid #23abb3">
                  <li><a onclick="cargar_contenido('contenido_principal','exit/view_list_exit.php')" style="cursor: pointer;"><i class="fa fa-arrow-circle-o-up"></i>categorías egreso</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','exit/view_list_exit_general.php')" style="cursor: pointer;"><i class="fa  fa-arrow-circle-up"></i>Egreso Geneal</a></li>

                   <hr style="margin: unset;border-top: 1px solid #23abb3">
                  <li><a onclick="cargar_contenido('contenido_principal','fixedCost/view_list_fixedCost.php')" style="cursor: pointer;"><i class="fa fa-fax"></i>Gastos fijos</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','pettycash/view_list_pettyCash.php')" style="cursor: pointer;"><i class="fa  fa-share-square"></i>Caja chica</a></li>
                  <li><a onclick="cargar_contenido('contenido_principal','pettycash/view_pettyCash_summary.php')" style="cursor: pointer;"><i class="fa  fa-dashboard"></i>Resumen</a></li>
                  
              </ul>
          </a>
        </li>
        

        <?php
          }
         ?>

          <?php 

        if ($_SESSION['S_ROL'] =='DOCENTE') {
          ?>

        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_grados.php')">
            <i class="fa fa-lightbulb-o"></i> <span style="cursor: pointer;">Grados</span>
            <span class="pull-right-container">
              <i class="fa fa-labtop"></i>
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
       
          <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_carga_academico.php')">
            <i class="fa fa-briefcase"></i> <span style="cursor: pointer;">Carga Académico</span>
            <span class="pull-right-container">
              <i class="fa fa-labtop"></i>
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
          
         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_notas_registro_docente.php')">
            <em class="fa fa-edit (aliase"></em> <span style="cursor: pointer;">Registro Notas</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>
         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_notas_report_docente.php')">
            <em class="fa fa-eye"></em> <span style="cursor: pointer;">Vizualizar Notas</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>
         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_notas_periodo_docente.php')">
            <em class="fa  fa-info-circle"></em> <span style="cursor: pointer;">Notas Periodo</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>

         <li class="treeview">
          <a >
             <i class="fa fa-users"></i> <span style="cursor: pointer;">Asistencias Clases</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

          <ul class="treeview-menu">
              <li class="">
               <a  onclick="cargar_contenido('contenido_principal','docenteSesion/vista_asistencia_Docente.php')">
                <em class="fa fa-circle-o"></em>
                <span style="cursor: pointer;" >Asistencia</span>
                
               </a>
             </li>
              <li class="treeview">
               <a  onclick="cargar_contenido('contenido_principal','docenteSesion/vista_report_asistencia_Docente.php')">
                <i class="fa fa-circle-o "></i>
                <span style="cursor: pointer;" >Reportes</span>
                
               </a>
             </li>
       
      </ul>
      </a>
      </li>

     


          <li class="treeview">
          <a>
            <i class="fa  fa-suitcase"></i> <span style="cursor: pointer;">Libreta Notas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
               

                    <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span class="pull-right-container">
                     <small class="label pull-right bg-yellow">123</small>
                     </span></a></li>

                     <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_Notas_alfabetic.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span class="pull-right-container">
                     <small class="label pull-right bg-yellow">ABC</small>
                     </span></a></li>

                  
              </ul>
          </a>
        </li>


       <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_horaio_clases25.php')">
            <em class=" glyphicon glyphicon-time"></em> <span style="cursor: pointer;">Horarios Clases</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>



            <?php
          }
         ?>

           <?php 

        if ($_SESSION['S_ROL'] =='ALUMNO') {
          ?>
     <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_Notas_Alumno.php')">
            <em class="fa fa-pencil-square-o "></em> <span style="cursor: pointer;">Notas</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>

         <li>
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/view_edit_horario_clases25.php')">
            <i class="glyphicon glyphicon-time"></i> <span style="cursor: pointer;">Horario clases</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_aula_clases.php')">
            <i class="fa fa-flag"></i> <span style="cursor: pointer;">Aula Clases</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>

          <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_listar_pagos.php')">
            <i class="fa  fa-info-circle"></i> <span style="cursor: pointer;">Cuenta</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
          <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_listar_cursos_alumno.php')">
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Materias</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>

          <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','keys/view_insert_key_acces.php')">
            <i class="fa  fa-clone"></i> <span style="cursor: pointer;">Boleta Notas</span>
            <span class="pull-right-container">
              
          </span>
          </a>
        </li>

        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','keys/view_document.php')">
            <i class="fa   fa-copy"></i> <span style="cursor: pointer;">Documentos</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">new</span>
          </span>
          </a>
        </li>

<!--
         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','')">
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Constancia inscripcion</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','')">
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Constancia de estudio</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>

         <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','')">
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Certificacion 1-3</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','')">
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Certificacion 4-6</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="fa  fa-suitcase"></i> <span style="cursor: pointer;">Resumen final</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
               

                    <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Resumen 01 <span class="pull-right-container">
                    
                     </span></a></li>

                      <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Resumen 02 <span class="pull-right-container">
                    
                     </span></a></li>
                      <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Resumen 03 <span class="pull-right-container">
                    
                     </span></a></li>
                      <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Resumen 04 <span class="pull-right-container">
                    
                     </span></a></li>
                      <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_alumnos.php')" style="cursor: pointer;"><i class="fa fa-circle-o "></i>Resumen 05 <span class="pull-right-container">
                    
                     </span></a></li>

                  
              </ul>
          </a>
        </li>
        -->

            <?php
          }
         ?>

    </ul>
     
    </section>
    <!-- /.sidebar -->
  </aside>

