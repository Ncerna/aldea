
<header class="main-header" style=" ">
    <style type="text/css">
          #class_imagenlogo a:hover{
            background-color: #2fe3d7;
            
          }
        </style>
    <!-- Logo -->
    <a href="../index.php" class="logo" id="class_imagenlogo">
      <img src="../imagenes/banner.png" style="margin-left: -42px;  max-width: 100px ;max-height: 125px;padding: 0px 25px; position: relative;
" > </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="">
      <!-- Sidebar toggle button #367fa9 paso a #969d9c-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
           <li class=" user-menu" id="refres_add" style="display: none;">
            <a ><i class="fa fa-spin fa-refresh"></i>
            </a>
           
          </li>
        <li class="user user-menu">
          <a href="https://www.facebook.com/escuelaaldeadelosninos/" target="_blank">
            <i class="fa fa-home"></i> ALDEA DE NIÑOS
          </a>
        </li>

        <li class="dropdown user user-menu">
            <input type="text" name="" id="YearActualActivo" hidden>
            <input type="text" name="" id="tex_YearActual_"  hidden>
            <a href="../index.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa  fa-flag-oe"></i><strong id="nombreYearactivo"></strong>
            </a>
           
          </li>

          <!-- Notifications: style can be found in dropdown.less -->
         
           <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-"></span>
              
            </a>
            <ul class="dropdown-menu" style="border-radius: 5px">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                       <center><li class="header">No tienes Notificaciones</li></center>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">...</a>
              </li>
            </ul>
          </li>
          
           
           <li class="dropdown user user-menu"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i>
           </a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right"  style="width: 150px;height:250px; border-radius: 5px;"><br>
              <div style="text-align: center;">
              <img class="img-circle" alt="User Image" style="width: 50px; height: 50px;" 
                  src="<?php echo !empty($_SESSION['S_FILE_IMG']) ? '../imagenes/usuarios/' . $_SESSION['S_FILE_IMG'] : '../imagenes/usuarios/images.png'; ?>"><br>
                <p>
                    <?php  echo isset($_SESSION['S_ROL']) ? $_SESSION['S_ROL'] : 'Default Role';  ?>
                </p>
                <p>
                    Usuario:  <?php  echo isset($_SESSION['S_USER']) ? $_SESSION['S_USER'] : 'Default User';  ?>
                </p>
              <p>
                  ID: <?php 
                      echo !empty($_SESSION['S_IDUSUARIO']) ? $_SESSION['S_IDUSUARIO'] : (isset($_SESSION['S_IDENTYTI']) ? $_SESSION['S_IDENTYTI'] : 'No ID');
                  ?> 
                  IDENT: <?php   echo isset($_SESSION['S_IDENTYTI']) ? $_SESSION['S_IDENTYTI'] : 'No Identity';?>
              </p>
          </div>

            <div style="margin-left: 10px;">
              <ul style="list-style-type: none; padding: 0; display: inline-block;">
                  <li class="user-body" style="margin-bottom: 10px;">
                      <button class="btn  btn-block" style="margin: 0 10px;"
                          onclick="cargar_contenido('contenido_principal','prerfil/vista_perfil_usuarios.php')">
                          <i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp; Mi perfil
                      </button>
                  </li>
                  <li class="user-body" style="margin-bottom: 10px;">
                      <button class="btn  btn-block" style="margin: 0 10px;" 
                          onclick="window.location.href='../controlador/usuario/controlador_cerrar_session.php'">
                          <i class="fa fa-sign-out"></i>&nbsp;&nbsp;logout
                      </button>
                  </li>
              </ul>
          </div>



           
           <!-- <div class="container" >
              <div class="col-lg-12">
                 <li class="dropdown-item">
                  <a class="text-danger btn btn-block btn-sm" style="border-radius: 5px;width: 100px;cursor: pointer;" onclick="cargar_contenido('contenido_principal','prerfil/vista_perfil_usuarios.php')"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp; Mi perfil</a>
                

            </li>
            </div>
            </div>

            <div class="container" >
              <div class="col-lg-12">
                 <li class="dropdown-item">
                  <a class="text-danger btn btn-block btn-sm" style="border-radius: 5px;width: 100px;cursor: pointer;" href="../controlador/usuario/controlador_cerrar_session.php"><i class="fa fa-sign-out"></i>&nbsp;&nbsplogout</a>
                

            </li>
            </div>
            </div><br>-->

          </ul>
        </li>

          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>



  